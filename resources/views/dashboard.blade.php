<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
        Welcome to your dashboard!
        {{ Auth::user()->name }}
        <button type="button"
        onclick="window.location.href='/dashboard/create'"
        >Create</button>

    <div class="blogs-container">
    <h1>My Blog Posts</h1>

    @forelse ($blogs as $blog)
        <div class="blog-post" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 20px;">
            <h2>{{ $blog->title }}</h2>
            <p>{{ $blog->content }}</p>
                <button type="button"
                onclick="window.location.href='/dashboard/{{ $blog->id }}/edit'"
                >Edit</button>
                <button type="button"
                onclick="if(confirm('Are you sure you want to delete this blog post?')) { window.location.href='/dashboard/{{ $blog->id }}/delete' }"
                >Delete</button>

            <small>Created: {{ $blog->created_at->format('M d, Y') }}</small>
        </div>
    @empty
        <p>You haven't created any blog posts yet.</p>
    @endforelse
</div>

</body>
</html>
