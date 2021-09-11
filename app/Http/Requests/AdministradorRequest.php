<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdministradorRequest extends FormRequest
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
            'tipo' => 'required',      
            'status' => 'nullable'      
        ];

        if($this->request->get('_method') === 'POST') {            
            $rules += [
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required',
                'email' => 'required|string|max:255|email|unique:users',
            ];
        } elseif(!is_null($this->request->get('password'))) {
            $rules += [
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required',
                'email' => 'required|string|max:255|email|unique:users,email,'.$this->request->get('user_id'),
            ];        
        } else {
            $rules += [
                'email' => 'required|string|max:255|email|unique:users,email,'.$this->request->get('user_id'),
            ];
        }

        return $rules;
    }
}
