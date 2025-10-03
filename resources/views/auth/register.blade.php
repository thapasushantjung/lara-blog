<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

        <form method="POST", action='/register'>
            @csrf
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{old('name')}}">
            <br>
            <label for="username">UserName:</label>
            <input type="text" name="username" value="{{old('username')}}">
            <br>
            <label for="email">Email:</label>
            <input type="email" name="email" value="{{old('email')}}">
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" value="{{old('password')}}">
            <br>
            <button type="submit">Register</button>

        </form>
</body>
</html>
