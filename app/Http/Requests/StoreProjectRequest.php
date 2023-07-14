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
            'title' => 'required|unique:projects|min:5|max:30',
            'description' => 'max:65535',
            'type_id' => 'required',
            'image' => 'image|max:10240',
            'technology' => 'required|exists:technologies,id'
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
            'title.unique'=> 'Esiste già un progetto con questo titolo',
            'description.max' => 'La descrizione non può avere più di 65535 caratteri',
            'type_id' => 'Il tipo è richiesto',
            'image.image' => "Il file inserito non è di tipo immagine",
            'image.max' => "L'immagine caricata supera i 10MB massimi",
            'technology.required' => 'Seleziona almeno una tecnologia',
            'technology.exists' => 'ERRORE! Riseleziona le tecnologie'
        ];
    }
}
