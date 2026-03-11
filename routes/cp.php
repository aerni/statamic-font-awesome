<?php

use Aerni\FontAwesome\Http\Controllers\FontAwesomeController;
use Illuminate\Support\Facades\Route;

Route::get('/font-awesome/icons', FontAwesomeController::class)->name('font-awesome.icons');
