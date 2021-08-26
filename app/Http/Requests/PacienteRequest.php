<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacienteRequest extends FormRequest
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
            'email' => 'required|string|max:255|email',
            'telefone' => 'required',        
            'cpf' => 'required',        
            'data_nascimento' => 'required',        
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

    public function validationData()
    {
        $data = $this->all();

        $data['telefone'] = preg_replace('/[^0-9]/', '', $data['telefone']);
        $data['cpf'] = preg_replace('/[^0-9]/', '', $data['cpf']);

        return $data;
    }
}
