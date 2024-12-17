<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('permission:update comment', ['only' =>['update', 'edit']]);
        $this->middleware('permission:delete comment', ['only' =>['destroy']]);
    }

     public function store(Request $request, $postId)
    {  
         $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'content' => 'required'
        ]);

        Log::info('Current user ID: ' . Auth::id());
        Comment::create([
            'post_id' => $postId,
            'name' => $request->name ?? 'Guest',    // Default to 'Guest' if no name is provided
            'email' => $request->email,
            'content' => $request->content,
            'user_id' => Auth::check() ? Auth::id() : null, // Only set user_id if the user is logged in
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!'); }



    // Show the form to edit a comment
    public function edit(Post $post, Comment $comment)
    {
        // Check if the user is authorized to update the comment
        $this->authorize('update', $comment);

        return view('livewire.comments.edit', compact('post', 'comment'));
     }

    // Handle updating a comment
    public function update(Request $request, Post $post, Comment $comment)
    {
        // Authorize the user to update the comment
        $this->authorize('update', $comment);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
        ]);
       
            $comment->update($validatedData);

            // Redirect back to the post view with success message
             return redirect()->route('posts.show', $post)->with('success', 'Comment updated successfully!');
    }

    //delete comments
    public function destroy(Post $post, Comment $comment)
    {
        // Authorize the user to delete the comment
        $this->authorize('delete', $comment);

         $comment->delete();

        // Redirect back to the post view with a success message
        return redirect()->route('posts.show', $post)->with('success', 'Comment deleted successfully!');
    }

    
}
