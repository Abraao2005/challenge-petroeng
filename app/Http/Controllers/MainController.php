<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Departamento;
use App\Models\Setor;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //

    public function index()
    {
        $departamentos = Departamento::all();
        $setores = Setor::all();
        $colaboradores = Colaborador::all();


        return view("dashboard",compact("departamentos","setores","colaboradores"));
    }
}
