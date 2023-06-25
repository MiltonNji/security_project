<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <!-- Email Input -->
    <label for="email">Email</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

    <!-- New Password Input -->
    <label for="password">New Password</label>
    <input id="password" type="password" name="password" required>

    <!-- Confirm New Password Input -->
    <label for="password_confirmation">Confirm New Password</label>
    <input id="password_confirmation" type="password" name="password_confirmation" required>

    <!-- Submit Button -->
    <button type="submit">Reset Password</button>
</form>
