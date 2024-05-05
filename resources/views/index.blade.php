<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #b512eb, #54435a);
        }

        .navbar,
        .card,
        .container {
            background: rgba(236, 234, 236, 0.15);
            border-radius: 8px;
            border: 1px solid rgba(216, 61, 243, 0.2);
            backdrop-filter: blur(5px);
        }

        .navbar {
            margin-bottom: 20px;
            padding: 10px 0;
        }

        .btn-primary,
        .btn-outline-primary,
        .btn-link,
        input[type="text"],
        select {
            border-radius: 30px;
            background-color: #D3D3D3;
            color: black;
            border-color: #D3D3D3;
            backdrop-filter: blur(5px);
            background: rgba(255, 255, 255, 0.5);
        }

        .btn-primary:hover,
        .btn-primary.active,
        .btn-outline-primary:hover,
        .btn-link:hover {
            background-color: #A9A9A9;
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

        input[type="text"] {
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid #ccc;
            padding: 10px 30px 10px 10px;
            background-image: url('https://img.icons8.com/ios-glyphs/30/000000/search--v1.png');
            background-position: 95% center;
            background-repeat: no-repeat;
            margin-bottom: 20px;
            margin-top: 15px;
        }

        select {
            width: 100%;
            padding: 10px 15px;
            border: none;
            border-radius: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.25);
        }

        .like-btn,
        .comment-btn,
        .delete-btn {
            padding: 8px 12px;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .like-btn:hover,
        .comment-btn:hover,
        .delete-btn:hover {
            background-color: #D3D3D3;
        }

        .comment-input {
            width: calc(100% - 140px);
            padding: 100px;
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
            <a href="{{ route('login') }}" class="btn btn-link {{ request()->is('login') ? 'disabled' : '' }}">Login</a>
            <a href="{{ route('register') }}"
                class="btn btn-link {{ request()->is('register') ? 'disabled' : '' }}">Register</a>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('index') }}"
                    class="btn btn-primary {{ request()->get('filter') == '' ? 'active' : '' }}">All Posts</a>
                <a href="{{ route('index', ['filter' => 'mine']) }}"
                    class="btn btn-primary {{ request()->get('filter') == 'mine' ? 'active' : '' }}">My Posts</a>
                @if (auth()->check() && !auth()->user()->is_disabled)
                    <button onclick="window.location.href='{{ route('create') }}'"
                        class="btn btn-primary float-right">Add Post</button>
                @endif
                <div style="float: right; margin-right: 10px;">
                    <form action="{{ route('index') }}" method="GET" class="form-inline">
                        <input type="text" class="form-control mr-2 glass" placeholder="Search posts by title"
                            name="search" value="{{ request()->get('search') }}">
                        <select name="sort" class="form-control mr-2 glass" onchange="this.form.submit()">
                            <option value="">Sort By</option>
                            <option value="date" {{ request()->get('sort') == 'date' ? 'selected' : '' }}>Date
                            </option>
                            <option value="popularity" {{ request()->get('sort') == 'popularity' ? 'selected' : '' }}>
                                Popularity</option>
                            <option value="user" {{ request()->get('sort') == 'user' ? 'selected' : '' }}>User
                            </option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
        @if ($posts->count() > 0)
            @foreach ($posts as $post)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->body }}</p>
                        <div>
                            <form action="{{ route('posts.like', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="like-btn">Like</button>
                                <span>{{ $post->likes->count() }} likes</span>
                            </form>
                            <form action="{{ route('posts.reply', $post->id) }}" method="POST">
                                @csrf
                                <input type="text" name="body" class="comment-input"
                                    placeholder="Write a reply...">
                                <button type="submit" class="comment-btn">Reply</button>
                            </form>
                            @foreach ($post->replies as $reply)
                                <div>{{ $reply->user->name }}: {{ $reply->body }}</div>
                            @endforeach
                        </div>
                        @if (auth()->id() == $post->user_id)
                            <a href="{{ route('edit', $post->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('delete', $post->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
            {{ $posts->links() }}
        @else
            <div class="alert alert-info">No posts found</div>
        @endif
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
