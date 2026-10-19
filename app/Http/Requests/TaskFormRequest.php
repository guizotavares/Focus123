<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome_tarefa'      => ['required', 'string', 'min:3', 'max:255'],
            'descricao_tarefa' => ['nullable', 'string'],
            'data_inicio'      => ['required', 'date'],
            'horario_tarefa'   => ['nullable', 'date_format:H:i'],
            'tipo_tarefa'      => ['required', 'string', 'max:255'],
            'local_tarefa'     => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome_tarefa.required'       => 'O título da tarefa é obrigatório.',
            'nome_tarefa.min'            => 'O título deve ter no mínimo :min caracteres.',
            'nome_tarefa.max'            => 'O título deve ter no máximo :max caracteres.',
            'data_inicio.required'       => 'A data de início é obrigatória.',
            'data_inicio.date'           => 'Informe uma data válida.',
            'horario_tarefa.date_format' => 'O horário deve estar no formato HH:MM.',
            'tipo_tarefa.required'       => 'O tipo da tarefa é obrigatório.',
            'local_tarefa.required'      => 'O local da tarefa é obrigatório.',
        ];
    }
}
