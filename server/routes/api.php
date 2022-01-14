<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandController;

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

Route::get("/lands", [LandController::class, "list"]);
Route::get("/landsDimension", [LandController::class, "listDimension"]);
Route::get("/lands/{id}", [LandController::class, "detail"]);
Route::post("/lands", [LandController::class, "create"]);
Route::put("/lands/{id}", [LandController::class, "modify"]);
Route::delete("/lands/{id}", [LandController::class, "destroy"]);

