<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class OrderController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index(){
        return User::with('orders')->find(1);
    }
}
