<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    public function attributes()
    {
        return [
            'name' => 'nombre',
            'username' => 'nick',
        ];
    }

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
        $user_id = \Request::segments()[2];
        
        return [
            'name'     => 'required',
            'username' => 'required|unique:users,username,' . $user_id,
            'password' => 'nullable|string|min:6',
            'email'    => 'required|email',
        ];
    }
}
