<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_diary',
        'date_diary',
        'feeling_diary',
        'descricao_diary',
    ];
    protected $table = 'diary';
}
