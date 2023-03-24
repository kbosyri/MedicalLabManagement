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

Route::post('/patient/login',[PatientController::class,'Loginpatient']);
Route::middleware('auth:sanctum')->group(function (){

    Route::get('/patients',[App\Http\Controllers\PatientController::class,'index']);
    Route::get('/patients/{id}',[App\Http\Controllers\PatientController::class,'GetSpecificPatient']);
    Route::post('/createpatients',[App\Http\Controllers\PatientController::class,'creatpatient'])->name('create');
    Route::post('/updatepatients/{id}',[App\Http\Controllers\PatientController::class,'updatepatient'])->name('update');
    Route::delete('/deletepatients/{id}',[App\Http\Controllers\PatientController::class,'deletepatient'])->name('delete');
    Route::post('/patient/logout',[PatientController::class,'Logoutpatient']);
    Route::middleware('patient-register-validation')->post('/patient/register',[PatientController::class,'Registerpatient']);
    Route::post('/patient/changepassword',[StaffAccountsController::class,'ChangePassword']);

});
Route::post('/staff/login',[StaffAccountsController::class,'LoginStaff']);

Route::middleware('auth:sanctum')->group(function (){
    Route::middleware('staff-register-validation')->post('/staff/register',[StaffAccountsController::class,'RegisterStaff']);
    Route::post('/staff/update/{id}',[StaffAccountsController::class,'UpdateStaff']);
    Route::delete('/staff/terminate/{id}',[StaffAccountsController::class,'TerminateStaff']);
    Route::post('/staff/logout',[StaffAccountsController::class,'LogoutStaff']);
    Route::post('/staff/changepassword',[StaffAccountsController::class,'ChangePassword']);
    Route::get('/staff',[StaffAccountsController::class,'GetAllStaff']);
    Route::get('/staff/{id}',[StaffAccountsController::class,'GetStaff']);
});
