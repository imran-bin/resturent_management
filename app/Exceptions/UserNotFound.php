<?php

namespace App\Exceptions;

use Exception;

class UserNotFound extends Exception
{
    public function report( )
    {
         
    }
    public function render( )
    {
        return view('errors.401');
    }
}
