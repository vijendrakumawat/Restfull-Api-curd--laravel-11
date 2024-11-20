<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Comment;
use App\Models\UserComment;
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'author',
    ];

        public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function userComments()
    {
        return $this->hasManyThrough(UserComment::class, Comment::class, 'post_id', 'comment_id');
    }
    
    
}
