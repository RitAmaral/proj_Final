<?php

namespace App\Http\Requests\Filme;

use Illuminate\Foundation\Http\FormRequest;

class FilmeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //Auth::check();
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array //regras para editar filme
    {
        return [
            //
            'titulo'=>'required|string',
            'ano'=>'required|numeric|digits:4',
            'id_classificacao' => 'numeric|digits_between:1,6',
            'id_pais' => 'numeric|digits_between:1,197',
            'id_plataforma' => 'numeric|digits_between:1,7',
            'rating' => 'numeric|regex:/^\d+(\.\d{1,2})?$/',
            'link_imdb' => 'string'
        ];
    }
    public function messages() //mensagens que vão aparecer caso as regras não sejam seguidas
    {
        return [
            'titulo.required'=>'O campo título é obrigatório',
            'ano.required'=>'O campo ano é obrigatório',
            'ano.numeric'=>'O campo ano tem de ser preenchido com números',
            'ano.digits' => 'O campo ano deve contar 4 números',
            'id_classificacao.numeric'=>'O campo classificação tem de ser preenchido com números',
            'id_pais.numeric'=>'O campo país tem de ser preenchido com números',
            'id_plataforma.numeric'=>'O campo plataforma tem de ser preenchido com números',
            'rating.numeric'=>'O campo rating tem de ser preenchido com números',
            'link_imdb.string' => 'O campo link_imdb teve ser preenchido com texto'
        ];
    }
}
