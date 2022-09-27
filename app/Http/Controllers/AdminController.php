<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChefsValidation;
use App\Http\Requests\FoodValidation;
use App\Models\Chefs;
use App\Models\Food;
use App\Models\Order;
use App\Models\Reservation;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{


    public function create()
    {
        $foods = Food::all();
        return view('Admin.food_menu', compact('foods'));
    }
    public function store(FoodValidation $request)
    {
        $food = new Food;
        $image = $request->image;
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('foodImage', $imageName);
        $food->image = $imageName;
        $food->title = $request->title;
        $food->price = $request->price;
        $food->description = $request->description;
        if ($food->save()) {
            return redirect()->back()->with('success', 'Food Added Successfully!');
        }

        return redirect()->back()->with('error', 'Food Insert faild!');
    }
    public function destory($id)
    {


        return (Food::findOrFail($id)->delete())
            ? redirect()->back()->with('success', 'Food Successfullay Deleted!')

            : redirect()->back()->with('error', 'Food  Deleted failed!');
    }
    public function edit($id)
    {
        $food = Food::findOrFail($id);
        return ($food)
            ? view('Admin.food_edit', compact('food'))
            : abort(404, 'Data Not Found.');
    }
    public function update(FoodValidation $request, $id)
    {

        $food = Food::find($id);
        $image = $request->image;
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('foodImage', $imageName);
        $food->image = $imageName;
        $food->title = $request->title;
        $food->price = $request->price;
        $food->description = $request->description;
        return ($food->save())
            ? redirect()->back()->with('success', 'Food Updated Successfullay')
            : redirect()->back()->with('error', 'Food Updated faild');
    }

    public function adminReservation()
    {
         
        if (Auth::user()->usertype == '1') {
            $reservations = Reservation::all();
            return view('Admin.admin_reservation', compact('reservations'));
        } else {
            return redirect('login');
        }
    }
    public function adminStatus($id)
    {
        $data = Reservation::find($id);
        if (!empty($data)) {
            $data->status = 'success';
            if ($data->save()) {
                return redirect()->back()->with('success', 'status success');
            }
            return redirect()->back()->with('error', 'status faield');
        } else {
            return    abort(404, 'Data Not Found.');
        }
    }


    public function adminChefsIndex()
    {
        $chefs = Chefs::all();
        return view('Admin.chefs_create', compact('chefs'));
    }
    public function adminChefsStore(ChefsValidation $request)
    {
         
         
        $chefs = new Chefs;
        $image = $request->image;
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('chefsImage', $imageName);
        $chefs->name = $request->name;
        $chefs->specialsity = $request->specialsity;
        $chefs->image = $imageName;
        return $chefs->save() 
        ? redirect()->back()->with('success', 'Chefs Added Successfully!') 
        : redirect()->back()->with('error', 'Chefs Added failed!');  

    }
    public function adminChefsDestory($id)
    {
        return (Chefs::findOrFail($id)->delete())
        ? redirect()->back()->with('success', 'Chefs Successfullay Deleted!')

        : redirect()->back()->with('error', 'Chefs  Deleted failed!');
    }
    public function adminChefsEdit($id)
    {

        $chefs = Chefs::findOrFail($id);
        return ($chefs)
            ? view('Admin.chefs_edit', compact('chefs'))
            : abort(404, 'Data Not Found.');
        
    }
    public function adminChefsUpdate(ChefsValidation $request, $id)
    {
        
        $chefs = Chefs::find($id);
        $image = $request->image;
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('chefsImage', $imageName);
            $chefs->image = $imageName;
        }
        $chefs->specialsity = $request->specialsity;
        $chefs->name = $request->name;
        return ($chefs->save())
            ? redirect()->back()->with('success', 'Chefs Updated Successfullay')
            : redirect()->back()->with('error', 'Chefs Updated faild');
    }
    public function adminOrder()
    {
        $order = Order::all();
        return view('Admin.admin_order', compact('order'));
    }
    public function adminSearch(Request $request)
    {
        $searchtxt = $request->search;



        $order = Order::where('name', 'Like', "%{$searchtxt}%")->orWhere('foodname', 'Like', '%' . $searchtxt . '%')->get();

        return view('Admin.admin_order', compact('order'));
    }
}
