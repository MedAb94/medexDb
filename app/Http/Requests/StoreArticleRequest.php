<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /*if (request()->input('date_fabrication') && request()->input('date_expiration')) {
            $date_fabrication = Carbon::createFromFormat('d/m/Y', request()->input('date_fabrication'));
            $date_expiration = Carbon::createFromFormat('d/m/Y', request()->input('date_expiration'));
        }*/

        return [
            'nom'=>'required',
            'prix_unitaire'=>'required|numeric|min:1',
            'date_fabrication' => [
                'nullable',
                'date_format:d/m/Y',
                'before_or_equal:today',
                function ($attribute, $value, $fail) {
                    if ($this->input('categorie') == 1 && !$value) {
                        $fail('La date d\'expiration est obligatoire pour les médicaments');
                    }
                },
            ],
            'date_expiration' => [
                'nullable',
                'date_format:d/m/Y',
                'after:date_fabrication',
                function ($attribute, $value, $fail) {
                    if ($this->input('categorie') == 1 && !$value) {
                        $fail('La date d\'expiration est obligatoire pour les médicaments');
                    }
                },
            ],
            'categorie' => 'required',
            'seuil' => 'nullable|numeric|min:1',
        ];
    }
}
