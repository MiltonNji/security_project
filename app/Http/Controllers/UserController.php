<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Cache\RateLimiting\Limit;
use Spatie\Permission\Models\Role;


class UserController extends Controller

{
    public function showForm()
    {
        return view('form');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/i',
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'password.required' => 'Please enter a password.',
            'password.min' => 'Your password must be at least :min characters long.',
            'password.regex' => 'Your password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);

        // Process the form submission
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Redirect to the success page with an encouraging message
        return redirect()->route('success')->with('success', 'User submitted successfully! Consider using a password manager to secure your account.');
    }


    public function success()
    {
        return view('success');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $rateLimiterKey = $request->input('email') . '|' . $request->ip();
        $maxAttempts = 5; // Maximum number of allowed login attempts
        $decayMinutes = 1; // Duration in minutes for which the login throttling will be in effect before it resets

        if (RateLimiter::tooManyAttempts($rateLimiterKey, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($rateLimiterKey);
            throw ValidationException::withMessages([
                'email' => 'Too many login attempts. Please try again in ' . $seconds . ' seconds.',
            ])->status(429);
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // Check if the "Remember Me" checkbox is selected

        if (Auth::guard('web')->attempt($credentials, $remember)) {
            RateLimiter::clear($rateLimiterKey);

            // Authentication passed...
            return redirect()->intended('/'); // Redirect to protected routes
        }

        RateLimiter::hit($rateLimiterKey, $decayMinutes * 60);

        throw ValidationException::withMessages([
            'email' => 'Invalid credentials.',
        ])->status(422);
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

// Show the password reset form
    public function showResetForm(Request $request)
    {
        return view('reset-password');
    }

// Process the password reset request
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'The provided email does not exist.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Your password has been reset. Please log in with your new password.');
    }

    public function showUsers()
    {
        $users = User::all();
        $roles = Role::all();

        return view('users', compact('users', 'roles'));
    }

    public function run()
    {
        // Create roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        // Create permissions
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);

        // Assign permissions to roles
        $adminRole = Role::findByName('admin');
        $adminRole->givePermissionTo(['edit user', 'delete user']);

        $user = User::find(1); // Assuming you have a User model and retrieve a user from the database

        $adminRole = Role::findByName('admin'); // Retrieve the admin role by name

        $user->assignRole($adminRole); // Assign the admin role to the user



    }
}
