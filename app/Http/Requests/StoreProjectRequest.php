<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:30',
            'description' => 'max:65535',
            'type_id' => 'required',
            'image' => 'url|max:255'
        ];
    }

    /**
     * Get the validation message
     * 
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'title.required' => 'Il titolo  è obbligatorio',
            'title.min' => 'Il titolo deve avere almeno 5 caratteri',
            'title.max' => 'Il titolo non può essere più lungo di 30 caratteri',
            'description.max' => 'La descrizione non può avere più di 65535 caratteri',
            'type_id' => 'Il tipo è richiesto',
            'image.url' => "L'url per l'immagine non è valido",
            'image.max' => "L'url per l'immagine è troppo lungo"
        ];
    }
}
