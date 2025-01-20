<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('colaborador', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("departamento_id")->nullable(true);
            $table->unsignedBigInteger("setor_id")->nullable(true);
            $table->string('name');
            $table->timestamps();
            $table->foreign("departamento_id")->references("id")->on("departamentos");
            $table->foreign("setor_id")->references("id")->on("setor");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colaborador');
    }
};
