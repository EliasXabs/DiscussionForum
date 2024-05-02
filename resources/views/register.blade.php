<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .avatar-selection label {
            margin-right: 10px;
            cursor: pointer;
        }
        .avatar-selection input[type="radio"] {
            display: none;
        }
        .avatar-selection label img {
            height: 50px;
            width: 50px;
            border: 2px solid transparent;
            border-radius: 50%;
        }
        .avatar-selection input[type="radio"]:checked + label img {
            border-color: blue;
            
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
        <a href="{{ route('login') }}" class="btn {{ (request()->is('login')) ? 'disabled' : '' }}">Login</a>
        <a href="{{ route('register') }}" class="btn {{ (request()->is('register')) ? 'disabled' : '' }}">Register</a>
    </div>
    <div class="container mt-5">
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
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>
            <div class="form-group avatar-selection">
                <p>Select an Avatar:</p>
                <input type="radio" id="avatar1" name="avatar" value="./avatar-male.svg" required>
                <label for="avatar1"><img src="{{ asset('./avatar-male.svg') }}" alt="Male"></label>
                <input type="radio" id="avatar2" name="avatar" value="/avatar-female.png" required>
                <label for="avatar2"><img src="{{ asset('/avatar-female.png') }}" alt="Female"></label>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>
</html>
