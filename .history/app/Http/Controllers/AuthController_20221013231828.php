<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);
        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            $password = $user->password;
            if (Hash::check($request->password, $password)) { //tuan1809 nó có phải là password mã hóa ở DB.
                $token = Auth::login($user);
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'User created successfully',
                    'user' => Auth::user(),
                    'authorisation' => [
                        'token' => $token,
                        'type' => 'bearer',
                    ]
                ]);
            }
        }
        return response()->json([
            'status' => 'fail',
            'message' => 'Unauthorized',
            'code' => 401 // Unauthorized - Thông tin tài khoản không chính xác.
        ]);

    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:10|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        print_r(123);
        die;

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'username' => $request->phone, //username cũng chính là phone.
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $token = Auth::login($user);
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status',
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
