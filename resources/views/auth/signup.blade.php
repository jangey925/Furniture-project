<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/signup.css') }}">

</head>

<body>
    <div class="container">
        <div class="register-form">
            <h2>Signup</h2>

            <form method="POST" action="{{ route('signup') }}">
                @csrf
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <div class="phonenumber">
                        <span>+977</span>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" 
                            placeholder="Enter your phone number">
                    </div>
                    @error('phone')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="gender">Gender</label>
                    <div>
                        <input type="radio" id="male" name="gender" value="male"
                            {{ old('gender') == 'male' ? 'checked' : '' }}>
                        <label for="male">Male</label>

                        <input type="radio" id="female" name="gender" value="female"
                            {{ old('gender') == 'female' ? 'checked' : '' }}>
                        <label for="female">Female</label>

                        <input type="radio" id="other" name="gender" value="other"
                            {{ old('gender') == 'other' ? 'checked' : '' }}>
                        <label for="other">Other</label>
                    </div>
                    @error('gender')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}" required
                        placeholder="Enter your address">
                    @error('address')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" required>
                        <a href="#" class="show-password" onclick="togglePassword(event, 'password')">👁️</a>
                    </div>
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="password-container">
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                        <a href="#" class="show-password"
                            onclick="togglePassword(event, 'password_confirmation')">👁️</a>
                    </div>
                </div>

                <button type="submit" class="btn">Register</button>
            </form>
        </div>
    </div>


    <script src="{{ asset('assets/js/login.js') }}"></script>
</body>

</html>
