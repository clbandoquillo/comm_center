<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $semester = 2;
        $current_date = date('m/d/Y');
        $current_year = date('Y');
        $first_period_start = '06/01/' . $current_year;
        $first_period_end = '10/31/' . $current_year;
        $second_period_start = '11/01/' . $current_year;
        $second_period_end = '3/31/' . $current_year;
        $summer_period_start = '04/01/' . $current_year;
        $summer_period_end = '05/31/' . $current_year;

        if ($current_date >= $first_period_start && $current_date <= $first_period_end) {
            $semester = 1;
        } else if ($current_date >= $second_period_start && $current_date <= $second_period_end) {
            $semester = 2;
        } else if ($current_date >= $summer_period_start && $current_date <= $summer_period_end) {
            $semester = 3;
        }

        $student_names = DB::select(DB::raw("Student_List '$semester', '2019'"));
        /*$employee_name = DB::select(DB::raw("select * from ACADEMIC.dbo.studentmaster"));*/
        return response()->json([
            'student_names'=>$student_names
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
