<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('items.index');
});

Route::resource('items', ItemController::class);
Route::post('items/generate', [ItemController::class, 'generate'])->name('items.generate');
Route::post('items/clear', [ItemController::class, 'clear'])->name('items.clear');
Route::post('items/update-sheet', [ItemController::class, 'updateSheet'])->name('items.update-sheet');
Route::get('fetch/{count?}', [ItemController::class, 'fetch'])->name('fetch');
