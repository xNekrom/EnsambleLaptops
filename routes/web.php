<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProcessorController;
use App\Http\Controllers\MotherboardController;
use App\Http\Controllers\RamModuleController;
use App\Http\Controllers\SsdController;
use App\Http\Controllers\AssemblyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/camara', function () {
    return view('cam.camara');
})->name('camara.index'); // <-- AÑADE ESTA PARTE
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('processors', ProcessorController::class);
    Route::resource('motherboards', MotherboardController::class);
    Route::resource('ram-modules', RamModuleController::class);
    Route::resource('ssds', SsdController::class);
    Route::resource('ram-modules', RamModuleController::class);
    Route::resource('ssd', SsdController::class);
    Route::get('/assemblies', [AssemblyController::class, 'index'])->name('assemblies.index');
});
require __DIR__.'/auth.php';
