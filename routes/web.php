<?php

use App\Http\Controllers\CadastroController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, "index"])->name("dashboard");


Route::post("/cadastrar", [CadastroController::class, "store"])->name("cadastrar");
Route::delete("/delete/{id}", [CadastroController::class,"destroy"])->name("delete");
Route::put("/atualizar/{id}", [CadastroController::class,"update"])->name("atualizar");
