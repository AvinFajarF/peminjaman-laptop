<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaptopManagementController;
use App\Http\Controllers\LaptopRentalManagementController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix("/v1")->group(function () {

    // authentication routes
    Route::controller(AuthController::class)->group(function () {
        // reguster router
        Route::post('register', 'register');
        // login router
        Route::post('login', 'login');
    });

    // group middelware routes
    Route::middleware(["auth:sanctum", "check.status.user"])->group(function () {
        // crud user routes
        Route::controller(UserManagementController::class)->middleware("admin.check")->group(function () {
            // read router
            Route::get("dashboard/user", "index");
            // create router
            Route::post("dashboard/user", "create");
            // update router
            Route::put("dashboard/user/{id}", "update");
            // delete router
            Route::delete("dashboard/user/{id}", "delete");
            // banned router
            Route::delete("dashboard/user/ban/{id}", "blockUser");
        });


        // crud laptop routes
        Route::controller(LaptopManagementController::class)->middleware("admin.check")->group(function () {
            // read router
            Route::get("dashboard/laptop", "index");
            // create router
            Route::post("dashboard/laptop", "create");
            // update router
            Route::put("dashboard/laptop/{id}", "update");
            // delete router
            Route::delete("dashboard/laptop/{id}", "delete");
        });


        Route::controller(LaptopRentalManagementController::class)->group(function () {
            // read router
            Route::get("dashboard/laptop/rent", "index")->middleware("admin.check");
            //    rental laptop
            Route::post("laptop/rent/loan/{id}", "loan");
            //    retrun laptop
            Route::post("laptop/rent/return/{id}", "return");
        });
    });
});
