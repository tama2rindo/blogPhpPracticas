<style>
    .hola {
        height: 35px;
        margin-top: 10px;
    }
</style>

@extends('layouts.allblogs')

@section('content')
        <h1>{{ $post->title }}</h1>
        <div class="row">
            <div class="col-md-12">
                <!-- Display the image -->
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                        style='float:left;width:400px;height:300px; margin-right:10px;'>
                @endif
                <p>{{ $post->content }}</p>
            </div>
        </div>
   

    <!--button to edit and delete posts--> 
            @hasrole('super-admin')
            <div style="gap: 0.5rem" class="d-flex justify-content-start hola">
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit Post</a>
            
                <form action="{{ route('posts.destroy', $post) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Post</button>
                </form>
            </div>
            @endhasrole
      
            
    <!-- Include the comments partial here -->
    @include('livewire.comments.comment-list', ['post' => $post])
@endsection
