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
    public function admin_chefs( )
    {
       $chefs=Chefs::all();
        return view('Admin.chefs_create',compact('chefs'));
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
    public function admin_chefs_delete($id)
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
    public function user_food_cart(Request $request,$id)
    {
        
        if(Auth::id())
        {
            $cart=new Cart;
            $food_price=Food::find($id);
            $cart->user_id=Auth::id();
            $cart->food_id=$id;
            $cart->quantity=$request->quantity;
            $cart->price=$food_price->price ;
            // $cart->price=$request->quantity * $food_price->price ;
       
            $cart->save();
            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }
    public function user_cart_info($id)
    {
        if(Auth::id()==$id)
        {

        
        $count=Cart::where('user_id' ,$id)->count();
         $data=Cart::where('user_id',$id)->get();
         
        //  join('food','carts.food_id','=','food.;id')->get();
      
         return view('cart_show',compact('count','data'));
        }
        else
        {
            return redirect()->back();
        }
    }
    public function user_cart_remove($id)
    {
         $data=Cart::find($id);
         $data->delete();
         return redirect()->back();
    }
    public function user_order_confirm(Request $request)
    {  
     
    //     $test=Cart::where('user_id',Auth::user()->id)->pluck('price')->sum();
        
 
        DB::table('carts')->where('user_id',Auth::user()->id)->delete();
        
     

        foreach($request->foodname as $key=>$foodname)
        {
          
        
          $order= new Order;
          $order->foodname=$foodname;
          $order->price=$request->price[$key];
          $order->quantity=$request->quantity[$key];
          $order->name=$request->name;
          $order->phone=$request->phone;
          $order->address=$request->address;
          $order->save();
        
        }
      
        return redirect()->back();
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