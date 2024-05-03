<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body,
        html {

            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .login-container {
            background: linear-gradient(to right, #b512eb, #54435a);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .login-form {
            background: rgba(236, 234, 236, 0.15);
            padding: 50px;
            border-radius: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            box-sizing: border-box;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .btn-login {
            width: 100%;
            padding: 10px;
            background-color: #fff;
            border: none;
            border-radius: 5px;
            color: #6a11cb;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-login:hover {
            background-color: #b686ea;
            transform: scale(1.05);
            /* Pop effect */
        }

        .form-links {
            text-align: center;
            margin-top: 20px;
        }

        .link {
            color: #fff;
            text-decoration: none;
            font-size: 0.9em;
        }

        .link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-form">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-input" name="email" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-input" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-login">Login</button>
                </div>
                <div class="form-links">
                    <a href="#" class="link">Forgot password?</a>
                    <a href="{{ route('register') }}" class="link">Register</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
