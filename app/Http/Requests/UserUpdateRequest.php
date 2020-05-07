<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
          'name' => 'required|string|min:2|max:191',
          'lastname' => 'required|string|min:2|max:191',
          'phone' => 'required|integer|min:5|max:15',
          'dni' => 'required|integer|min:5|max:15',
          'type' => 'required'
        ];
    }
}
