<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset as ModelsPasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NewPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $email = ModelsPasswordReset::where("email", $request->email)->first();
        if ($email) {
            $email->update(["token" => Str::random(60)]);
        } else {

            ModelsPasswordReset::create([
                'email'     => $request->email,
                'token'     => Str::random(60),
            ]);
        }

        return response()->json(['status' => 'Success', 'data' => ModelsPasswordReset::find($request->email)], 201);
    }
    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 406);
        }
        $passRes = ModelsPasswordReset::find($request->email);

        if ($passRes->token == $request->token) {
            $user = User::where("email", $passRes->email)->first();
            $user->update(["password" => $request->password]);
            return response()->json(["success" => true, "message" => "Successfully updated password"]);
        } else {
            return response()->json(["success" => false, "message" => "Invalid token"], 401);
        }


        return response([
            'message' => "Error"
        ], 500);
    }
}
