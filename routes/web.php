<?php

use App\Http\Controllers\MaterialCategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GatePassController;
use App\Http\Controllers\DepartmentController;
use App\Models\GatePass;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $gatepasses = GatePass::latest()->get();

    return view('dashboard', compact('gatepasses'));

})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::resource('departments', DepartmentController::class);

    Route::resource(
        'materials',
        MaterialController::class
    );

    Route::resource(
        'material-categories',
        MaterialCategoryController::class
    );

    Route::resource(
        'gatepasses',
        GatePassController::class
    );

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';