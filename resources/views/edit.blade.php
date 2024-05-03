<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #b512eb, #54435a);
        }

        .form-container {
            background: rgba(236, 234, 236, 0.15);
            backdrop-filter: blur(5px);
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 20px;
            margin: auto;
            margin-top: 100px;
            /* Adjust as needed */
        }

        h2 {
            color: #333;
            font-size: 24px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            padding: 10px;
            background-color: #D3D3D3;
            /* Light gray */
            color: black;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #A9A9A9;
            /* Darker gray on hover */
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Edit Post</h2>
        <form action="{{ route('update', $post->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}"
                    required>
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body" required>{{ $post->body }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
</body>

</html>
