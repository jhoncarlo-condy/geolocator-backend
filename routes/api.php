<?php

use App\Http\Controllers\GeoInfoController;
use App\Http\Controllers\SearchHistoryController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Str;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/tokens/create', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    $token = $user->createToken(Str::uuid());

    return ['token' => $token->plainTextToken];
});

Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('geo-info', GeoInfoController::class);

    Route::apiResource('search-history', SearchHistoryController::class);
});

