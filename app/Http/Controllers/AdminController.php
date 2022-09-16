<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Chefs;
use App\Models\Food;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\type;

class AdminController extends Controller
{
   
   
    public function create()
    {
        $foods=Food::all();
        return view('Admin.food_menu',compact('foods'));
    }
    public function store(Request $request)
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
    public function destory($id)
    {
        $food=Food::find($id);
        $food->delete();
        return redirect()->back();
    }
    public function edit($id)
    {
         $food=Food::find($id);
         return view('Admin.food_edit',compact('food'));

    }
    public function update(Request $request, $id)
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
   
    public function admin_reservation()
    {
       if(Auth::user()->usertype=='1')
       {
        $reservations=Reservation::all();
        return view('Admin.admin_reservation',compact('reservations'));
       }
       else
       {
        return redirect('login');
       }
    }
    public function admin_status($id)
    {
        $data=Reservation::find($id);
        $data->status='success';
        $data->save();
        return redirect()->back();
    }
    public function admin_chefs_index( )
    {
       $chefs=Chefs::all();
        return view('Admin.chefs_create',compact('chefs'));
    }
    public function admin_chefs_store(Request $request)
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
    public function admin_chefs_destory($id)
    {
       $chefs=Chefs::find($id);
       $chefs->delete();
       return redirect()->back();
    }
    public function admin_chefs_edit($id)
    {
       $chefs=Chefs::find($id);
       
       return  view('Admin.chefs_edit',compact('chefs'));
    }
    public function admin_chefs_update(Request $request,$id)
    {
         $chefs=Chefs::find($id);
         $image=$request->image;
         if($image)
         {
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('chefsImage',$imageName);
            $chefs->image=$imageName;
         }
        
         $chefs->specialsity=$request->special;
         $chefs->name=$request->name;
         $chefs->save();
         return redirect()->route('admin.chefs');
    }
   
   
    public function admin_order()
    {
        $order=Order::all();  
        return view('Admin.admin_order',compact('order'));
    }
    public function admin_search(Request $request)
    {
        $searchtxt=$request->search;
         
        $order=Order::where('name','Like',"%{$searchtxt}%")->orWhere('foodname','Like','%'.$searchtxt.'%')->get();  
      
        return view('Admin.admin_order',compact('order'));
    }
}