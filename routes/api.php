<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Productc;
use App\Http\Controllers\Categoryc;
use App\Http\Controllers\Contactc;
use App\Http\Controllers\Bannerc;
use App\Http\Controllers\Attributec;
use App\Http\Controllers\Couponc;

use App\Http\Controllers\OrderAddress;



use App\Http\Controllers\JWTController;


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
Route::group(['middleware'=>'api'],function($router){
    Route::post('/register',[JWTController::class,'register']);
    Route::post('/login',[JWTController::class,'login']);
    Route::post('/logout',[JWTController::class,'logout']);
    Route::post('/refresh',[JWTController::class,'referesh']);
    Route::post('/profile',[JWTController::class,'profile']);
  }); 

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::apiResource("product",Productc::class);
Route::apiResource("category",Categoryc::class);
Route::apiResource("contact",Contactc::class);
Route::apiResource("banner",Bannerc::class);
Route::apiResource("attribute",Attributec::class);
Route::apiResource("coupon",Couponc::class);

Route::post('/order',[OrderAddress::class,'order']);
Route::post('/address',[OrderAddress::class,'address']);




