<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diary', function(Blueprint $table){
            $table->id();
            $table->string('title_diary');
            $table->date('date_diary')->nullable();
            $table->string('feeling_diary');
            $table->string('descricao_diary')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diary');
    }
};
