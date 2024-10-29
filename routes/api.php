<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');




Route::post('/user/login', [UserController::class, 'login']);

// Route::post('/get/login/user', function (Request $request) {
//     return auth('api')->user();
// })->middleware('auth:api');


Route::group([
    "middleware" => ['auth:api']
], function(){
    Route::get('/user/get-all', [UserController::class, 'index']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::get('/user/get/{user}', [UserController::class, 'show']);
    Route::get('/user/edit/{user}', [UserController::class, 'edit']);
    Route::post('/user/update/{user}', [UserController::class, 'update']);
    Route::delete('/user/delete/{user}', [UserController::class, 'destroy']);
    Route::post('/user/logout/', [UserController::class, 'logout']);
});
