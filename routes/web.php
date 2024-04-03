<?php

use App\Http\Controllers\CodigoMunicipioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CodigoMunicipioController::class, 'index']);

Route::get('/getComunidades', [CodigoMunicipioController::class, 'getComunidades']);

Route::get('/municipio/{id}', [CodigoMunicipioController::class, 'getMunicipio']);

Route::get('/autocomplete/{string}', [CodigoMunicipioController::class, 'autocomplete']);
