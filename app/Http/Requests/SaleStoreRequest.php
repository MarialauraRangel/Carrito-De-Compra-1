<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleStoreRequest extends FormRequest
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
            'store_id' => 'required',
            'phone' => 'required|min:6|max:14',
            'dni' => 'required|min:5|max:11',
            'address' => 'required|string|min:6|max:64000',
            'distance_id' => 'required'
        ];
    }
}
