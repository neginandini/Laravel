<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\first;
use App\http\Middleware\Checkstatus;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware([Checkstatus::class])->group(function(){
    Route::get('testing',function(){
   return "Access Granted";
    });





Route::get('/user',[first::class,'user']);
Route::get('/adduser',[first::class,'adduser']);
Route::post('/added',[first::class,'added']);
Route::get('/edituser/{id}',[first::class,'edituser']);
Route::get('/deleteuser/{id}',[first::class,'deluser']);
Route::post('/updateuser',[first::class,'update']);
Route::get('/banner',[first::class,'banner']);
Route::get('/addbanner',[first::class,'addbanner']);
Route::post('/upload',[first::class,'upload']);
Route::get('/editbanner/{id}',[first::class,'editbanner']);
Route::get('/deletebanner/{id}',[first::class,'delbanner']);
Route::post('/updatebanner',[first::class,'updatebanner']);
Route::get('/category',[first::class,'category']);
Route::get('/addcategory',[first::class,'addcat']);
Route::post('/uploadcat',[first::class,'uploadcate']);
Route::get('/deletecat/{id}',[first::class,'deletecat']);
Route::get('/editcat/{id}',[first::class,'editcat']);
Route::post('/updatecat',[first::class,'updatecat']);
Route::get('/products',[first::class,'products']);
Route::get('/addproduct',[first::class,'addproduct']);
Route::post('/addedp',[first::class,'addedp']);
Route::get('/editpro/{id}',[first::class,'editpro']);
Route::post('/updatepro',[first::class,'updatep']);
Route::get('/deletepro/{id}',[first::class,'deletepro']);
Route::get('/image/{id}',[first::class,'images']);
Route::get('/productback',[first::class,'proback']);
Route::get('/imge/{id}',[first::class,'imgg']);
Route::post('/uploadimg',[first::class,'uploadimg']);
Route::get('/coupons',[first::class,'coupons']);
Route::get('/addc',[first::class,'addc']);
Route::post('/addedc',[first::class,'addedc']);
Route::get('/editc/{id}',[first::class,'editc']);
Route::get('/deletec/{id}',[first::class,'deletec']);
Route::post('/updatec',[first::class,'uploadc']);
Route::get('/attr',[first::class,'attr']);
Route::get('addattr',[first::class,'addattr']);
Route::post('/addedattr',[first::class,'addedattr']);
Route::get('/deleteattr/{id}',[first::class,'deleteattr']);
Route::get('/contact',[first::class,'contact']);
Route::get('/deletecontact/{id}',[first::class,'delcontact']);


});
Route::get('/logout',[first::class,'logout']);



