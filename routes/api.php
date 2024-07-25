<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ownerController;
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
Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login1', [AuthController::class, 'login'])->middleware('CheckUserType1');
    Route::post('/login2', [AuthController::class, 'login'])->middleware('CheckUserType2');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});
//
Route::post('addmedicine', [ownerController::class,'addmedicine'])->name('addmedicine');
Route::post('searchmed', [ownerController::class,'searchmed']);
Route::get('details/{id}', [ownerController::class,'details']);
Route::post('addtalabia', [ownerController::class,'addtalabia']);
Route::get('getcatogery',[ownerController::class,'getcatogery'])->name('getcatogery');
Route::get('getinvoice/{id}', [ownerController::class,'getinvoice']);
Route::get('getreport/{month}', [ownerController::class,'getreport']);
Route::post('updateOrderStatus',[ownerController::class,'updateOrderStatus']);
Route::post('updatePaymentStatus',[ownerController::class,'updatePaymentStatus']);
Route::get('getOrderStatus', [ownerController::class,'getOrderStatus']);
Route::post('updatePaymentStatus',[ownerController::class,'updatePaymentStatus']);
Route::get('getOrderwarehouse', [ownerController::class,'getOrderwarehouse']);
Route::get('getOrderStatusForPharmacist/{user_id}/{order_id}', [ownerController::class,'getOrderStatusForPharmacist']);
Route::get('getorderpharmacist/{id}', [ownerController::class,'getorderpharmacist']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('getmedicineFromOneCategory/{id}',[ownerController::class,'getmedicineFromOneCategory']);
Route::get('getwarehousestatus/{id}', [ownerController::class,'getwarehousestatus']);
