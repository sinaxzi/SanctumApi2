<?php

namespace App\Http\Controllers;

use App\Events\CreateUserEvent;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreRegisterUserRequest;


class AuthController extends Controller
{
    public function register(StoreRegisterUserRequest $request):Response
    {
        $fields = $request->validated();

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'telephone' => $fields['telephone'],
            'user_code' => $fields['user_code'],
            'IsAdmin' => $fields['IsAdmin'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myusertoken')->plainTextToken;


        $response = [
            'name' => $user,
            'token' => $token
        ];



        return response($response,200);
    }

    public function login(LoginUserRequest $request): Response
    {
        $fields = $request->validated();


        $user = User::where('email',$fields['email'])->first();

        if(!$user || !Hash::check($fields['password'],$user->password)) {
            return response([
                'message' => 'ایمیل یا پسورد شما اشتباه است.'
            ], 401);
        }
        $token = $user->createToken('myusertoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response,201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
