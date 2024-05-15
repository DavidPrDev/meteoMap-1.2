<?php

use App\Http\Controllers\CodigoMunicipioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CodigoMunicipioController::class, 'index']);

