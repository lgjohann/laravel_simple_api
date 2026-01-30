<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/status', [ClientController::class, 'status']);
Route::get('/clients', [ClientController::class, 'clients']);
