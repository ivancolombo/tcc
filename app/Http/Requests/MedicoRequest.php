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
        $rules = [
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,'.$this->request->get('user_id').',id',
            'telefone' => 'required',
            'especialidade_id' => 'required',
            'crm' => 'required',            
        ];

        if($this->request->get('_method') === 'POST' || !is_null($this->request->get('password'))) {            
            $rules += [
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required',
                'foto' => 'required|file',
            ];
        }

        return $rules;
    }
}
