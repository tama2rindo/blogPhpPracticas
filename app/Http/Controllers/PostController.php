<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\returnSelf;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all(); // Get all posts
        return view('posts.index', ['posts' => $posts, 'isSinglePost' => false]); // Pass flag for all posts
    }

    public function show($id)
    {
        $post = Post::with('comments')->findOrFail($id); // Get post with comments
        return view('posts.show', ['post' => $post, 'isSinglePost' => true]); // Pass flag for single post
    }

    // methods to show the form for creating a post and store the new post
    public function create()
    {
            return view('posts.create'); 
    }


    public function store(Request $request)
    {   
        // Validate the input
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);
        // Handle the image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Store in the public/images directory
        }

        // Create a new post
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath, // Save image path in DB
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
        
    }


    // Show the form to edit a post(Update)
    public function edit(Post $post)
    {
        
        return view('posts.edit', compact('post'));
    }

    // Handle the update of a post
    public function update(Request $request, Post $post)
    {
        //this is to check in storage/logs/laravel.log if the update is working
        Log::info('Update request data:', $request->all());

        // Validate the data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if an image is uploaded
        if ($request->hasFile('image')) {
            // Handle the image upload
            $imagePath = $request->file('image')->store('images', 'public'); // Store in storage/public/images
            $validatedData['image'] = $imagePath; // Update the image path in validated data
        } else {
            // Keep the existing image if no new image is uploaded
            $validatedData['image'] = $post->image;
        }

        // Update the post
        $post->update($validatedData);

        // Redirect back to the post view with a success message
        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully!');
    }

    // Handle the deletion of a post
    public function destroy(Post $post)
    {
        // Delete the post
        $post->delete();

        // Redirect back to the posts list with a success message
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');  // Get the search query from the request

        // Search the posts by title or content
        $posts = Post::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->get();

        // Return the search results view with the posts
        return view('posts.search-results', compact('posts', 'query'));
    }
}
