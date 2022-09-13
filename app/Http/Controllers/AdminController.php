<?php

namespace App\Http\Controllers;

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
}
