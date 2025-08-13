<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Ruta de bienvenida (puedes cambiarla por el dashboard si prefieres)
Route::get('/', function () {
    return redirect()->route('login');
});

// Autenticación
Auth::routes(['register' => false]); // Desactiva registro si no es necesario

// Rutas protegidas (requieren autenticación)
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Inventario
    Route::resource('inventory', InventoryController::class);
    Route::get('inventory/export', [InventoryController::class, 'export'])->name('inventory.export');
    
    // Devoluciones
    Route::resource('returns', ReturnController::class);
    Route::get('returns/export', [ReturnController::class, 'export'])->name('returns.export');
    
    // Exportaciones
    Route::resource('exports', ExportController::class);
    Route::get('exports/export', [ExportController::class, 'export'])->name('exports.export');
    
    // Importaciones
    Route::resource('imports', ImportController::class);
    Route::get('imports/export', [ImportController::class, 'export'])->name('imports.export');
    
    // Clientes
    Route::resource('clients', ClientController::class);
    Route::get('clients/export', [ClientController::class, 'export'])->name('clients.export');
    
    // Configuraciones
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
    });
    
    // Ruta home alternativa (opcional)
    Route::get('/home', function () {
        return redirect()->route('dashboard');
    })->name('home');


    // Histórico de movimientos
Route::prefix('history')->group(function () {
    Route::get('/', [HistoryController::class, 'index'])->name('history.index');
    Route::post('/download-monthly', [HistoryController::class, 'downloadMonthly'])->name('history.download.monthly');
    Route::post('/download-annual', [HistoryController::class, 'downloadAnnual'])->name('history.download.annual');
});

    // Rutas de API (opcional)
    Route::prefix('api')->group(function () {
        Route::get('inventory', [InventoryController::class, 'apiIndex'])->name('api.inventory.index');
        Route::get('returns', [ReturnController::class, 'apiIndex'])->name('api.returns.index');
        Route::get('exports', [ExportController::class, 'apiIndex'])->name('api.exports.index');
        Route::get('imports', [ImportController::class, 'apiIndex'])->name('api.imports.index');
        Route::get('clients', [ClientController::class, 'apiIndex'])->name('api.clients.index');
    });


});