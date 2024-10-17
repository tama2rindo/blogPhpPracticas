<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image'];    //fillable property is used to specify which attributes (columns) of a model are mass assignable
                                                            //Mass assignment means that you can pass an array of data to create or update a model
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
