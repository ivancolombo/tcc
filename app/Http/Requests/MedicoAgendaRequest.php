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
        return [
            "medico" => "required",
            "dias" => "required",
            "data_inicio" => "required",
            "data_fim" => "required",
            "hora_inicio" => "required",
            "hora_fim" => "required",
            "intervalo_horario" => "required"
        ];
    }
}
