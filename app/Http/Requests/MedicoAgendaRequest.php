<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicoAgendaRequest extends FormRequest
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
            "medico" => "required",
            "dias" => "required",
            "data_inicio" => "required|date|date_format:Y-m-d|after:".date('d-m-Y', strtotime("-1 day", strtotime("now"))),
            "data_fim" => "required|date|after_or_equal:data_inicio|before_or_equal:".date('d-m-Y', strtotime("+3 months", strtotime($this->data_inicio))),
            "hora_inicio" => "required",
            "hora_fim" => "required|after:hora_inicio",            
        ];

        if ($this->request->get('_method') === 'POST' ) {
            $rules += [
                "intervalo_horario" => "required"
            ];
        }

        return $rules;
    }    
}
