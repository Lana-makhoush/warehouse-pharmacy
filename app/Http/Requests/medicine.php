<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class medicine extends FormRequest
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
            'scientific_name'=>'required',
            'commercial_name'=>'required',
            'category'=>'required',
            'manufacture_company'=>'required',
            'available_quantity'=>'required|numeric|min:0',
           // 'expiry_date'=>'required|date_format:Y-m-d|after_or_equal:today',
            'price'=>'required|numeric|min:0',
            'image'=>'required|image',
        ];
    }
    public function messages()
    {
        return [
            'scientific_name.required'=>'you have to enter a scientific name.',
            'commercial_name.required'=>'you have to enter a commercial name.',
            'category.required'=>'you have to enter a category.',
            'manufacture_company.required'=>'you have to enter a manufacture company.',
            'available_quantity.required'=>'you have to enter an available quantity.',
            'available_quantity.min'=>'you have to enter a positive available quantity.',
            'available_quantity.numeric'=>'you have to enter a numeric value.',
            //'expiry_date.required'=>'you have to enter an expiry date.',
           // 'expiry_date.date_format:Y-m-d|after_or_equal:today'=>'you have to enter an available expiry date .',
            'price.required'=>'you have to enter a price.',
            'price.min'=>'you have to enter an available price.',
            'price.numeric'=>'you have to enter a numeric value.',
            'image.required'=>'you have to enter an image.',
        ];
    }
}
