<form action="{{ route('login') }}" method="POST">
    @csrf
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        @error('email')
        <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        @error('password')
        <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember Me</label>
    </div>
    <button type="submit">Login</button>
    <a href="{{ route('password.request') }}">Forgot Password?</a>
</form>
