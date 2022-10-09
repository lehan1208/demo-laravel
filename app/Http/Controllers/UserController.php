<?php

namespace App\Http\Controllers;

use App\Http\BaseResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function Login(Request $request)
    {
        $rules = [
            'username' => 'required|min:2|max:50',
            'password' => 'required|max:50',
        ];

        $message = [
            'username.required' => 'Username is required',
            'password.required' => 'Password is required',
        ];

        $credentials = ['username' => $request->username, 'password' => $request->password];

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return BaseResponse::error(1, $validator->messages()->toJson());
        } else {
            if (auth()->attempt($credentials)) {
                $user = auth()->user();
                $user->tokens()->delete();
                $token = $user->createToken('ApiToken')->plainTextToken;
                $auth_token = explode('|', $token)[1];
                $data = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'fullName' => $user->name,
                    'token' => $auth_token,
                ];
                return BaseResponse::withData($data);
            } else {
                return BaseResponse::error(1, 'Wrong Username or Password');
            }
        }
    }
}
