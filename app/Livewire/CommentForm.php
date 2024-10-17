<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;

class CommentForm extends Component
{
    public $postId;
    public $name;
    public $email;
    public $content;
    public $comments;

    protected $rules = [
        'postId' => 'required',
        'name' => 'required|max:255',
        'email' => 'required|max:255',
        'content' => 'required|max:1000',
    ];

    public function submitComment()
    {
        $this->validate();

        Comment::create([
            'post_id' => $this->postId,
            'name' => $this->name,
            'email'  => $this->email,
            'content' => $this->content,
        ]);
        // Reset the form fields after submission
        $this->reset(['name', 'email', 'content']);

        // Optionally, emit an event to refresh the comments list
        $this->emit('commentAdded');
    }

    public function render()
    {
        return view('livewire.comment-form', [
            'comments' => $this->comments,


        ]);

    }

    

}


