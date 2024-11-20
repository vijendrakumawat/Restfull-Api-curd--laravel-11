<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
 $validator = Validator:: make($request->all(),[
    'name' =>'required|string|max:255',
    'email' =>'required|string|email|max:255|unique:users',
    'password' =>'required|string|min:4',
 ]);
if($validator->fails()){
    return responce()->json($validator->error(),422);
}
$user = User::create([
    'name' =>$request->name,
    'email' =>$request->email,
    'password' =>hash::make($request->password),
]);
return response()->json(['messsage' =>'user registered successfully']);
}

 public function login(Request $request){

    $user = User::where('email', $request->email)->first();
    
        // if (!$user || $user->status !== 'active') {
        //     return response()->json(['error' => 'User is not active or does not exist.'], 403);
        // }
        $credentials = $request->only('email', 'password');
        $token = JWTAuth::attempt($credentials);
        if (!$token = auth('api')->attempt($credentials)) {
            
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json(['token' => $token], 200);
    
}
public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user->update($request->only([
            'name'
        ]));
        return response()->json(['message' => 'Profile updated successfully'], 200);
    }
}