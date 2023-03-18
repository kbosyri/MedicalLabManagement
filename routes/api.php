<?php

use App\Http\Controllers\StaffAccountsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\PatientController;


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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
<<<<<<< HEAD
});*/


Route::get('patients',[App\Http\Controllers\PatientController::class,'index']);

Route::post('createpatients',[App\Http\Controllers\PatientController::class,'creat'])->name('create');
Route::get('editepatients/{id}',[App\Http\Controllers\PatientController::class,'edit'])->name('edite');
Route::put('updatepatients/{id}',[App\Http\Controllers\PatientController::class,'update'])->name('update');
Route::get('deletepatients/{id}',[App\Http\Controllers\PatientController::class,'delete'])->name('delete');
Route::post('patients',[App\Http\Controllers\PatientController::class,'store'])->name('store');

Route::post('/staff/login',[StaffAccountsController::class,'LoginStaff']);

Route::middleware('auth:sanctum')->group(function (){
    Route::post('/staff/register',[StaffAccountsController::class,'RegisterStaff']);
    Route::post('/staff/update/{id}',[StaffAccountsController::class,'UpdateStaff']);
    Route::delete('/staff/terminate/{id}',[StaffAccountsController::class,'TerminateStaff']);
    Route::post('/staff/logout',[StaffAccountsController::class,'LogoutStaff']);
    Route::post('/staff/changepassword',[StaffAccountsController::class,'ChangePassword']);
    Route::get('/staff',[StaffAccountsController::class,'GetAllStaff']);
    Route::get('/staff/{id}',[StaffAccountsController::class,'GetStaff']);
});
