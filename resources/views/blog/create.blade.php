<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a blog</title>
</head>
<body>
        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>

        @endif

    <h1>Login</h1>
    <form method="POST" action="/dashboard/create">
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required autofocus>
        </div>
        <div>
            <label for="content">Content</label>
            <textarea type="textarea" id="content" name="content" required></textarea>
        </div>
        <div>
            <button type="submit">Create</button>
        </div>
    </form>

</body>
</html>
