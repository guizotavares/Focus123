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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('nome_tarefa');
            $table->text('descricao_tarefa')->nullable();
            $table->date('data_inicio')->nullable();
            $table->time('horario_tarefa')->nullable();
            $table->string('tipo_tarefa')->nullable();
            $table->string('local_tarefa')->nullable();
            $table->boolean('concluida')->default(false);
            $table->timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
