<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nomes = [
            'Departamento Financeiro',
            'Departamento de Recursos Humanos',
            'Departamento de Tecnologia',
            'Departamento de Marketing',
            'Departamento Jurídico',
        ];

        foreach ($nomes as $nome) {
            Departamento::create(['name' => $nome]);
        }
    }
}
