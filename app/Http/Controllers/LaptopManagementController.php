<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Illuminate\Http\Request;

class LaptopManagementController extends Controller
{
    // show all data laptop
    public function index()
    {

        try {

            return response()->json([
                'status' => "success",
                "massage" => "show all users successfully",
                "data" => Laptop::all(),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => "error",
                "massage" => "error",
            ], 500);
        }
    }


    // create data laptop
    public function create(Request $request)
    {
        // request validation
        $validasi = $request->validate([
            "code" => "required",
            "brand" => "required",
        ]);

        try {

            // store to database
            Laptop::create($validasi);

            return response()->json([
                "status" => "success",
                "massage" => "create data successfully",
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => "error",
                "massage" => "error",
            ], 500);
        }
    }

    // update data laptop
    public function update(Request $request, $id)
    {

        try {

            // find data laptop
            $findLaptop = Laptop::findOrFail($id);
            // update data laptop
            $findLaptop->update($request->all());
            // return response json
            return response()->json([
                'status' => "success",
                "massage" => "update data successfully",
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => "error",
                "massage" => "error",
            ], 500);
        }
    }

    // delete data laptop
    public function delete($id)
    {
        try {

            $laptopFind = Laptop::findOrFail($id);
            $laptopFind->delete();
            return response()->json([
                'status' => "success",
                "massage" => "delete data laptop successfully",
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => "error",
                "massage" => "delete data laptop failed",
            ], 500);
        }
    }
}
