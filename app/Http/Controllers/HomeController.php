<?php

namespace App\Http\Controllers;

use App\Gamesetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get use balance and Jackpot for Dashboard
        $balance = Auth::user()->balance;
        $jackpot = Gamesetting::find(1);
        return view('home')->with(['balance'=> $balance, 'jackpot' => $jackpot]);
    }

    public function getjackpot(){
        // Get Jackpot for Jquery responce
        $jackpot = Gamesetting::find(1);
        return $jackpot->_value;
    }
}
