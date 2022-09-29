<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Chefs;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
      
    
    public function index()
    {

        $foods = Food::all();
        $chefs = Chefs::all();
        $id = Auth::id();
        $count = Cart::where('user_id', $id)->count();
        return (Auth::id())
            ?  redirect('redirect')
            : view('home', compact('foods', 'chefs', 'count'));
        
    }
    public function redirect()
    {
        $foods = Food::all();
        $chefs = Chefs::all();
        $id = Auth::id();
        $count = Cart::where('user_id', $id)->count();
        $userType = Auth::user()->usertype;
        return ($userType == '1')
            ? view('Admin.admin_home')
            : view('home', compact('foods', 'chefs', 'count'));
    }
}
