<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\UserComment;

class UserCommentController extends Controller
{
    public function store(Request $request)
    {
        
        // Validate the incoming request data
        $validator = Validator:: make($request->all(),[
            'user_comment' =>'required|string|max:255',
            
         ]);
        if($validator->fails()){
            return responce()->json($validator->error(),422);
        }
        $user = auth()->user();
        // Create a new post
        $userComment = UserComment::create([
            'user_id' => $user->id,
            'comment_id' => $request->comment_id,
            'post_id' => $request->post_id,
            'user_comment' => $request->user_comment,
        ]);

        // Return a JSON response
        return response()->json([
            'message' => 'user Comment created successfully',
            'data' => $userComment
        ], 201);
    }

}
