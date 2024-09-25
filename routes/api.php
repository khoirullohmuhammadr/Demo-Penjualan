<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthControllerApi;
use App\Http\Controllers\Api\UserControllerApi;
use App\Http\Controllers\Api\ProductControllerApi;

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

Route::group(["middleware" => ["auth:sanctum"]
], 
//Route Show User Login according the bearer token
function(){
Route::get('/profile', [AuthControllerApi::class, 'profile']);
}
);

Route::get('/', [AuthControllerApi::class, 'index'])->name('login');
Route::post('/login', [AuthControllerApi::class, 'login']);
Route::post('/auth', [AuthControllerApi::class, 'auth']);


//Route Management User 
Route::prefix('add-user')->group(function () {
    Route::get('/', [UserControllerApi::class, 'index'])->name('add-user');
    Route::post('/store', [UserControllerApi::class, 'store'])->name('add-user.store');
});

//Route Management Product
Route::prefix('add-product')->group(function () {
    Route::get('/', [ProductControllerApi::class, 'index']);
   
});