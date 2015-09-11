<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateClientRequest extends Request
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
            'fname' => 'required',
            'sname' => 'required',
            'email' => 'unique:users,email',
            'password' => 'required|min:7',
            'password_confirmation' => 'required|same:password',      
        ];
    }
}
