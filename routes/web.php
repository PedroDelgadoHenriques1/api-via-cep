<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CepController;

Route::get('/', function () {
    return view('cep-form');
});

Route::get('/search/local/{ceps}', [CepController::class, 'search']);

Route::get('/consulta-cep', function () {
    return view('cep-form');
});
