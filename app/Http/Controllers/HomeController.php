<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $system_role = \Auth::user()->system_role;

        if($system_role == 4 || $system_role == 3){
            return view('home');
        }
        else{
            return view('redirect.redirect');
        }
    }
}
