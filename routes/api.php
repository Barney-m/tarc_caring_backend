<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\APIControllers\UserAPI\Auth\UserLoginAPI;
use App\Http\Controllers\APIControllers\AdminAPI\Auth\AdminLoginAPI;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/user')->group(function(){
    Route::post('/login', [UserLoginAPI::class, 'login']);
    Route::post('/logout', [UserLoginAPI::class, 'logout']);
});

Route::prefix('/admin')->group(function() {
    Route::post('/login', [AdminLoginAPI::class, 'login']);
    Route::post('/logout', [AdminLoginAPI::class, 'logout']);
});
