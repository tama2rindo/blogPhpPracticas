
<h3>Leave a Comment</h3>
<div>
    <form action="{{ route('comments.store', $post->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label for="content">Comment</label>
            <textarea class="form-control" name="content" id="content" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Comment</button>
    </form>
</div>


<h2>Comments</h2>
<ul>
    @foreach ($post->comments as $comment)
        <li>
            <p >
                By {{ $comment->name }}: {{ $comment->content }}</li>
            </p>

        <!-- buttom to edit comment -->
        <div style="gap: 0.5rem" class="d-flex justify-content-start hola">
            <a href="{{ route('comments.edit', [$post, $comment]) }}" class="btn btn-primary">Edit Comment</a>

            <form action="{{ route('comments.destroy', [$post, $comment]) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this comment?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Comment</button>
            </form>

        </div>
    @endforeach
</ul>

