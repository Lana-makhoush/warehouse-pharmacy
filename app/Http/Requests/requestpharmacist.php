<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class requestpharmacist extends FormRequest
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
            'name' => 'required|string',
            'phone'=> 'required|max:10|min:10|unique:users',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'type'=> 'required',
        ];
    }
    public function messages()
    {
        return [
            'phone.required'=>'you have to enter your phone.',
            'phone.unique'=>'you have to enter an unique phone.',
            'phone.max'=>'you have to put ten numbers only.',
            'phone.min'=>'you have to put ten numbers at least.',
            'email.required'=>'you have to enter your email.',
            'email.unique'=>'you have to enter an unique email.',
            'password.required'=>'you have to enter your password.',
            'password.min'=>'you have to put 6 numbers at least.',
            'name.required'=>'you have to enter your name.',
            'type.required'=>'you have to enter your specialty.'
        ];
    }
}
