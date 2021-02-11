<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request) 
    {
        $user = User::where('name', $request->name)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message'=>'error'
            ], 404);
        }

        $token = $user->createToken('test')->plainTextToken;

        $response = [
            'user'=>$user,
            'token'=>$token
        ];

        return response($response, 201);
    }
}
