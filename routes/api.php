<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodigoMunicipioController;


Route::get('/getComunidades', [CodigoMunicipioController::class, 'getComunidades']);

Route::get('/municipio/{id}', [CodigoMunicipioController::class, 'getMunicipio']);

Route::get('/autocomplete/{string}', [CodigoMunicipioController::class, 'autocomplete']);