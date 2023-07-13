<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',

        ]);
        if ($validator->fails()) {
            return response()->json([

                'errors' => $validator->errors()
            ], 406);
        }
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (!Auth::guard('web')->attempt($credentials)) {
            return response()->json([
                'errors' => 'Incorrect Password or Email'
            ], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        $data = [
            'token' => $token,
            'user' => $user
        ];
        return response()->json(['success' => true, 'data' => $data]);
    }
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 406);
        }
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'confirm_password' => $request->confirm_password
        ]);
        $data = [
            'token' => $user->createToken('auth_token')->plainTextToken,
            "user" => $user
        ];
        return response()->json(['success' => true, 'message' => 'registered successfully', 'data' => $data], 201);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Succesfully Logged out'
        ], 200);
    }
}
