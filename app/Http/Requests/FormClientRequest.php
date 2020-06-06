<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormClientRequest extends FormRequest
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
        'nom' => 'required|max:255',
        'prenom' => 'required',
        'cni' => 'required|unique:clients,cni,'.$this->client->id.'|max:255',
        'date_naissance' => 'date'
        ];
    }

   /* protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->slug),
            ]);
    }*/
}
