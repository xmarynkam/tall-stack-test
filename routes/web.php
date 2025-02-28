<?php

use App\Http\Controllers\ProfileController;
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

    Route::prefix('participants')
        ->group(function () {
            Route::get('/', \App\Livewire\Participant\Index::class)->name('participants.index');
        });

    Route::prefix('chats')
        ->group(function () {
            Route::get('/', \App\Livewire\Chat\Index::class)->name('chats.index');
            Route::get('/{chat}', \App\Livewire\Chat\Show::class)->name('chats.show');
        });
});

require __DIR__.'/auth.php';
