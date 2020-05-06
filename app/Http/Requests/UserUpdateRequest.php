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
          'phone' => 'required|integer|min:5|max:15',
          'dni' => 'required|integer|min:5|max:15',
          'type' => 'required',
          'email' => 'required|string|email|max:191|unique:users,email',
          'password' => 'required|string|min:8|confirmed'
        ];
    }
}
