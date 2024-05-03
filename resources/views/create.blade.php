<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
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

        .input-field {
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
            border-radius: 28px;
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
        <h2>Add Post</h2>
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <div class="input-field">
                <input type="text" name="title" placeholder="Title" required>
            </div>
            <div class="input-field">
                <textarea name="body" placeholder="Description" required></textarea>
            </div>
            <button type="submit">Create</button>
        </form>
    </div>
</body>

</html>
