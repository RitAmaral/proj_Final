<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class NewUserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //para editar usar queremos editar nome e email
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'O campo nome é obrigatório',
            'email.required'=>'O campo email é obrigatório'
        ];
    }

}
