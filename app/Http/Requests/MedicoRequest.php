<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
            'telefone' => 'required',
            'especialidade_id' => 'required',
            'crm' => 'required',
            'foto' => 'required',
        ];
    }
}
