<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Post</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Reuse the same CSS -->
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

        .btn-primary, .btn-outline-primary, .btn-link, input[type="text"], select {
            border-radius: 30px;
            background-color: #D3D3D3;
            color: black;
            border-color: #D3D3D3;
            backdrop-filter: blur(5px);
            background: rgba(255, 255, 255, 0.5);
        }

        .btn-primary:hover, .btn-primary.active, .btn-outline-primary:hover, .btn-link:hover {
            background-color: #A9A9A9;
            color: black;
        }

        .btn-link {
            color: black;
            text-decoration: none;
        }

        .container {
            padding-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary mt-3">Back</a>
    
    <h1>Manage Post</h1>
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>

    <form action="{{ route('admin.posts.delete', $post->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-primary">Delete Entire Post</button>
    </form>

    <h3>Replies</h3>
    @foreach ($post->replies as $reply)
        <div class="card">
            <div class="card-body">
                {{ $reply->user->name }}: {{ $reply->body }}
                <form action="{{ route('admin.replies.delete', $reply->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Reply</button>
                </form>
            </div>
        </div>
    @endforeach
</div>

</body>
</html>
