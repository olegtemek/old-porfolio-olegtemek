<?php

use App\Http\Controllers\api\ProjectController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\AuthController;
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


Route::group(['middleware' => 'auth:sanctum'], function () {
  Route::get('/check', function () {
    return response()->json(['status' => 200]);
  });
  Route::post('/set-image', [UserController::class, 'setImage']);
  Route::post('/save-project', [ProjectController::class, 'save']);
  Route::post('/delete-project', [ProjectController::class, 'delete']);
});

Route::post('/login', [AuthController::class, 'loginAdmin']);
Route::get('/get-image', [UserController::class, 'getImage']);
Route::get('/projects', [ProjectController::class, 'getAll']);
