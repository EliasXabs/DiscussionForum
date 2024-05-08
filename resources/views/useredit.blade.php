<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
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
            width: 50%;
            min-width: 300px;
            max-width: 600px;
            padding: 20px;
            background: rgba(236, 234, 236, 0.15);
            border-radius: 8px;
            border: 1px solid rgba(216, 61, 243, 0.2);
            backdrop-filter: blur(5px);
        }
        form {
            width: 100%;
        }
        label, input, button {
            display: block;
            width: 100%;
            margin-top: 10px;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 8px;
        }
        button {
            background-color: #D3D3D3;
            color: black;
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 8px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #A9A9A9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>
        <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" required>
            </div>
            <div>
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <label for="password_confirmation">Confirm New Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>
            <div>
                <button type="submit">Update Profile</button>
            </div>
        </form>
        <button onclick="window.location='{{ route('user.profile') }}'" style="margin-top: 20px;">Back to Profile</button>
    </div>

</body>
</html>
