<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admin\Controllers\AdminLaporanController;


Route::middleware(['auth'])
    ->get('/laporan/{id}/detail', [AdminLaporanController::class, 'showDetail'])
    ->name('laporan.detail.public');

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('Admin::dashboard');
        })->name('dashboard');

        Route::get('/laporan/create', [AdminLaporanController::class, 'create'])
            ->name('laporan.create');

        Route::post('/laporan', [AdminLaporanController::class, 'store'])
            ->name('laporan.store');

        Route::get('/laporan/validasi', [AdminLaporanController::class, 'validasi'])
            ->name('laporan.validasi');

        Route::patch('/laporan/{id}', [AdminLaporanController::class, 'updateStatus'])
            ->name('laporan.updateStatus');

        Route::get('/laporan/{id}/detail', [AdminLaporanController::class, 'showDetail'])
            ->name('laporan.showDetail');

        Route::put('/laporan/{id}', [AdminLaporanController::class, 'update'])
            ->name('laporan.update');

        Route::delete('/laporan/{id}', [AdminLaporanController::class, 'destroy'])
            ->name('laporan.destroy');
    });



/*Route::middleware(['auth','role:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/laporan/create', [AdminLaporanController::class, 'create']);
        Route::post('/laporan', [AdminLaporanController::class, 'store']);
        Route::get('/laporan/validasi', [AdminLaporanController::class, 'validasi']);
        Route::patch('/laporan/{id}', [AdminLaporanController::class, 'updateStatus']);
});*/




/*Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('Admin::dashboard'));
    Route::get('/admin/laporan/create', [AdminLaporanController::class,'create']);
    Route::post('/admin/laporan', [AdminLaporanController::class,'store']);
    Route::get('/admin/laporan/validasi', [AdminLaporanController::class,'validasi']);
    Route::patch('/admin/laporan/{id}', [AdminLaporanController::class,'updateStatus']);
});*/




