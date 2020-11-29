<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormCompteRequest extends FormRequest
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
             'montant' => 'required|numeric|min:0',
             'type_compte' => 'required',
             'client_id' => 'required',
             'name' => 'required|unique:comptes,name,'.($this->compte->id ?? '')
        ];
    }
}
