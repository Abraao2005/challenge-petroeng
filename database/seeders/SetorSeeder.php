<?php

namespace Database\Seeders;

use App\Models\Setor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nomes = [
            'Setor Financeiro',
            'Setor de Recursos Humanos',
            'Setor de Tecnologia',
            'Setor de Marketing',
            'Setor Jurídico',
        ];

        foreach ($nomes as $nome) {
            Setor::create(['name' => $nome, "departamento_id"=> fake()->numberBetween(1,5)]);
        }
    }
}
