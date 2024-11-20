<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Post;
use App\Models\UserComment;
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
    ];
    
    public function post() {
        return $this->belongsTo(Post::class);
    }
    function userComments()
    {
        return $this->hasMany(UserComment::class);
    }
}
