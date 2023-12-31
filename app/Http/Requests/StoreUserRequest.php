<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;


class StoreUserRequest extends FormRequest
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
        if ($this->isMethod('put')) {
            $id = "," . $this->user->id;
            $password = 'nullable';
        } else {
            $id = "";
            $password = 'required';
        }
        return [
            'name' => 'required',
            'password' => $password . '|max:200',
            'email' => 'required|email:rfc,dns|unique:users,email'.$id,
            'username' => 'required|unique:users,username'.$id,
        ];
    }
}