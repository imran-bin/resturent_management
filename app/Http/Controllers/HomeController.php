<?php

namespace App\Http\Controllers;

use App\Models\Chefs;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $foods =Food ::all();
        $chefs=Chefs::all();

        return view('home',compact('foods','chefs'));
    }
    public function redirect( )
    {
        $foods =Food ::all();
        $chefs=Chefs::all();
        $userType=Auth::user()->usertype;
        if($userType=='1')
        {
            return view('Admin.admin_home');
        }
        else
        {
            return view('home',compact('foods','chefs')); 
        }
    }
}
