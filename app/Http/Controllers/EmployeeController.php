<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    public function index()
    {
        $employee_names = DB::select(DB::raw("select id_no, cPosition, CONCAT(cLast, ', ', cFirst, ' ', middle, ' - ', status2) as emp_name, status2 from ADDUDTR.[hr].[dbo].[employee] where status2 = 'CONFIDENTIAL' or status2 = 'PART-TIME' or status2 = 'PROBATIONARY' or status2 = 'REGULAR' order by cLast asc"));
        /*$employee_name = DB::select(DB::raw("select * from ACADEMIC.dbo.studentmaster"));*/
        return response()->json([
            'employee_names'=>$employee_names
        ], 200);

    }
}
