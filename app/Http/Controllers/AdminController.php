<?php

namespace App\Http\Controllers;


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
    public function store(Request $request)
    {
        $food = new Food;
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',


        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        }
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
        $food = Food::find($id);
        if (!empty($food)) {

            if ($food->delete()) {
                return redirect()->back()->with('success', 'Food Successfullay Deleted!');
            } else {
                return redirect()->back()->with('error', 'Food  Deleted failed!');
            }
        } else {
            return  abort(404, 'Data Not Found.');
        }
    }
    public function edit($id)
    {
        $food = Food::find($id);
        if (!empty($food)) {
            return view('Admin.food_edit', compact('food'));
        } else {
            return  abort(404, 'Data Not Found.');
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',


        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        }
        $food = Food::find($id);
        if (!empty($food)) {
            $image = $request->image;
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('foodImage', $imageName);
            $food->image = $imageName;
            $food->title = $request->title;
            $food->price = $request->price;
            $food->description = $request->description;
            if ($food->save()) {
                return redirect()->back()->with('success', 'Food Updated Successfullay');
            }
            return redirect()->back()->with('error', 'Food Updated faild');
        }
        return    abort(404, 'Data Not Found.');
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
       
       
        if(!empty($data))
        {
            $data->status = 'success';
            if ($data->save()) {
                return redirect()->back()->with('success', 'status success');
            }
            return redirect()->back()->with('error', 'status faield');
        }
        else
        {
            return    abort(404, 'Data Not Found.');
        }
    }
     
  
    public function adminChefsIndex()
    {
        $chefs = Chefs::all();
        return view('Admin.chefs_create', compact('chefs'));
    }
    public function adminChefsStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'name' => 'required',
            'specialsity' => 'required',



        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        }
        $chefs = new Chefs;
        $image = $request->image;
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('chefsImage', $imageName);
        $chefs->name = $request->name;
        $chefs->specialsity = $request->specialsity;
        $chefs->image = $imageName;
        return $chefs->save() ? redirect()->back()->with('success', 'Chefs Added Successfully!') : redirect()->back()->with('error', 'Chefs Added failed!');
        //  if( $chefs->save())
        //  {
        //     return redirect()->back()->with('success','Chefs Added Successfully!');
        //  }

        //  return redirect()->back()->with('error','Chefs Added failed!');

    }
    public function adminChefsDestory($id)
    {
        $chefs = Chefs::find($id);
        if (!empty($chefs)) {
            if ($chefs->delete()) {
                return redirect()->back()->with('success', 'Chefs Revome Successfullay');
            } else {
                return redirect()->back()->with('error', 'Chefs Revome Failed');
            }
        } else {
            return  abort(404, 'Data Not Found.');
        }
    }
    public function adminChefsEdit($id)
    {

        $chefs = Chefs::find($id);
        if (!empty($chefs)) {
            return  view('Admin.chefs_edit', compact('chefs'));
        } else {
            return  abort(404, 'Data Not Found.');
        }
    }
    public function adminChefsUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'name' => 'required',
            'specialsity' => 'required',

        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        }

        $chefs = Chefs::find($id);
        $image = $request->image;
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('chefsImage', $imageName);
            $chefs->image = $imageName;
        }

        $chefs->specialsity = $request->specialsity;
        $chefs->name = $request->name;
        if ($chefs->save()) {
            return redirect()->back()->with('success', 'Chefs Updated Successfullay');
        }
        return redirect()->back()->with('error', 'Chefs Updated failed');
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
