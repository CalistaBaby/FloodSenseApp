<?php
use Illuminate\Support\Facades\Route;
use App\Modules\Masyarakat\Controllers\LaporanController;
use App\Modules\Masyarakat\Controllers\DashboardController;

Route::middleware(['auth','role:masyarakat'])
    ->prefix('masyarakat')
    ->name('masyarakat.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/laporan', [LaporanController::class,'index'])
            ->name('laporan.index');

        Route::get('/laporan/create', [LaporanController::class,'create'])
            ->name('laporan.create');

        Route::post('/laporan', [LaporanController::class,'store'])
            ->name('laporan.store');

        Route::get('/laporan/{id}/detail', [LaporanController::class,'detail'])
            ->name('laporan.detail');
});













/*Route::middleware(['auth','role:masyarakat'])->group(function () {
    Route::get('/dashboard', fn() => view('Masyarakat::dashboard'));
    Route::get('/masyarakat/laporan', [LaporanController::class,'index']);
    Route::get('/masyarakat/laporan/create', [LaporanController::class,'create']);
    Route::post('/masyarakat/laporan', [LaporanController::class,'store']);
});*/


/*use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:masyarakat'])->group(function () {
    Route::get('/dashboard', fn () => view('Masyarakat::dashboard'))
        ->name('masyarakat.dashboard');
});*/

