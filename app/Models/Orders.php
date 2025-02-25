<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable =[
        'user_id','amount','discount','gst','totle','plan_id','payment_method','payment_id','status'
    ];
}
