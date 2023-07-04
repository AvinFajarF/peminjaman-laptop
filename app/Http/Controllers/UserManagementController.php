<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{

    // show all users
    public function index(){
        try {
            $userAll = User::all();
            // response json
            return response()->json([
                'status' => "success",
                "massage" => "show all users successfully",
                "data" => $userAll,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => "error",
                "massage" => "error",
                "error_message" => $th->getMessage(),
            ], 500);
        }
    }


    // create users
    public function create(Request $request)
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

            // response json
            return response()->json([
                'status' => "success",
                "massage" => "create user successfully",
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


    // update user
    public function update(Request $request, $id){
        try {

            // find user
            $userFind = User::findOrFail($id);
            $userFind->update($request->all());


            return response()->json([
                'status' => "success",
                "massage" => "update account successfully",
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => "error",
                "massage" => "update account failed",
                "error_message" => $th->getMessage(),
            ], 500);
        }

    }


    // delete
    public function delete($id){
        try {

            $userFind = User::findOrFail($id);
            $userFind->delete();
            return response()->json([
                'status' => "success",
                "massage" => "delete account successfully",
            ], 200);


        } catch (\Throwable $th) {
            return response()->json([
                'status' => "error",
                "massage" => "delete account failed",
                "error_message" => $th->getMessage(),
            ], 500);
        }
    }

}
