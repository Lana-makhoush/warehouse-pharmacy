<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class talabrequest extends FormRequest
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
            'first_med'=>'required',
            'quantity1'=>'required|numeric|min:0',
        ];
    }
    public function messages()
    {
        return [
            'first_med.required'=>'you have to enter one medicine at least and At the beginning filed in the order.',
            'quantity1.required'=>'you have to enter an available quantity.',
            'quantity1.min'=>'you have to enter a positive available quantity.',
            'quantity1.numeric'=>'you have to enter a numeric value.',];
    }

}
