<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/status', [ClientController::class, 'status']);
Route::get('/clients', [ClientController::class, 'clients']);
Route::get('/clients/{id}', [ClientController::class, 'clientById']);
Route::post('/clients', [ClientController::class, 'createClient']);
Route::put('/clients/{id}', [ClientController::class, 'updateClient']);
Route::delete('/clients/{id}', [ClientController::class, 'deleteClient']);
