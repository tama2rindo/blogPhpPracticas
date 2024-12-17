
@extends('layouts.allblogs')

@section('content')
    <h1>Blog Posts</h1>
    @hasrole('super-admin|admin')
     <a href="{{ route('posts.create') }}" class="btn btn-success" style="margin-bottom:25px;">Create New Post</a> 
    @endhasrole
     <div>
        @foreach ($posts as $post)
        <div class="post-item">
            <h3>
                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
            </h3>
            
            <!-- Check if the post has an image, display it if available -->
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="width:400px; height:auto;">
            @endif
            
           
        </div>
        <hr>
        @endforeach
    </div>

@endsection
