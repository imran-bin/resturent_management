<?php

namespace App\Http\Controllers;

use App\Models\Chefs;
use App\Models\Food;
use App\Models\Reservation;
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
    public function food_edit($id)
    {
         $food=Food::find($id);
         return view('Admin.food_edit',compact('food'));

    }
    public function food_update(Request $request, $id)
    {
        $food=Food::find($id);
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
    public function user_reservation(Request $request)
    {
        $reservation= new Reservation;
        $reservation->name=$request->name;
        $reservation->phone=$request->phone;
        $reservation->guest=$request->guest;
        $reservation->email=$request->email;
        $reservation->date=$request->date;
        $reservation->time=$request->time;
        $reservation->message=$request->message;
        $reservation->save();
        return redirect()->back();
        
    }
    public function admin_reservation(  )
    {
        $reservations=Reservation::all();
        return view('Admin.admin_reservation',compact('reservations'));
    }
    public function admin_status($id)
    {
        $data=Reservation::find($id);
        $data->status='success';
        $data->save();
        return redirect()->back();
    }
    public function admin_chefs( )
    {
        return view('Admin.chefs_create');
    }
    public function admin_chefs_upload(Request $request)
    {
        $chefs=new Chefs;
        $image=$request->image;
         $imageName=time().'.'.$image->getClientOriginalExtension();
         $request->image->move('chefsImage',$imageName);
         $chefs->name=$request->name;
         $chefs->specialsity=$request->special;
         $chefs->image=$imageName;
         $chefs->save();
         return redirect()->back();

    }
}
