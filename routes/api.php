<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\MenuController;
use App\http\Controllers\MejaController;

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


//MENU CONTROLL
Route::post('/createMenu',[MenuController::class,'createMenu']);
Route::put('/updateMenu/{id}',[MenuController::class,'updateMenu']);
Route::delete('/deleteMenu/{id}',[MenuController::class,'deleteMenu']);


//MEJA CONTROLL
Route::post('/createMeja',[MejaController::class,'createMeja']);
Route::put('/updateMeja/{id}',[MejaController::class,'updateMeja']);
Route::delete('/deleteMeja/{id}',[MejaController::class,'deleteMeja']);
