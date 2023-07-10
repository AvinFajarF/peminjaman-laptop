<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use App\Models\RentLogs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LaptopRentalManagementController extends Controller
{


    // show all data laptop
    public function index()
    {

        try {

            return response()->json([
                'status' => "success",
                "massage" => "show all users successfully",
                "data" => RentLogs::with(["user", "laptop"])->get(),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => "error",
                "massage" => "error",
            ], 500);
        }
    }

    // loan
    public function loan($id)
    {
        try {
            // check status laptop
            $findLaptop = Laptop::findOrFail($id);

            if ($findLaptop->status != "borrowed") {

                $loan = RentLogs::create([
                    "user_id" => Auth::user()->id,
                    "laptop_id" => $id,
                    "return_date" => null,
                    "loan_date" => Carbon::now("Asia/Jakarta")
                ]);

                $findLaptop->status = "borrowed";
                $findLaptop->save();

                $loan->load("user");

                return response()->json([
                    'status' => "success",
                    "massage" => "loan laptop successfully",
                    "data" => $loan,
                ], 200);
            } else {

                return response()->json([
                    'status' => "error",
                    "massage" => "laptop is not available",
                ], 400);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => "error",
                "massage" => "error",
                "error" => $th->getMessage()
            ], 500);
        }
    }


    // return
    public function return($id)
    {

        try {

            $findLaptop = Laptop::findOrFail($id);

            if ($findLaptop->status != "available") {

                $rentLogs = RentLogs::where([
                    ["user_id", "=", Auth::user()->id],
                    ["laptop_id", "=", $id]
                ])->first();

                // update colum return date
                $rentLogs->return_date = Carbon::now("Asia/Jakarta");
                $rentLogs->save();

                // update colum status in table laptop
                $findLaptop->status = "available";
                $findLaptop->save();

                return response()->json([
                    'status' => "success",
                    "massage" => "return laptop successfully",
                    "data" => $rentLogs,
                ], 200);
            } else {
                return response()->json([
                    'status' => "error",
                    "message" => "laptop is already available",
                ], 400);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => "error",
                "massage" => "error",
                "error" => $th->getMessage()
            ], 500);
        }
    }
}
