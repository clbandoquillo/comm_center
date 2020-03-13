<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeSwimmingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employee_swimmings = DB::select(DB::raw("EXEC Employee_Swimming_List"));
        return response()->json([
            'employee_swimmings'=>$employee_swimmings
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'employee_id_number' => 'required',
            'or_number' => 'required',
            'swimming_type' => 'required',
            'date_time_usage' => 'required',
            'amount' => 'required'
        ]);

        $employee_swimming = $request->user()->employeeSwimming()->create([
            'employee_id_number' => $request->employee_id_number,
            'or_number' => $request->or_number,
            'swimming_type' => $request->swimming_type,
            'totalHrs' => $request->totalHrs,
            'schoolyear' => $request->schoolyear,
            'semester' => $request->semester,
            'date_time_usage' => $request->date_time_usage,
            'amount' => $request->amount
        ]);

        return response()->json([

            'employee_swimming' => $employee_swimming,
            'message' => 'Employee has been registered to Swimming'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
