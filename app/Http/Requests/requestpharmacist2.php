<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class requestpharmacist2 extends FormRequest
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
            'phone'=> 'required|max:10|min:10',
            'password'=> 'required|min:6',

        ];
    }
    public function messages()
    {
        return [
            'phone.required'=>'you have to enter your phone.',
            'phone.max'=>'you have to put ten numbers only.',
            'phone.min'=>'you have to put ten numbers at least.',
            'password.required'=>'you have to enter your password',
            'password.min'=> 'you have to put 6 numbers at least',

        ];
    }
}
