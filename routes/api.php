<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AssemblyController;
use App\Http\Controllers\StatsController;

/*
|--------------------------------------------------------------------------
| API Routes - Para el Simulador (JavaScript)
|--------------------------------------------------------------------------
*/

Route::get('/inventory', [InventoryController::class, 'index']);
Route::post('/assemblies', [AssemblyController::class, 'store']);
Route::get('/stats', [StatsController::class, 'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});