<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
         return view('home');
    }
    public function redirect( )
    {
        $userType=Auth::user()->usertype;
        if($userType=='1')
        {
            return view('Admin.admin_home');
        }
        else
        {
            return view('home'); 
        }
    }
}
