<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #b512eb, #54435a);
        }

        .profile-header, .card, .container {
            background: rgba(236, 234, 236, 0.15);
            border-radius: 8px;
            border: 1px solid rgba(216, 61, 243, 0.2);
            backdrop-filter: blur(5px);
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            justify-content: space-between; /* This will push the button to the right */
            padding: 10px 0;
            margin-bottom: 40px;
        }

        .profile-info { /* Newly added class for the left side content */
            display: flex;
            align-items: center;
        }

        .avatar {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        h1, p {
            color: white;
            margin: 0; /* Removes margin to better control layout */
        }

        .btn {
            padding: 8px 12px;
            border-radius: 30px;
            background-color: #D3D3D3;
            color: black;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #A9A9A9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-header">
            <button onclick="window.location='{{ route('index') }}'" class="btn">Posts</button>
            <div class="profile-info">
                <img src="{{ asset($user->avatar_url) }}" alt="Avatar" class="avatar">
                <h1>{{ $user->name }}</h1>
            </div>
            @if(auth()->user()->is_active)
                <button onclick="window.location='{{ route('user.edit') }}'" class="btn">Edit Profile</button>
            @endif
        </div>
        <div class="card">
            <div class="card-body">
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <!-- Display user's posts -->
                <h3>Your Posts</h3>
                @foreach ($posts as $post)
                    <div class="post">
                        <h5>{{ $post->title }}</h5>
                        <p>{{ $post->body }}</p>
                        <div>
                            <!-- Only active users can edit and delete their posts -->
                            @if(auth()->user()->is_active)
                                <a href="{{ route('edit', $post->id) }}" class="btn">Edit</a>
                                <form action="{{ route('delete', $post->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn">Delete</button>
                                </form>
                            @endif
                            <!-- Add other actions as needed -->
                        </div>
                    </div>
                @endforeach
                {{ $posts->links() }} <!-- Pagination links -->
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
