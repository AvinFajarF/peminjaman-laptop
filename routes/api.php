<?php

use App\Http\Controllers\AuthController;
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

    // crud user routes
    Route::controller(UserManagementController::class)->middleware("auth:sanctum")->group(function () {
        // read router
        Route::get("dashboard/user", "index");
        // create router
        Route::post("dashboard/user", "create");
        // update router
        Route::put("dashboard/user/{id}", "update");
        // delete router
        Route::delete("dashboard/user/{id}", "delete");
    });
});
