<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DistanceStoreRquest extends FormRequest
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
            'km' => 'required|integer|min:1|max:10',
            'price' => 'required'
        ];
    }
}
