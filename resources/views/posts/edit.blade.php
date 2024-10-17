@extends('layouts.allblogs')

@section('content')
<div class="container">
    <h2>Edit Post</h2>

    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ $post->title }}" required>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" required>{{ $post->content }}</textarea>
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label for="image">Image</label>
            <input class="form-control" type="file" id="image" name="image" accept="image/*"> 
            @if ($post->image)
                <p>Current Image:</p>
                <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" style="max-width: 400px; max-height: auto;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
        <a href="{{ route('posts.show', $post) }}" class="btn btn-danger">Cancel</a>
    </form>
</div>
@endsection
