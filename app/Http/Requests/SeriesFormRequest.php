<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class SeriesFormRequest extends FormRequest
{
    /**
     * REQUER AUTORIZAÇÃO PARA ACEITAR ALTERAÇÕES? 
     * REQUER AUTORIZAÇÃO: RETURN FALSE
     * NÃO REQUER AUTORIZAÇÃO: RETURN TRUE
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
        
                'nome' => 'required|min:2' 
            
        ];
    }

    public function messages(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.min' => "O nome precisa ter pelo menos 2 caracteres"
        ];
    }
}
