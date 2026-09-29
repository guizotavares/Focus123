<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('cpf')->nullable()->after('email');
            $table->string('telefone')->nullable()->after('cpf');
            $table->date('data_nasc')->nullable()->after('telefone');
        });
    }

    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn(['cpf', 'telefone', 'data_nasc']);
        });
    }
};
