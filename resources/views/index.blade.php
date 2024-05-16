<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
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

        input[type="text"], select {
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        .like-btn, .comment-btn, .delete-btn {
            padding: 8px 12px;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .like-btn:hover, .comment-btn:hover, .delete-btn:hover {
            background-color: #D3D3D3;
        }

        .comment-input {
            width: 100%; /* Adjusted for full width */
            padding: 8px;
            border-radius: 30px;
            border: 1px solid #ccc;
            outline: none;
        }

        .comment-input:focus {
            border-color: #A9A9A9;
        }
    </style>
</head>
<body>
    <div class="container glass">
        <div class="navbar glass">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-link">Logout</button>
            </form>
            <a href="{{ route('user.profile') }}" class="btn btn-link">Profile</a>
        </div>
        @foreach ($posts as $post)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->body }}</p>
                    <div>
                        @foreach ($post->replies as $reply)
                            <div style="background: #f8f9fa; padding: 10px; border-radius: 5px; margin-top: 5px;">
                                <strong>{{ $reply->user->name }}:</strong> {{ $reply->body }}
                                @if(auth()->id() === $reply->user_id || auth()->user()->is_admin)
                                    <form action="{{ route('reply.delete', $reply->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <form action="{{ route('posts.reply', $post->id) }}" method="POST">
                        @csrf
                        <input type="text" name="body" class="comment-input" placeholder="Write a reply...">
                        <button type="submit" class="comment-btn">Reply</button>
                    </form>
                </div>
            </div>
        @endforeach
        {{ $posts->links() }} <!-- Pagination -->
    </div>
</body>
</html>
