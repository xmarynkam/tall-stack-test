<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Chat\Show;
use App\Livewire\Chat\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('welcome');
});

Route::get('/dashboard', static function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('profile')
        ->group(function () {
            Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

    Route::prefix('chats')
        ->group(function () {
            Route::get('/', Index::class)->name('chat.index');
            Route::get('/{chat}', Show::class)->name('chat.show');
        });
});

require __DIR__.'/auth.php';
