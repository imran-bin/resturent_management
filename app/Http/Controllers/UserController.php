<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Food;
use App\Models\Order;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
       $users=User::all();
        return view('Admin.user',compact('users'));
    }
    public function destory($id)
    {
        $data=User::find($id);
        $data->delete();
        return redirect()->back();
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'guest' => 'required',
            'email' => 'required',
            'date' => 'required',
            'time' => 'required',
            'message' => 'required',
            
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $reservation= new Reservation;
        $reservation->name=$request->name;
        $reservation->phone=$request->phone;
        $reservation->guest=$request->guest;
        $reservation->email=$request->email;
        $reservation->date=$request->date;
        $reservation->time=$request->time;
        $reservation->message=$request->message;
        $reservation->save();
         
        return redirect()->back()->withToastSuccess('Reservation   Successfully!');
        
    }
    public function userFoodCart(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required',
            
        ]);
        
        if(Auth::id())
        {
            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }
           
            $cart=new Cart;
            $food_price=Food::find($id);
            $cart->user_id=Auth::id();
            $cart->food_id=$id;
            $cart->quantity=$request->quantity;
            $cart->price=$food_price->price ;
            // $cart->price=$request->quantity * $food_price->price ;
       
            $cart->save();
             
            return redirect()->back()->withToastSuccess('food Cart Successfully!');
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
         $data=Cart::find($id);
         $data->delete();
         return redirect()->back();
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
          $order->save();
        
        }
      
        return redirect()->back();
    }
}
