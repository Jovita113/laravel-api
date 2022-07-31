<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:api')->except(['login', 'register']);
    }
    
    public function register(Request $request) 
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
                   
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ]);

    }

    public function responseToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

    public function login(Request $request)
    {
    	$request->validate([
            'email' => 'required|exists:users',
            'password' => 'required|string|min:6',
        ]);

        if (!$token = auth()->attempt($request->all())){
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        return $this->responseToken($token);
    }

    public function refresh()
    {
        return $this->responseToken(auth()->refresh());
    }

    public function user()
    {
        return auth()->user();
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
        'message'=>'successfully logged out'
        ]);
    }          
}