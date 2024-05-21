<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Open Sans', Arial, sans-serif; /* Updated font for better readability */
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

        .btn-primary, .btn-outline-primary, .btn-link, select {
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

        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, .075);
            margin-bottom: 20px;
        }

        .container {
            padding-top: 20px;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.5); /* Glass effect for input fields */
            border: 1px solid rgba(255, 255, 255, 0.6);
            outline: none;
        }

        input[type="text"]:focus {
            border-color: #A9A9A9;
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
            width: 100%;
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <select id="sortBy" class="form-control" onchange="window.location.href=this.value;">
                    <option value="text" hidden>Sort</option>
                    <option value="{{ route('index', ['sort' => 'date']) }}">Sort by Date</option>
                    <option value="{{ route('index', ['sort' => 'popularity']) }}">Sort by Popularity</option>
                </select>
            </div>
            <div>
                <form action="{{ route('index') }}" method="GET" class="form-inline">
                    <input type="text" name="search" class="form-control" placeholder="Search posts..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary ml-2">Search</button>
                </form>
            </div>
            <div>
                <a href="{{ route('create') }}" class="btn btn-primary">Create Post</a>
            </div>
        </div>
        <div id="postsContainer">
            @foreach ($posts as $post)
                <div class="card" data-date="{{ $post->created_at }}" data-popularity="{{ $post->likes->count() }}" data-user="{{ $post->user->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->body }}</p>
                        <div>
                            @foreach ($post->replies as $reply)
                            <div style="padding: 10px; border-radius: 35px; margin-top: 20px;">
                                <p class="navbar glass"><strong>{{ $reply->user->name }}:</strong> {{ $reply->body }}</p>
                                @if(auth()->id() === $reply->user_id || auth()->user()->is_admin)
                                @if(auth()->user()->is_active)
                                <form action="{{ route('reply.delete', $reply->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                            @endif
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                    @if(auth()->user()->is_active)
                                    <form action="{{ route('posts.reply', $post->id) }}" method="POST">
                                        @csrf
                                        <input type="text" name="body" class="comment-input" placeholder="Write a reply...">
                                        <button type="submit" class="comment-btn">Reply</button>
                                    </form>
                                    <form action="{{ route('posts.like', $post->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-link like-btn">
                                            Like ({{ $post->likes->count() }})
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        {{ $posts->links() }} <!-- Pagination -->
                    </div>
                </body>
                </html>
                