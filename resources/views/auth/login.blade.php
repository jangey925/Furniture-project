<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="login-container">
        <div class="login-card">

            <h1 class="logo">Furnitureland</h1>
            @if (session('success'))
                <div class="alert alert-success"
                    style="border-radius: 5px; padding: 15px; background-color: #d4edda; color: #155724; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger"
                    style="border-radius: 5px; padding: 15px; background-color: #f8d7da; color: #721c24; margin-bottom: 20px;">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h2>Login</h2>
                <div class="input-group">
                    <input type="text" name="email" placeholder="Email or Phone number" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <a href="#" class="show-password" onclick="togglePassword(event, 'password')">👁️</a>
                </div>
              
                <button type="submit" class="login-button">Login</button>
                


                <p>Don’t have an account? <a href="{{ route('signup') }}" class="signup-link">Sign up</a></p>
            </form>
        </div>
    </div>
    <script src="{{ asset('assets/js/login.js') }}"></script>
</body>

</html>
