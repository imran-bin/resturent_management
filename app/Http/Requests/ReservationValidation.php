<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationValidation extends FormRequest
{
   
    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            'guest' => 'required',
            'email' => 'required',
            'date' => 'required',
            'time' => 'required',
            'message' => 'required',
        ];
    }
}
