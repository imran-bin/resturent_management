<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $foods =Food ::all();

        return view('home',compact('foods'));
    }
    public function redirect( )
    {
        $foods =Food ::all();
        $userType=Auth::user()->usertype;
        if($userType=='1')
        {
            return view('Admin.admin_home');
        }
        else
        {
            return view('home',compact('foods')); 
        }
    }
}
