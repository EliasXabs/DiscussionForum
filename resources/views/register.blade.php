<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #b512eb, #54435a);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 200%;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 15px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #fff;
            border: none;
            border-radius: 10px;
            color: #6a11cb;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #b686ea;
            transform: scale(1.05);
        }

        .avatar-selection label img {
            height: 50px;
            width: 50px;
            border: 2px solid transparent;
            border-radius: 50%;
        }

        .avatar-selection input[type="radio"]:checked+label img {
            border-color: blue;
        }

        .navbar {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 10px;
            padding: 8px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }

        .disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="{{ route('login') }}" class="btn {{ request()->is('login') ? 'disabled' : '' }}">Login</a>
        <a href="{{ route('register') }}" class="btn {{ request()->is('register') ? 'disabled' : '' }}">Register</a>
    </div>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" class="form-control" name="name" placeholder="Name" required>
            <input type="email" class="form-control" name="email" placeholder="Email" required>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password"
                required>
            <div class="avatar-selection">
                <p>Select an Avatar:</p>
                <input type="radio" id="avatar1" name="avatar" value="./avatar-male.svg" required>
                <label for="avatar1"><img src="{{ asset('./avatar-male.svg') }}" alt="Male Avatar"></label>
                <input type="radio" id="avatar2" name="avatar" value="./avatar-female.png" required>
                <label for="avatar2"><img src="{{ asset('./avatar-female.png') }}" alt="Female Avatar"></label>
            </div>
            <button type="submit" class="btn">Register</button>
        </form>
    </div>
</body>

</html>
