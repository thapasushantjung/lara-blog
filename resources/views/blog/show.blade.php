<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$blog->title}}</title>
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
    <h1>{{ $blog->title }}</h1>
    <p>{{ $blog->content }}</p>
    <small>Created: {{ $blog->created_at->format('M d, Y') }}</small>

</body>
</html>
