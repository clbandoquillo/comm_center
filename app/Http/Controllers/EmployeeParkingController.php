<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /* dd("it works!");*/
        $employee_parkings = DB::select(DB::raw("exec Employee_Parking_List"));
        return response()->json([
            'employee_parkings'=>$employee_parkings
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
        
        $request->validate([
            'id_number' => 'required',
            'plate_number' => 'required',
            'school_dept_office' => 'required',
            'contact_number' => 'required',
            'license_number' => 'required',
            'license_expiry_date' => 'required',
            'schoolyear' => 'required',
            'semester' => 'required',
            'parking_type' => 'required'
        ]);
        $hello = 'hello';

        $employee_parking = $request->user()->employeeParking()->create([
            'id_number' => $request->id_number,
            'plate_number' => $request->plate_number,
            'school_dept_office' => $request->school_dept_office,
            'contact_number' => $request->contact_number,
            'license_number' => $request->license_number,
            'license_expiry_date' => $request->license_expiry_date,
            'schoolyear' => $request->schoolyear,
            'semester' => $request->semester,
            'parking_type' => $request->parking_type,
            'or_number' => $request->or_number,
            'sticker_number' => $request->sticker_number,
            'date_issued' => $request->date_issued,
            'isPayroll' => $request->isPayroll

        ]);

        return response()->json([

            'employee_parking' => $employee_parking,
            'message' => 'Employee has been registered to Parking'
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
