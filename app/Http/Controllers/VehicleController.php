<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function ccfc_vehicles()
    {
        /* dd("it works!");*/
         $vehicles = DB::select(DB::raw("SELECT v.[id]
         ,v.[id_number_employee] as emp_id
         ,CASE WHEN v.[id_number_employee] is null then 'N/A' else concat(emp.clast, ', ', emp.cfirst, ' ', emp.middle) end as employee_name
         ,v.[id_number_student] as stud_id
         ,CASE WHEN v.[id_number_student] is null then 'N/A' else concat(sm.lastname, ', ', sm.firstname, ' ', sm.middlename) end as student_name
         ,v.[owner_name_lto] as owner_name_lto
         ,v.[relation_to_owner] as relation_to_owner
         ,v.[make] as make
         ,v.[model] as model
         ,v.[plate_number] as plate_number
         ,v.[color] as color
         ,v.[reg_expiry_date] as reg_expiry_date
         ,CASE WHEN v.[lto_cr] != 1 then 'N/A' else 'Submitted' end as lto_cr
         ,CASE WHEN v.[lto_or] != 1 then 'N/A' else 'Submitted' end as lto_or
         ,v.[user_id]
         ,v.[created_at]
         ,v.[updated_at]
     FROM [ccfc].[dbo].[vehicles] v
   
     left join academic.dbo.studentmaster sm on 
     sm.code = v.id_number_student collate SQL_Latin1_General_CP1_CI_AS
   
     left join [192.168.100.4].[hr].[dbo].[employee] emp on
     emp.id_no = v.id_number_employee collate SQL_Latin1_General_CP1_CI_AS
   
     order by id asc"));
         return response()->json([
             'vehicles'=>$vehicles
         ], 200);
        //
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

            'owner_name_lto' => 'required',
            'relation_to_owner' => 'required',
            'make' => 'required',
            'model' => 'required',
            'plate_number' => 'required',
            'color' => 'required',
            'reg_expiry_date' => 'required',
            'lto_cr' => 'required',
            'lto_or' => 'required'
        ]);

        $vehicle = $request->user()->vehicle()->create([
            'id_number_employee' => $request->id_number_employee,
            'id_number_student' => $request->id_number_student,
            'owner_name_lto' => $request->owner_name_lto,
            'relation_to_owner' => $request->relation_to_owner,
            'make' => $request->make,
            'model' => $request->model,
            'plate_number' => $request->plate_number,
            'color' => $request->color,
            'reg_expiry_date' => $request->reg_expiry_date,
            'lto_cr' => $request->lto_cr,
            'lto_or' => $request->lto_or

        ]);

        $json = json_decode($vehicle, true);

        return response()->json([

            'vehicle' => $vehicle,
            'message' => "A vehicle was added successfully."
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
