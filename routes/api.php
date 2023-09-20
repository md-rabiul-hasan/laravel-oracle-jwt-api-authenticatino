<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test', function(){
    return User::all();
});


Route::post('/login', function(Request $request){
    $credentials = $request->only(['email', 'password']);

    if(!$token = auth('api')->attempt($credentials)){
        abort(401, 'unauthenticated user');
    }

    return response()->json([
        'data' => [
            'token' => $token,
            'token_type' => 'bearer'
        ]
        ]);
});

Route::get('/me', function(){
    return Auth::user();
})->middleware('auth:api');