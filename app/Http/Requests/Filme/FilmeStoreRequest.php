<?php
/*--------------------- Isto foi criado ao usar o comando php artisan make:request Filme/FilmeStoreRequest --------------*/
namespace App\Http\Requests\Filme;

use Illuminate\Foundation\Http\FormRequest;

class FilmeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //Auth::check(); //Isto é usado para só as pessoas autorizadas alterarem ou criarem dados ou remover; depois é preciso programar o check
        return true;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array //aqui é onde metemos as regras
    { //sobre validações: https://laravel.com/docs/10.x/validation
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
    public function messages() //criar esta nova função, mensagens; posso criar uma msg para todos os requireds, ou para cada campo.
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
