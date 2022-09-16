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
   
    public function adminReservation()
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
    public function adminStatus($id)
    {
        $data=Reservation::find($id);
        $data->status='success';
        $data->save();
        return redirect()->back();
    }
    public function adminChefsIndex( )
    {
       $chefs=Chefs::all();
        return view('Admin.chefs_create',compact('chefs'));
    }
    public function adminChefsStore(Request $request)
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
    public function adminChefsDestory($id)
    {
       $chefs=Chefs::find($id);
       $chefs->delete();
       return redirect()->back();
    }
    public function adminChefsEdit($id)
    {
       $chefs=Chefs::find($id);
       
       return  view('Admin.chefs_edit',compact('chefs'));
    }
    public function adminChefsUpdate(Request $request,$id)
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
   
   
    public function adminOrder()
    {
        $order=Order::all();  
        return view('Admin.admin_order',compact('order'));
    }
    public function adminSearch(Request $request)
    {
        $searchtxt=$request->search;
         
        $order=Order::where('name','Like',"%{$searchtxt}%")->orWhere('foodname','Like','%'.$searchtxt.'%')->get();  
      
        return view('Admin.admin_order',compact('order'));
    }
}