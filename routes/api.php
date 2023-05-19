<?php

use App\Http\Controllers\StaffAccountsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\AdController;
use App\Http\Controllers\AdvertisController;
use App\Http\Controllers\ElementsController;
use App\Http\Controllers\ElementsUpdateAndDeleteController;
use App\Http\Controllers\JobapplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientTestController;
use App\Http\Controllers\PatientTestsValueController;
use App\Http\Controllers\TestReportController;
use App\Http\Controllers\TestsController;
use App\Models\Patienttest;

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
    Route::get('/patients/{id}/tests',[PatientTestController::class,'GetPatientTests']);
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
    Route::get('/staff/labstaff',[StaffAccountsController::class,'GetLabStaff']);
    Route::get('/staff/tests',[PatientTestController::class,'GetStaffPatientTests']);
    Route::get('/staff/{id}',[StaffAccountsController::class,'GetStaff']);
});




Route::middleware('auth:sanctum')->group(function(){

    Route::get('/elements',[ElementsController::class,'GetElements']);
    Route::get('/elements/filter',[ElementsController::class,'FilterTests']);
    Route::post('/elements/add',[ElementsController::class,'AddElement']);
    Route::post('/elements/category/add',[ElementsController::class,'AddCategory']);
    Route::post('/elements/values/{id}',[ElementsUpdateAndDeleteController::class,'UpdateElementValueRange']);
    Route::post('/elements/exist/{id}',[ElementsUpdateAndDeleteController::class,'UpdateElementExistValue']);
    Route::post('/elements/{element_id}/value/add',[ElementsController::class,'AddValueRangeToElement']);
    Route::post('elements/{element_id}/exist/add',[ElementsController::class,'AddExistValueToElement']);
    Route::post('/elements/{id}/units',[ElementsController::class,'AddUnitToElement']);
    Route::post('/elements/{id}',[ElementsUpdateAndDeleteController::class,'UpdateElement']);
    Route::get('/elements/{id}/units',[ElementsController::class,'GetElementUnits']);
    Route::get('/elements/{id}',[ElementsController::class,'GetElement']);
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
    Route::get('/category/elements/{id}/units',[ElementsController::class,'GetCategoryElementUnits']);
    Route::post('/category/elements/{id}/units',[ElementsController::class,'AddUnitToCategoryElement']);
    Route::post('/category/elements/{id}',[ElementsUpdateAndDeleteController::class,'UpdateCategoryElement']);
    Route::post('/category/subcategory/add',[ElementsController::class,'AddSubcategory']);
    Route::post('/category/subcategory/{id}',[ElementsUpdateAndDeleteController::class,'UpdateSubcategory']);
    Route::post('/category/{id}',[ElementsUpdateAndDeleteController::class,'UpdateCategory']);

    Route::middleware('admin-auth')->group(function(){
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
    
});

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/tests/add',[TestsController::class,'AddTest']);
    Route::post('/test-groups/add',[TestsController::class,'AddTestGroup']);
    Route::post('/tests/{id}',[TestsController::class,'updateTest']);
    Route::post('/test-groups/{id}',[TestsController::class,'UpdateTestsGroup']);
    
    Route::middleware('admin-auth')->group(function(){
        Route::delete('/tests/{id}',[TestsController::class,'DeleteTest']);
        Route::delete('/test-groups/{id}',[TestsController::class,'DeleteTestGroup']);
    });
});

Route::get('/tests',[TestsController::class,'GetTests']);
Route::get('/tests/{id}',[TestsController::class,'GetTest']);
Route::get('/test-groups',[TestsController::class,'GetTestGroups']);
Route::get('/test-groups/{id}',[TestsController::class,'GetTestGroup']);


Route::middleware('auth:sanctum')->group(function(){
    Route::post('/add_patient_test',[PatientTestController::class,'add_patient_test']);
    Route::post('/update_patient_test/{id}',[PatientTestController::class,'update_patient_test']);
    Route::post('/patienttests/bulk',[PatientTestController::class,'AddPatientTests']);
    Route::post('/patienttests/{id}/values',[PatientTestsValueController::class,'AddValuesToTest']);
    Route::get('/patienttests/unaudited',[PatientTestController::class,'GetUnAuditedTests']);
    Route::get('patienttests/{id}/values',[PatientTestsValueController::class,'GetTestValues']);
    Route::get('/user/tests',[PatientTestController::class,'GetUserTests']);
    Route::get('/patienttests/staff/patients',[PatientTestController::class,'GetStaffRecentPatinets']);
    Route::get('/patienttests/patients',[PatientTestController::class,'GetRecentPatinets']);
    Route::get('/patienttests/new',[PatientTestController::class,'GetUnseen']);
    Route::get('/patienttests/archive',[PatientTestController::class,'GetArchive']);
    Route::get('/patienttests/{id}/download',[PatientTestsValueController::class,'SendResultToPatient']);
    Route::post('/patienttests/{id}/set-seen',[PatientTestController::class,'SetSeen']);
    Route::get('/patienttests/{id}',[PatientTestController::class,'GetPatientTest']);
});
Route::get('/test-groups/{id}/tests',[TestsController::class,'GetGroupTests']);
Route::get('/test-groups/{id}',[TestsController::class,'GetTestGroup']);

Route::middleware('auth:sanctum')->group(function(){

    Route::get('/reports/tests',[TestReportController::class,'GetTestReport']);
    Route::get('/reports/staff/tests',[TestReportController::class,'GetStaffTests']);
    Route::get('/reports/patients/tests',[TestReportController::class,'GetPatientTests']);
    
});
Route::get('/patienttests/{id}/pdf',[PatientTestsValueController::class,'MakePDF']);
Route::get('/patienttests/{id}/view',[PatientTestsValueController::class,'seepdf']);

Route::get('/show_all_ad',[AdController::class,'show_all_ad']);
Route::get('/get_ad/{id}',[AdController::class,'show_ad']);

Route::middleware('auth:sanctum')->group(function(){
Route::post('/create_ad',[AdController::class,'create_ad']);
Route::post('/update_ad/{id}',[AdController::class,'update_ad']);
});

Route::get('/show_all_jobapplications',[JobapplicationController::class,'show_all_jobapplications']);
Route::get('/get_jobapp/{id}',[JobapplicationController::class,'get_jobapplication']);

Route::middleware('auth:sanctum')->group(function(){
Route::post('/create_jobapplications',[JobapplicationController::class,'create_jobapplications']);
Route::post('/update_jobapplications/{id}',[JobapplicationController::class,'update_jobapplications']);
});


