<style>
    .form-container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    .error-message {
        color: #ff0000;
        font-size: 12px;
        margin-top: 5px;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .submit-button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
    }

    .submit-button:hover {
        background-color: #0056b3;
    }
</style>

<div class="form-container">
    <form action="{{ route('submit.form') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
            @error('name')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
            @error('email')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            @error('password')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <!--
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password">
            @error('confirm_password')
        <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit" class="submit-button">Submit</button>
    </form>
</div>
