<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $posts = Post::with(['comments.userComments.user'])->get();

        // $posts = Post::with(['user', 'comments'])->get();
        return response()->json($posts, 200);
    }


    public function store(Request $request)
    {
        
        // Validate the incoming request data
        $validator = Validator:: make($request->all(),[
            'title' =>'required|string|max:255',  
         ]);
        if($validator->fails()){
            return responce()->json($validator->error(),422);
        }

        // Create a new post
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
        ]);

        // Return a JSON response
        return response()->json([
            'message' => 'Post created successfully',
            'data' => $post
        ], 201);
    }
    function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found.'], 404);
        }
        // Validate request data
        $validatedData = $request->validate([
            'title' => 'sometimes|string|max:255',
            
        ]);
        $post->update($validatedData);

        return response()->json([
            'message' => 'Post updated successfully.',
            'data' => $post,
        ], 200);
    }

    // Delete a post
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found.'], 404);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully.'], 200);
    }
}
