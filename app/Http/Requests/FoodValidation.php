<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodValidation extends FormRequest
{
     

   

  
    public function rules()
    {


        return [
            'image' => 'required',
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',
        ];
    }
    // public function messages()
    // {

    //     return [
    //         'title.required' => 'A title is required',
    //         'price.required' => 'A price is required',
    //         'description.required' => 'A description is required',
    //         'image.required' => 'A image is required',
           
    //     ];
    // }
}
