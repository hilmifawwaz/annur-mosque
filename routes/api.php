<?php

use App\Http\Controllers\API\NewsAgreementController;
use App\Http\Controllers\API\NewsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('news', [NewsController::class, 'get']);
Route::post('news/post', [NewsController::class, 'post']);
Route::get('news/delete/{id}', [NewsController::class, 'delete']);

Route::get('agreement', [NewsAgreementController::class, 'get']);
