<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(){
        $orders = DB::table('Orders')->get();
        return $orders;
    }
    public function arryshow(){
        $arr = ['rocky','mritunjay', 'ajay', 'shivam'];
        
    }
}


