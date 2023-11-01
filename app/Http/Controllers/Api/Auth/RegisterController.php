<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $registerRequest)
    {
       $data = $registerRequest->validated();
 
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
       
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'user'=> $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
        
    }
}
