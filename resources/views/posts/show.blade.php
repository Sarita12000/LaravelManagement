<!-- resources/views/posts/show.blade.php -->

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Show Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

<main class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
        <h1>Post Details</h1>
    </header>
    <div class="card">
        <div class="card-header">
            <p>Post Details</p>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $post->title }}</p>
            <p class="card-text">{{ $post->content }}</p>
            <a href="{{ route('posts.index') }}" class="btn btn-primary">Back to Posts</a>
        </div>
    </div>
</main>

</body>
</html>
