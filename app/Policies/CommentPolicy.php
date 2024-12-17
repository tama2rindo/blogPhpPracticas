<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;


class CommentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }

    /**
     * Determine if the given comment can be deleted by the user.
     */
    public function delete(User $user, Comment $comment)
    {
        // Allow super admin to delete any comment
        if ($user->hasRole('super-admin')) {
            return true;
    }

    // Allow regular users to delete only their own comments
        return $user->id === $comment->user_id;
    }
}
