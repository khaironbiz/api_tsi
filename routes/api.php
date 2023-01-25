<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\ObservationController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\CodeController;
use App\Http\Controllers\Api\v1\HearthRateController;
use App\Http\Controllers\Api\v1\MaritalStatusController;
use App\Http\Controllers\Api\v1\ProfileController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/notAuthorized',[AuthController::class,'notAuthorised'])->name('notAuthorised');
Route::post('/v1/auth/login',[AuthController::class,'login']);
Route::delete('/v1/auth/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
Route::post('/v1/auth/register',[AuthController::class,'register']);
Route::post('/v1/auth/aktifasi',[AuthController::class,'activation_request']);
Route::put('/v1/auth/aktifasi',[AuthController::class,'aktifasi_akun']);
Route::post('/v1/auth/forgotpassword',[AuthController::class,'forgot_password']);
Route::put('/v1/auth/resetpassword',[AuthController::class,'update_password']);

Route::get('/v1/profile', [ProfileController::class, 'index'])->middleware('auth:sanctum');
Route::post('/v1/profile/username', [ProfileController::class, 'update_username'])->middleware('auth:sanctum');

Route::post('/v1/files', [FileController::class, 'store']);

Route::resource('/education', EducationController::class);
Route::resource('/users', UserController::class)->middleware('auth:sanctum');
Route::get('/v1/user/{nik}', [UserController::class, 'showNik'])->middleware('auth:sanctum');

Route::resource('/customers', CustomerController::class);
Route::resource('/observations', ObservationController::class)->middleware('auth:sanctum');

Route::post('/spo2/{id_pasien}',[HearthRateController::class,'store'])->middleware('auth:sanctum');
Route::post('/bloodPressure/{id_pasien}',[ObservationController::class, 'bloodPressure'] )->middleware('auth:sanctum');
Route::post('/cholesterol/{id_pasien}',[ObservationController::class, 'cholesterol'] )->middleware('auth:sanctum');
Route::post('/glucose/{id_pasien}',[ObservationController::class, 'glucose'] )->middleware('auth:sanctum');
Route::post('/uricAcid/{id_pasien}',[ObservationController::class, 'uricAcid'] )->middleware('auth:sanctum');
Route::post('/weight/{id_pasien}',[ObservationController::class, 'weight'] )->middleware('auth:sanctum');
Route::post('/height/{id_pasien}',[ObservationController::class, 'height'] )->middleware('auth:sanctum');


Route::post('v1/codes', [CodeController::class, 'store'])->middleware('auth:sanctum');
Route::get('v1/code/{id}', [CodeController::class, 'show'])->middleware('auth:sanctum');
Route::get('v1/codes', [CodeController::class, 'index'])->middleware('auth:sanctum');
Route::get('v1/maritalStatus', [MaritalStatusController::class, 'index'])->middleware('auth:sanctum');
