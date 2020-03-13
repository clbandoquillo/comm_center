<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentSwimmingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $student_swimming = DB::select(DB::raw("EXEC Student_Swimming_List"));
        return response()->json([
            'student_swimming'=>$student_swimming
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
            'student_id_number' => 'required',
            'or_number' => 'required',
            'swimming_type' => 'required',
            'totalHrs' => 'required',
            'schoolyear' => 'required',
            'semester' => 'required',
            'date_time_usage' => 'required',
            'amount' => 'required'
        ]);

        $student_swimming = $request->user()->studentSwimming()->create([
            'student_id_number' => $request->student_id_number,
            'or_number' => $request->or_number,
            'swimming_type' => $request->swimming_type,
            'totalHrs' => $request->totalHrs,
            'schoolyear' => $request->schoolyear,
            'semester' => $request->semester,
            'date_time_usage' => $request->date_time_usage,
            'amount' => $request->amount
        ]);

        return response()->json([

            'student_swimming' => $student_swimming,
            'message' => 'Student has been registered to Swimming'
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
