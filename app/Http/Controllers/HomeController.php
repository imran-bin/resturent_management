<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Chefs;
use App\Models\Food;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {   
        if(Auth::id())
        {
            return redirect('redirect');
        }
        $foods =Food ::all();
        $chefs=Chefs::all();
        $id=Auth::id();
            $count=Cart::where('user_id',$id)->count();

        return view('home',compact('foods','chefs','count' ));
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
            



 
            $id=Auth::id();
            $count=Cart::where('user_id',$id)->count();
            return view('home',compact('foods','chefs','count')); 
        }
    }
}
