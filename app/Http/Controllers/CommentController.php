<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{

   /* public function store(Request $request, $postId)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'content' => 'required|string|max:1000',
        ]);

        // Retrieve the Post model instance using the provided $postId. Ensure $post is a model, not a string
        $post = Post::findOrFail($postId);

        // If logged in, associate the comment with the authenticated user
        if (auth()->check()) {
            $user = User::with('role')->find(auth()->id());
            if ($user && $user->isAdmin()) {
                //if (auth()->check()) {
                $postId->comments()->create([
                    'post_id' => $postId,
                    'name' => $request->name ?? 'Guest',    // Default to 'Guest' if no name is provided
                    'email' => $request->email,
                    'content' => $request->content,
                    'user_id' => auth()->id(),
                ]);
            } else {
                // For non-logged-in users, allow anonymous comments
                $post->comments()->create([
                    'name' => $request->name ?? 'Guest', // Default to 'Guest'
                    'email' => $request->email,
                    'content' => $request->content,
                ]);
            }

            return redirect()->back()->with('success', 'Comment added successfully!');
        }
    }

*/
     public function store(Request $request, $postId)
    {  
         $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'content' => 'required'
        ]);

        Comment::create([
            'post_id' => $postId,
            'name' => $request->name ?? 'Guest',    // Default to 'Guest' if no name is provided
            'email' => $request->email,
            'content' => $request->content
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!'); }



    // Show the form to edit a comment
    public function edit(Post $post, Comment $comment)
    {
        if (auth()->check()) {
            $user = User::with('role')->find(auth()->id());
            
            // Allow admin and the comment owner to edit their own comments
            if ($user && $user->isAdmin() && $comment->user_id === $user->id || $comment->user_id === auth()->id()) {
                return view('livewire.comments.edit', compact('post', 'comment'));
            }
        }
            return redirect('/posts')->with('error', 'You cannot edit a comment if you are not loggedin');
    }

    // Handle updating a comment
    public function update(Request $request, Post $post, Comment $comment)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
        ]);
       
        $user = auth()->user();
        //the $user object is an instance of the User model, but it's not properly loaded with the necessary relationships.
        //To fix this, use the optional helper function provided by Laravel to avoid calling the isAdmin() method on a null object:
        if ((auth()->id() === $comment->user_id || optional(auth()->user())->isAdmin() && auth()->id === $comment->user_id)) {
            // Update the comment
            $comment->update($validatedData);

            // Redirect back to the post view with success message
             return redirect()->route('posts.show', $post)->with('success', 'Comment updated successfully!');
           

        }

        return redirect('/posts')->with('error', 'You are not authorized to edit this comment.');
    }

    //delete comments
    public function destroy(Post $post, Comment $comment)
    {
        if (auth()->user()->id === $comment->user_id) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully!');
        }

        return redirect('/')->with('error', 'You are not authorized to delete this comment.');


        /*   $comment->delete();

        // Redirect back to the post view with a success message
        return redirect()->route('posts.show', $post)->with('success', 'Comment deleted successfully!');*/
    }

    public function adminDestory(Comment $comment)
    {
        if (auth()->check()) {
            $user = User::with('role')->find(auth()->id());
            if ($user && $user->isAdmin()) {
                $comment->delete();
                return redirect()->back()->with('success', 'Comment deleted by admin!');
            }
        }
        return redirect('/')->with('error', 'Unauthorized to delete this comment.');
    }
}
