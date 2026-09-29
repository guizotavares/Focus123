<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome_tarefa',
        'descricao_tarefa',
        'data_inicio',
        'tipo_tarefa',
        'local_tarefa',
        'horario_tarefa',
        'concluida',
    ];
    protected $table = 'tasks';
}
