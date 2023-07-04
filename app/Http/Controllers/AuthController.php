<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    // register
    public function register(Request $request)
    {

        // request validation
        $validasi = $request->validate(
            [
                "username" => "string|required",
                "password" => "required",
                "email" => "email|required",
                "number_phone" => "integer|required",
                "address" => "required",
                "class" => "required",
            ],
        );


        try {


            $validasi["password"] = Hash::make($validasi["password"]);
            $user =  User::create($validasi);
            $token = $user->createToken($request->email)->plainTextToken;

            auth()->login($user);

            // response json
            return response()->json([
                'status' => "success",
                "massage" => "create account successfully",
                "token" => $token,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => "error",
                "massage" => "error",
                "error_message" => $th->getMessage(),
            ], 500);
        }
    }



    // login
    public function login(Request $request)
    {
        $validasi  = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        try {

            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['Kredensial yang diberikan salah.'],
                ]);
            }




            // create token and send res json
            $token = $user->createToken($request->email)->plainTextToken;
            return response()->json([
                'status' => "success",
                "massage" => "Anda berhasil login",
                "token" => $token
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => "error",
                "massage" => "Email atau password yang anda berikan salah"
            ], 401);
        }
    }
}
