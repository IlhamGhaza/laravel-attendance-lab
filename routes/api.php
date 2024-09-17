<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//login
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

//group with auth sanctun
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::apiResource('/users', App\Http\Controllers\Api\UserController::class);
    Route::get('/company', [App\Http\Controllers\Api\BuildingController::class, 'show']);
    //checkin
    Route::post('/checkin', [App\Http\Controllers\Api\AttendanceController::class, 'checkin']);
    //checkout
    Route::post('/checkout', [App\Http\Controllers\Api\AttendanceController::class, 'checkout']);
    //is checkinm');
    Route::get('/is-checkin', [App\Http\Controllers\Api\AttendanceController::class, 'isCheckedin']);
    //update profile
    Route::post('/update-profile', [App\Http\Controllers\Api\AuthController::class, 'updateProfile']);
    //create permission
    Route::apiResource('/api-permissions', App\Http\Controllers\Api\PermissionController::class);
    //notes
    Route::apiResource('/api-notes', App\Http\Controllers\Api\NoteController::class);
    //update fcm token
    Route::post('/update-fcm-token', [App\Http\Controllers\Api\AuthController::class, 'updateFcmToken']);
    //get attendance
    Route::get('/api-attendances', [App\Http\Controllers\Api\AttendanceController::class, 'index']);
});

////logout
// Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');
// Route::apiResource('/users', App\Http\Controllers\Api\UserController::class)->middleware('auth:sanctum');
// Route::get('/company', [App\Http\Controllers\Api\BuildingController::class, 'show'])->middleware('auth:sanctum');
// //checkin
// Route::post('/checkin', [App\Http\Controllers\Api\AttendaceController::class, 'checkin'])->middleware('auth:sanctum');
// //checkout
// Route::post('/checkout', [App\Http\Controllers\Api\AttendaceController::class, 'checkout'])->middleware('auth:sanctum');
// //is checkin
// Route::get('/is-checkin', [App\Http\Controllers\Api\AttendaceController::class, 'isCheckedin'])->middleware('auth:sanctum');
// //update profile
// Route::post('/update-profile', [App\Http\Controllers\Api\AuthController::class, 'updateProfile'])->middleware('auth:sanctum');
// //create permission
// Route::apiResource('/api-permissions', App\Http\Controllers\Api\PermissionController::class)->middleware('auth:sanctum');
// //notes
// Route::apiResource('/api-notes', App\Http\Controllers\Api\NoteController::class)->middleware('auth:sanctum');
// //update fcm token
// Route::post('/update-fcm-token', [App\Http\Controllers\Api\AuthController::class, 'updateFcmToken'])->middleware('auth:sanctum');
// //get attendance
// Route::get('/api-attendances', [App\Http\Controllers\Api\AttendaceController::class, 'index'])->middleware('auth:sanctum');
