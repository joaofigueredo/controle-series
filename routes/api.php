<?php

use App\http\Controllers\Api\SeriesController;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Series;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('/series', SeriesController::class);

    Route::get('/series/{series}/seasons', function(Series $series){
        return $series->seasons;
    });
    
    Route::get('/series/{series}/episodes', );
    
    Route::patch('/episodes/{episode}', function(Episode $episode, Request $request){
        $episode->watched = $request->watched;
        $episode->save();
    
        return $episode;
    });
});

Route::post('/login', function(Request $request){
    $credentials = $request->only(['email', 'password']);
    $user = User::whereEmail($credentials['email'])->first();

    
    if(Auth::attempt($credentials) === false) {
        return response()->json('Unauthorized!', 401);
    };

    $user = Auth::user();
    $user->tokens()->delete();
    $token = $user->createToken('token', ['series:delete']);
    
    return response()->json($token->plainTextToken);
});