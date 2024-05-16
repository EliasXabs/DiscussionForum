<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Exact CSS as your index page */
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #b512eb, #54435a);
        }

        .navbar, .card, .container {
            background: rgba(236, 234, 236, 0.15);
            border-radius: 8px;
            border: 1px solid rgba(216, 61, 243, 0.2);
            backdrop-filter: blur(5px);
        }

        .navbar {
            margin-bottom: 20px;
            padding: 10px 0;
        }

        .btn-primary, .btn-outline-primary, .btn-link, input[type="text"], select {
            border-radius: 30px;
            background-color: #D3D3D3; /* Light gray */
            color: black;
            border-color: #D3D3D3;
            backdrop-filter: blur(5px); /* Glass effect for sort scroller */
            background: rgba(255, 255, 255, 0.5); /* Ensuring the glass effect */
        }

        .btn-primary:hover, .btn-primary.active, .btn-outline-primary:hover, .btn-link:hover {
            background-color: #A9A9A9; /* Darker gray on hover and when active */
            color: black;
        }

        .btn-link {
            color: black; /* Black text for all link buttons */
            text-decoration: none;
        }

        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, .075);
            margin-bottom: 20px;
        }

        .container {
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
        
        <h1>Dashboard</h1>

        <h2>Manage Users</h2>
        @foreach ($users as $user)
            <div class="card">
                <div class="card-body">
                    {{ $user->name }} - {{ $user->is_active ? 'Active' : 'Inactive' }}
                    <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ $user->is_active ? 'Deactivate' : 'Activate' }}</button>
                    </form>
                </div>
            </div>
        @endforeach

        <h2>Posts Management</h2>
        <form action="" method="GET">
            <select name="post_id" onchange="this.form.action='/admin/post/' + this.value; this.form.submit();">
                <option value="">Select a Post to Manage</option>
                @foreach ($posts as $post)
                    <option value="{{ $post->id }}">{{ $post->title }}</option>
                @endforeach
            </select>
        </form>
    </div>
</body>
</html>
