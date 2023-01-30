<?php

use Aerni\FontAwesome\FontAwesomeController;
use Illuminate\Support\Facades\Route;

Route::name('font-awesome.')->group(function () {
    Route::post('/icons', [FontAwesomeController::class, 'index'])->name('font-awesome.icons');
});
