<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use App\Models\User;

class UserController extends Controller
{

    public function showUsers(){
        // dd('hello');
         $users = DB::table('users')->get();
        //$users = User::all();
        //return $users;
        return view('allusers',['data' => $users]);
    }
   
}
