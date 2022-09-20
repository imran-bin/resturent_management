<?php

namespace App\Exceptions;

use Exception;

class ChefsNotFound extends Exception
{
    public function report( )
    {
         
    }
    public function render( )
    {
        return view('errors.401');
    }
}
