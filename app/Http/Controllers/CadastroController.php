<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use Illuminate\Http\Request;

class CadastroController extends Controller
{


    public function store(Request $request)
    {
        $validatedRequest = $request->validate(
            [
                'nome' => 'required|string|max:255',
                "departamento" => "required|int",
                "setor" => "required|int"
            ]
        );
        if ($validatedRequest) {

            $created = Colaborador::create([

                "name" => $validatedRequest["nome"],
                "departamento_id" => $validatedRequest["departamento"],
                "setor_id" => $validatedRequest["setor"],

            ]);
            if (!$created) {
                return back()->withErrors(['custom_error' => 'Erro ao processar dados.']);
            }

            return redirect()->route('dashboard')->with('success', 'Colaborador cadastrado com sucesso!');
        } else {
            return back()->withErrors(['custom_error' => 'Erro ao processar dados.']);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'departamento' => 'required|int',
            'setor' => 'required|int',
        ]);

        $colaborador = Colaborador::find($id);
        $colaborador->update(
            [
                "name" => $validatedData["nome"],
                "departamento_id" => $validatedData["departamento"],
                "setor_id" => $validatedData["setor"]
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Colaborador atualizado com sucesso!');
    }

    // Função para excluir colaborador
    public function destroy($id)
    {
        $colaborador = Colaborador::find($id);
        $colaborador->delete();

        return redirect()->route('dashboard')->with('success', 'Colaborador excluído com sucesso!');
    }
}
