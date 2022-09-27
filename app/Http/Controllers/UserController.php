<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationValidation;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Food;
use App\Models\Order;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
 

class UserController extends Controller
{
    public function index()
    {
       $users=User::all();
        return view('Admin.user',compact('users'));
    }
    public function destory($id)
    {
        
        return (User::findOrFail($id))->delete()
        ? redirect()->back()->with('success','User Delete Successfullay !')
        : redirect()->back()->with('error','User Delete Failed !');
   
    }
    public function store(ReservationValidation $request)
    {
         
        $reservation= new Reservation;
        $reservation->name=$request->name;
        $reservation->phone=$request->phone;
        $reservation->guest=$request->guest;
        $reservation->email=$request->email;
        $reservation->date=$request->date;
        $reservation->time=$request->time;
        $reservation->message=$request->message;
        
         if(Auth::id())
         {
            return($reservation->save())
            ? redirect()->back()->with('success','Reservation   Successfully!')
            : redirect()->back()->with('error','Reservation   booking failed!');
         }
        else{
            return redirect('/login');
        }
    }
    public function userFoodCart(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required',
            
        ]);
        
        if(Auth::id())
        {
            if ($validator->fails()) {
                return back()->with('error', $validator->messages()->all()[0])->withInput();
            }
           
            $cart=new Cart;
            $food_price=Food::find($id);
            $cart->user_id=Auth::id();
            $cart->food_id=$id;
            $cart->quantity=$request->quantity;
            $cart->price=$food_price->price ;
            return ($cart->save())
            ? redirect()->back()->with('success','food Cart Successfully!')
            : redirect()->back()->with('error','food Cart failed!');
            
        }
        else
        {
             
            return redirect('login') ;
        }
    }
    public function userCartIndex($id)
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
    public function userCartDestory($id)
    {
         
         return(Cart::find($id))->delete()
         ? redirect()->back()->with('success','Cart Data Remove Successfullay!')
         : redirect()->back()->with('error','Cart Data Remove Failed!');

          
        
         
    }
    public function userOrderConfirm(Request $request)
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
         if( $order->save()){
            return redirect()->back()->with('success','order  Successfully!');
         }
        
        }
      
        return redirect()->back()->with('error','orderd   failed!');
    }
}
