@extends('layouts.allblogs')

@section('content')
<div class="container">
    <h2>Search Results for "{{ $query }}"</h2>

    @if ($posts->isEmpty())
        <p>No posts found.</p>
    @else
        <div>
            @foreach ($posts as $post)
            <a href="{{ route('posts.show', $post->id) }}" style="font-size: 25px"> {{ $post->title }} </a>
        @endforeach
        </div>   
    @endif   
</div>
@endsection
