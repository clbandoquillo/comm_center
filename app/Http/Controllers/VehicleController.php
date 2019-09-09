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
         $vehicles = DB::select(DB::raw("select * from vehicles;"));
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

            'id_number' => 'required',
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
            'id_number' => $request->id_number,
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
