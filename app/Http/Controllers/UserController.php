<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getBalance(){
//        return 'asd';
        $balance = Auth::user()->balance;
        return view('balance')->with('balance', $balance);
    }
}
