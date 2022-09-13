<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users( )
    {
       $users=User::all();
        return view('Admin.user',compact('users'));
    }
    public function users_delete($id)
    {
        $data=User::find($id);
        $data->delete();
        return redirect()->back();
    }
    public function food_create()
    {
        $foods=Food::all();
        return view('Admin.food_menu',compact('foods'));
    }
    public function food_store(Request $request)
    {
          $food=new Food;
          $image=$request->image;
          $imageName=time() .'.'.$image->getClientOriginalExtension();
          $request->image->move('foodImage' ,$imageName);
          $food->image=$imageName;
          $food->title=$request->title;
          $food->price=$request->price;
          $food->description=$request->description;
          $food->save();
          return redirect()->back();
    }
    public function food_delete($id)
    {
        $food=Food::find($id);
        $food->delete();
        return redirect()->back();
    }
}
