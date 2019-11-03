<?php

namespace App\Http\Controllers;
use App\Task;
use Illuminate\Http\Request;

class ParkingController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $system_role = \Auth::user()->system_role;

        if($system_role == 3 || $system_role == 4 || $system_role == 5){
            return view('parking.index');
        }
        else{
            return view('redirect.redirect');
        }
    }
}
