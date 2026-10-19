<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HobbyFormRequest extends FormRequest
{
    /**
     * O acesso já é controlado pelo middleware 'autenticacao' nas rotas.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação (valem para store e update).
     */
    public function rules(): array
    {
        return [
            'nome_hobby' => ['required', 'string', 'min:3', 'max:255'],
            'meta'       => ['nullable', 'string', 'max:255'],
            'categoria'  => ['required', 'in:Aprendizado,Criativo,Bem-estar,Fitness'],
        ];
    }

    /**
     * Mensagens de erro em português.
     */
    public function messages(): array
    {
        return [
            'nome_hobby.required' => 'O nome do hobby é obrigatório.',
            'nome_hobby.string'   => 'O nome do hobby deve ser um texto.',
            'nome_hobby.min'      => 'O nome do hobby deve ter no mínimo :min caracteres.',
            'nome_hobby.max'      => 'O nome do hobby deve ter no máximo :max caracteres.',

            'meta.string'         => 'A meta deve ser um texto.',
            'meta.max'            => 'A meta deve ter no máximo :max caracteres.',

            'categoria.required'  => 'Escolha uma categoria.',
            'categoria.in'        => 'Categoria inválida. Escolha uma das opções disponíveis.',
        ];
    }
}