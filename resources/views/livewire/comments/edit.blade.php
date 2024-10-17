@extends('layouts.allblogs')

@section('content')
<div class="container">
    <h2>Edit Comment</h2>

    <form action="{{ route('comments.update', [$post, $comment]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Your Name</label>
            <input class="form-control" type="text" id="name" name="name" value="{{ $comment->name }}" required>
        </div>

        <div class="form-group">
            <label for="content">Your Comment</label>
            <textarea class="form-control" id="content" name="content" required>{{ $comment->content }}</textarea>
        </div>

        <button class="btn btn-primary" type="submit">Update Comment</button>
        <a href="{{ route('posts.show', $post) }}" class="btn btn-danger">Cancel</a>
    </form>
</div>
@endsection
