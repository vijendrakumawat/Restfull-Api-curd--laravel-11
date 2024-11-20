<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        
        $validator = Validator:: make($request->all(),[
            'comment' =>'required|string|max:255',
            
         ]);
        if($validator->fails()){
            return responce()->json($validator->error(),422);
        }

        $user = auth()->user();
    
        $commenrData = Comment::create([
            'user_id' => $user->id,
            'post_id' => $request->post_id,
            'comment' => $request->comment,
        ]);

        // Return a JSON response
        return response()->json([
            'message' => 'comment created successfully',
            'data' => $commenrData
        ], 201);
    }

    public function update(Request $request, Comment $comment)
    {
        dd($request->all());
        $validated = $request->validate([
            
            'comment' => 'sometimes|string',
        ]);

        $comment->update($validated);
        return response()->json([
            'message' => 'comments updated successfully',
            'data' => $comment
        ], 201);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return response()->json(['message' => 'Comments deleted successfully.'], 200);
    }
}
