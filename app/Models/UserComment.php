<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
class UserComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'user_id',
        'post_id',
        'user_comment',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    function comment()
    {
        return $this->belongsTo(Comment::class);
    }

}
