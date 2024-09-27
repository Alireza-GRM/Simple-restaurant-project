<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required | string',
            'email' => 'required | email | unique:users,email',
            'password' => 'required | string'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $token = $user->createToken('Alireza')->toArray()['plainTextToken'];
        return $token;
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required | email',
            'password' => 'required | string'
        ]);

        $user = User::where('email' , '=' , $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password))
        {
            return response(['Status' => 'user not found !'] , 401);
        }

        $token = $user->createToken('Alireza')->toArray()['plainTextToken'];
        return response(['Token' => $token] , 200);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response('done' , 200);
    }
}
