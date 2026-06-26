<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use AWS\CRT\HTTP\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   public function register(Request $request)
{
    $validate = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'unique:users,email'],
        'password' => ['required', 'min:8', 'confirmed'],
    ]);

    $user = User::create([
        'name' => $validate['name'],
        'email' => $validate['email'],
        'password' => Hash::make($validate['password']),
    ]);

    $token = $user->createToken('api_token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
    ], 201);
}    public function login(Request $request){
      $donnes=$request->validate([
        'email'=>['required','email'],
        'password'=>['required']
      ]);
      if(!Auth::attempt($donnes)){
        return response()->json([
            'message'=>'identifient invalide',

        ],401);
      }
      $user=Auth::user();
      $token=$user->createToken('api_token')->plainTextToken;
      return response()->json([
        'user'=>$user,
        'token'=>$token
      ],200);

    }
    public function logout(Request $request){
  $request->user()->currentAccessToken()->delete();
    return response()->json([
        'message' => 'Deconnexion reussie.',
    ],200);
  }
}
