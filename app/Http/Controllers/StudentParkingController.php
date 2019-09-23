<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class StudentParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $student_parkings = DB::select(DB::raw("select * from student_parking;"));
        return response()->json([
            'student_parkings'=>$student_parkings
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
        /*
    protected $fillable = [
        'id_number',
        'plate_number',
        'or_number',
        'contact_number',
        'license_number',
        'license_expiry_date',
        'schoolyear',
        'semester',
        'parking_type',
        'sticker_number',
        'date_issued'
    ];*/
        $request->validate([
            'id_number' => 'required',
            'plate_number' => 'required',
            'or_number' => 'required',
            'contact_number' => 'required',
            'license_number' => 'required',
            'license_expiry_date' => 'required',
            'schoolyear' => 'required',
            'semester' => 'required',
            'parking_type' => 'required',
            'sticker_number' => 'required',
            'date_issued' => 'required'
        ]);

        $student_parking = $request->user()->studentParking()->create([
            'id_number' => $request->id_number,
            'plate_number' => $request->plate_number,
            'or_number' => $request->sticker_number,
            'contact_number' => $request->contact_number,
            'license_number' => $request->license_number,
            'license_expiry_date' => $request->license_expiry_date,
            'schoolyear' => $request->schoolyear,
            'semester' => $request->semester,
            'parking_type' => $request->parking_type,
            'sticker_number' => $request->sticker_number,
            'date_issued' => $request->date_issued 
        ]);

        return response()->json([

            'student_parking' => $student_parking,
            'message' => 'Student has been registered to Parking'
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
