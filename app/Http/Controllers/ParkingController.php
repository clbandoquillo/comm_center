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

        if($system_role == 4 || $system_role == 3){
            return view('parking.index');
        }
        else{
            abort(403, 'Forbidden Access. Please contact the MIS Office.');
        }
    }
}
