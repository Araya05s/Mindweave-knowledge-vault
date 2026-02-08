<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\NodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index']);

Route::get('/app', [NodeController::class, 'index']);

Route::get('/app/nodes/form', function () {
    return view('app.partials.node_form');
});

Route::post('/app/nodes', [NodeController::class, 'createnode']);

Route::prefix('app')->group(function () {
    Route::get('nodes/{node}/edit', [NodeController::class, 'edit'])->name('nodes.edit');
});
Route::prefix('app')->group(function () {
    Route::put('nodes/{node}/update', [NodeController::class, 'update'])->name('nodes.update');
});
Route::prefix(prefix: 'app')->group(function () {
    Route::delete('nodes/{node}/delete', [NodeController::class, 'delete'])->name('nodes.delete');
});
Route::get('/app/nodes/form/close', function () {
    return '';
});
Route::prefix('app')->group(function () {
    Route::patch('nodes/{node}/move', [NodeController::class, 'move'])->name('nodes.move');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
