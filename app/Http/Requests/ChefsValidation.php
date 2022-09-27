<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChefsValidation extends FormRequest
{
     

     
    public function rules()
    {
        return [
            'image' => 'required',
            'name' => 'required',
            'specialsity' => 'required',
        ];
    }
}
