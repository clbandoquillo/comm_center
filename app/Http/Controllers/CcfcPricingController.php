<?php

namespace App\Http\Controllers;

use DB;
use App\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CcfcPricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* dd("it works!");*/
        $pricings = DB::select(DB::raw("SELECT p.id as id, p.service_name as service_name, 
        p.price as price, 
        p.schoolyear as schoolyear, 
        p.semester as semester, 
		cat.id as category_id,
        cat.category_Name as category_Name, 
        p.status as status
 
        FROM [ccfc].[dbo].[pricings] p inner join ccfc_category cat on p.category_id = cat.id;"));
        return response()->json([
            'pricings'=>$pricings
        ], 200);
    }

    
    public function list_pricing()
    {
        /* dd("it works!");*/
        $pricings = DB::select(DB::raw("SELECT p.id as id, p.service_name as service_name, 
        p.price as price, 
        p.schoolyear as schoolyear, 
        p.semester as semester, 
        cat.category_Name as category_Name, 
        cat.status as status
 
        FROM [ccfc].[dbo].[pricings] p inner join ccfc_category cat on p.category_id = cat.id where category_Name = 'parking' and p.status = 1"));
        return response()->json([
            'pricings'=>$pricings
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

            'service_name' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'schoolyear' => 'required',
            'semester' => 'required',
            'status' => 'required'
        ]);

        $pricing = $request->user()->pricing()->create([
            'service_name' => $request->service_name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'schoolyear' => $request->schoolyear,
            'semester' => $request->semester,
            'status' => $request->status

        ]);

        $json = json_decode($pricing, true);

        return response()->json([

            'pricing' => $pricing,
            'message' => "A pricing was added successfully."
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
        $request->validate([

            'service_name' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'schoolyear' => 'required',
            'semester' => 'required',
            'status' => 'required'
        ]);

        //$pricing = $request->user()->pricing()->whereId($id)->update($request->all());
        
        $pricing = \DB::table('pricings') ->where('id', $id) ->limit(1)->update($request->all()); 

        return response()->json([
            
            'pricing' => $pricing,
            'message' => 'CCFC Pricings has been updated'
        ]);
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
