<?php

use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Livewire\ReviewForm;
use App\Http\Middleware\CorsMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarModelController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('cars',CarController::class);
// Route::middleware([CorsMiddleware::class])->group(function () {
//     Route::post('/auth/register', [AuthController::class, 'register']);
//     Route::post('/auth/login', [AuthController::class, 'login']);
//     // Add other routes that need CORS headers here
// });
Route::apiResource('cars',CarController::class);

Route::group(['prefix' => 'auth'], function ($router){
    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
    Route::post('google', [AuthController::class, 'googleLogin']);
});
 
Route::post('/forget-password',[ForgetPasswordController::class,'sendResetLinkEmail']);
Route::post('/reset-password',[ResetPasswordController::class,'reset'])->name('password.reset');
// Route::put('update', [AuthController::class,'update']);
Route::middleware('auth:api')->post('/reviews', [ReviewController::class, 'store']);
Route::get('/cars/{carId}/reviews', [ReviewController::class, 'index']);
Route::get('/car-models', [CarModelController::class, 'index']);
Route::get('/car-models/{id}', [CarModelController::class, 'show']);
Route::get('/car-models/car/{car_id}', [CarModelController::class, 'getByCarId']);

Route::middleware(['auth:api'])->group(function(){
    Route::put('/user/profile', [AuthController::class,'update']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
    
    Route::post('/car-models', [CarModelController::class, 'store']);
    
    Route::put('/car-models/{id}', [CarModelController::class, 'update']);
    Route::delete('/car-models/{id}', [CarModelController::class, 'destroy']);
    
});