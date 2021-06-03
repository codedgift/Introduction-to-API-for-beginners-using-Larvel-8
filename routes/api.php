<?php

use App\Http\Controllers\CakeController;
use App\Http\Controllers\StudentController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//------ Student Routes ---------------------------//
Route::group(['prefix' => 'v1'], function() {

    //---------- Create Student --------------------------------------//
    Route::post('/create/student', [StudentController::class, 'create']);

    //---------- Fetch Student --------------------------------------//
    Route::get('/get/student', [StudentController::class, 'getStudent']);

    //---------- Fetch Student --------------------------------------//
    Route::post('/edit/student/{id}', [StudentController::class, 'update']);

    //---------- Fetch Student --------------------------------------//
    Route::get('/delete/student/{id}', [StudentController::class, 'delete']);

});

//----------- Cake Routes ----------------------------//
Route::group(['prefix' => 'v1'], function() {

    //---------- Create Cake --------------------------------------//
    Route::post('/create/cake', [CakeController::class, 'create']);

    //---------- Fetch all Cakes --------------------------------------//
    Route::get('/view/cake', [CakeController::class, 'show']);

    //---------- Edit Cake --------------------------------------//
    Route::post('/edit/cake/{id}', [CakeController::class, 'edit']);

    //---------- Delte Cake --------------------------------------//
    Route::get('/delete/cake/{id}', [CakeController::class, 'delete']);

});
