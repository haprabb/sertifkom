<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminController;

Route::get('/', [MahasiswaController::class, 'index']);
Route::get('/', [MahasiswaController::class, 'index'])->name('mahasiswa.index');

Route::prefix('admin')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::post('/store', [AdminController::class, 'store'])->name('admin.store');

    Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');

    Route::put('/{id}', [AdminController::class, 'update'])->name('admin.update');

    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

});