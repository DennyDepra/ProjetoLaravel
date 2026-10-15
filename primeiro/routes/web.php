<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Rota GET, exibe o formulario e lista de contatos
Route::get('/', [ContatoController::class, 'index']);
// Rota POST, envia os dados do formulario para o banco de dados
Route::post('/save', [ContatoController::class, 'form']);
