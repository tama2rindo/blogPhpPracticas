<div>
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
</div>


