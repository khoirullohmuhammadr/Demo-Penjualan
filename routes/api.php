<?php

use App\Models\User;
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

// Route::prefix('/login')->group(function(){
//   Route::get('/' ,[AuthControllerApi::class, 'index']);
//   Route::post('/auth' ,[AuthControllerApi::class, 'login']);
// });

Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Invalid login details'
        ], 401);
    }

    // Generate token
    $token = $user->createToken('API Token')->plainTextToken;

    return response()->json([
        'status'=>true,
        'message'=>'successfully log in',
        'token' => $token
    ]);
});

Route::post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();

    return response()->json(['message' => 'Logged out']);
});

Route::middleware('auth:sanctum')->get('/list-product', [ProductControllerApi::class, 'index']);
Route::middleware('auth:sanctum')->post('/sell-product', [ProductControllerApi::class, 'sell']);
//Route Management Product
// Route::prefix('list-product')->middleware(['auth:sanctum', 'role:sales'])->group(function () {
//     Route::get('/', [ProductControllerApi::class, 'index']);
   
// });