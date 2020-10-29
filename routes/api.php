<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\APIControllers\UserAPI\Auth\UserLoginAPI;
use App\Http\Controllers\APIControllers\AdminAPI\Auth\AdminLoginAPI;
use App\Http\Controllers\APIControllers\UserAPI\FeedbackAPIController;
use App\Http\Controllers\AdminControllers\ManageManagementController;

use Illuminate\Support\Facades\DB;

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
    Route::post('/submit', [FeedbackAPIController::class, 'submit']);

    Route::group(['middleware' => 'auth:api'], function() {
        //Feedbacks
        Route::get('/feedbacks', [FeedbackAPIController::class, 'index']);
        Route::get('/feedbacks/facilities', [FeedbackAPIController::class, 'facilities']);
        Route::get('/feedbacks/foods', [FeedbackAPIController::class, 'foods']);
        Route::get('/feedbacks/educations', [FeedbackAPIController::class, 'educations']);
        Route::get('/feedbacks/services', [FeedbackAPIController::class, 'services']);
        Route::get('/feedbacks/approved', [FeedbackAPIController::class, 'approved']);
        Route::get('/feedbacks/urgent', [FeedbackAPIController::class, 'urgent']);
        Route::get('/feedbacks/history', [FeedbackAPIController::class, 'history']);
        Route::get('/feedbacks/history/facilities', [FeedbackAPIController::class, 'facilitiesHistory']);
        Route::get('/feedbacks/history/foods', [FeedbackAPIController::class, 'foodsHistory']);
        Route::get('/feedbacks/history/educations', [FeedbackAPIController::class, 'educationsHistory']);
        Route::get('/feedbacks/history/services', [FeedbackAPIController::class, 'servicesHistory']);
        Route::get('/feedbacks/user_history/{id?}', [FeedbackAPIController::class, 'userHistory']);
        Route::get('/feedbacks/{priority?}', [FeedbackAPIController::class, 'index']);
        Route::get('/lecturer/{faculty?}', [FeedbackAPIController::class, 'lecturer']);
    });
});

Route::prefix('/admin')->group(function() {
    Route::post('/login', [AdminLoginAPI::class, 'login']);
    Route::post('/logout', [AdminLoginAPI::class, 'logout']);


    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('/manage_management/{id?}', [ManageManagementController::class, 'details']);
    });

});
