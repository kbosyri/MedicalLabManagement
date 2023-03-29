<?php

use App\Http\Controllers\StaffAccountsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\ElementsController;
use App\Http\Controllers\ElementsUpdateAndDeleteController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TestsController;

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
    Route::get('/patients/user',[PatientController::class,'GetUser']);
    Route::post('/patients/changepassword',[PatientController::class,'ChangePassword']);
    Route::get('/patients/{id}',[App\Http\Controllers\PatientController::class,'GetSpecificPatient']);
    Route::post('/createpatients',[App\Http\Controllers\PatientController::class,'creatpatient'])->name('create');
    Route::post('/updatepatients/{id}',[App\Http\Controllers\PatientController::class,'updatepatient'])->name('update');
    Route::delete('/deletepatients/{id}',[App\Http\Controllers\PatientController::class,'deletepatient'])->name('delete');
    Route::post('/patients/logout',[PatientController::class,'Logoutpatient']);
    Route::middleware('patient-register-validation')->post('/patients/register',[PatientController::class,'Registerpatient']);

});
Route::post('/staff/login',[StaffAccountsController::class,'LoginStaff']);

Route::middleware('auth:sanctum')->group(function (){
    Route::middleware('staff-register-validation')->post('/staff/register',[StaffAccountsController::class,'RegisterStaff']);
    
    Route::post('/staff/update/{id}',[StaffAccountsController::class,'UpdateStaff']);
    Route::delete('/staff/terminate/{id}',[StaffAccountsController::class,'TerminateStaff']);
    Route::post('/staff/logout',[StaffAccountsController::class,'LogoutStaff']);
    Route::post('/staff/changepassword',[StaffAccountsController::class,'ChangePassword']);
    Route::get('/staff',[StaffAccountsController::class,'GetAllStaff']);
    Route::get('/staff/user',[StaffAccountsController::class,'GetUser']);
    Route::get('/staff/{id}',[StaffAccountsController::class,'GetStaff']);
});




Route::middleware('auth:sanctum')->group(function(){
    Route::post('/elements/add',[ElementsController::class,'AddElement']);
    Route::get('/elements',[ElementsController::class,'GetElements']);
    Route::get('/elements/{id}',[ElementsController::class,'GetElement']);
    Route::post('/elements/category/add',[ElementsController::class,'AddCategory']);
    Route::post('/elements/values/{id}',[ElementsUpdateAndDeleteController::class,'UpdateElementValueRange']);
    Route::post('/elements/exist/{id}',[ElementsUpdateAndDeleteController::class,'UpdateElementExistValue']);
    Route::post('/elements/{element_id}/value/add',[ElementsController::class,'AddValueRangeToElement']);
    Route::post('elements/{element_id}/exist/add',[ElementsController::class,'AddExistValueToElement']);
    Route::post('/elements/{id}',[ElementsUpdateAndDeleteController::class,'UpdateElement']);
    Route::post('/category/elements/add',[ElementsController::class,'AddCategoryElement']);
    Route::get('/category/elements/',[ElementsController::class,'GetCategoryElements']);
    Route::get('/category/elements/{id}',[ElementsController::class,'GetCategoryElement']);
    Route::get('/category',[ElementsController::class,'GetCategories']);
    Route::get('/category/subcategory/',[ElementsController::class,'GetSubCategories']);
    Route::get('/category/subcategory/{id}',[ElementsController::class,'GetSubcategory']);
    Route::get('/category/{id}',[ElementsController::class,'GetCategory']);
    Route::post('/category/elements/values/{id}',[ElementsUpdateAndDeleteController::class,'UpdateCategoryElementValueRange']);
    Route::post('/category/elements/exist/{id}',[ElementsUpdateAndDeleteController::class,'UpdateCategoryElementExistValue']);
    Route::post('/category/elements/{element_id}/value/add',[ElementsController::class,'AddValueRangeToCategoryElement']);
    Route::post('/categoy/elements/{element_id}/exist/add',[ElementsController::class,'AddExistValueToCategoryElement']);
    Route::post('/category/elements/{id}',[ElementsUpdateAndDeleteController::class,'UpdateCategoryElement']);
    Route::post('/category/subcategory/add',[ElementsController::class,'AddSubcategory']);
    Route::post('/category/subcategory/{id}',[ElementsUpdateAndDeleteController::class,'UpdateSubcategory']);
    Route::post('/category/{id}',[ElementsUpdateAndDeleteController::class,'UpdateCategory']);

    Route::delete('/elements/value/{id}',[ElementsUpdateAndDeleteController::class,'DeleteElementValueRange']);
    Route::delete('/elements/exist/{id}',[ElementsUpdateAndDeleteController::class,'DeleteElementExistValue']);
    Route::delete('/elements/{id}',[ElementsUpdateAndDeleteController::class,'DeleteElement']);
    Route::delete('/category/elements/values/{id}',[ElementsUpdateAndDeleteController::class,'DeleteCategoryElementValueRange']);
    Route::delete('/category/elements/exist/{id}',[ElementsUpdateAndDeleteController::class,'DeleteCategoryElementExistValue']);
    Route::delete('/category/elements/{id}',[ElementsUpdateAndDeleteController::class,'DeleteCategoryElement']);
    Route::delete('/category/remove-element/{id}',[ElementsUpdateAndDeleteController::class,'RemoveCategoryElementFromCategory']);
    Route::delete('/category/subcategory/remove-element/{id}',[ElementsUpdateAndDeleteController::class,'RemoveCategoryElementFromSubcategory']);
    Route::delete('/category/subcategory/{id}',[ElementsUpdateAndDeleteController::class,'DeleteSubcategory']);
    Route::delete('/category/{id}',[ElementsUpdateAndDeleteController::class,'DeleteCategory']);
});

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/tests/add',[TestsController::class,'AddTest']);
    Route::post('/test-groups/add',[TestsController::class,'AddTestGroup']);
    Route::post('/tests/{id}',[TestsController::class,'updateTest']);
    Route::post('/test-groups/{id}',[TestsController::class,'UpdateTestsGroup']);

    Route::get('/tests',[TestsController::class,'GetTests']);
    Route::get('/tests/{id}',[TestsController::class,'GetTest']);
    Route::get('/test-groups',[TestsController::class,'GetTestGroups']);
    Route::get('/test=groups/{id}',[TestsController::class,'GetTestGroups']);

    Route::delete('/tests/{id}',[TestsController::class,'DeleteTest']);
    Route::delete('/test-groups/{id}',[TestsController::class,'DeleteTestGroup']);
});