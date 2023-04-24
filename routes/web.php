<?php

use App\Http\Middleware\VerificarCredencial;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CredencialController;
use App\Http\Controllers\MovimientoEmpleadoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function () {
        if (Auth::check()) {
            return Redirect::to('dashboard');
        } else {
            return view('auth.login');
        }
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::middleware(VerificarCredencial::class)->group(function () {
            Route::get('/movimiento_empleados', [MovimientoEmpleadoController::class, 'index'])->name('movimiento_empleados.index');
            Route::post('/movimiento_empleados', [MovimientoEmpleadoController::class, 'upload'])->name('movimiento_empleados.upload');
        });

        Route::get('/credenciales', [CredencialController::class, 'index'])->name('credenciales.index');
        Route::get('/credenciales/create', [CredencialController::class, 'create'])->name('credenciales.create');
        Route::get('/credenciales/{credencial}/edit', [CredencialController::class, 'edit'])->name('credenciales.edit');
        Route::get('/credenciales/{credencial}', [CredencialController::class, 'show'])->name('credenciales.show');
        Route::post('/credenciales/create', [CredencialController::class, 'upload'])->name('credenciales.upload');
        Route::post('/credenciales', [CredencialController::class, 'store'])->name('credenciales.store');
        Route::patch('/credenciales/{credencial}', [CredencialController::class, 'update'])->name('credenciales.update');
        Route::delete('/credenciales/{credencial}', [CredencialController::class, 'destroy'])->name('credenciales.destroy');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
});
