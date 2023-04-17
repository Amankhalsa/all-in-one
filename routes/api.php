<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\API\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('blogposts', BlogController::class);

Route::resource('apicrud', CrudController::class);

