<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    public function index()
    {
        $employee_names = DB::select(DB::raw("Employee_List"));
        /*$employee_name = DB::select(DB::raw("select * from ACADEMIC.dbo.studentmaster"));*/
        return response()->json([
            'employee_names'=>$employee_names
        ], 200);

    }
}
