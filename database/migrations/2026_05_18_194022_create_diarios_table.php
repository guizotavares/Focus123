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
    Schema::create('diarios', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->text('conteudo')->nullable();
        $table->date('data_entrada')->nullable();
        $table->string('humor')->nullable(); // Ex: "Feliz", "Ansioso"
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diarios');
    }
};
