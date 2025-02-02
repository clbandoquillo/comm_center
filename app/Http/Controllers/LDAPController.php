<?php

namespace App\Http\Controllers;

use App\Ccfcldap;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LDAPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        //
        //dd(DB::connection());
        $ldaps = DB::select(DB::raw("select * from ccfc_ldap;"));
        return response()->json([
            'ldaps'=>$ldaps
        ], 200);
    }

    public function system_role()
    {
        //
        //dd(DB::connection());
        $system_roles = DB::select(DB::raw("select * from system_roles;"));
        return response()->json([
            'system_roles'=>$system_roles
        ], 200);
    }

    public function show_ldap()
    {
        //
        $system_role = \Auth::user()->system_role;

        if($system_role == 4){
            return view('update_barcode');
        }
        else{
            return view('redirect.redirect');
        }
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

            'ldap_username' => 'required',
            'id_number' => 'required',
            'system_role' => 'required',
            'status' => 'required'
        ]);

        $ldap = $request->user()->ldap()->create([
            'ldap_username' => $request->ldap_username,
            'id_number' => $request->id_number,
            'system_role' => $request->system_role,
            'status' => $request->status

        ]);

        $json = json_decode($ldap, true);
        $lu = $json['ldap_username'];
        $idn = $json['id_number'];

        $update = \DB::table('users') ->where('common_name', $request->ldap_username) ->limit(1) ->update( [ 'common_name' => $request->ldap_username, 'system_role' => $request->system_role ]); 

        return response()->json([

            'ldap' => $ldap,
            'message' => "Username: $lu <br> ID Number: $request->id_number <br> LDAP has been registered."
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

            'ldap_username' => 'required',
            'id_number' => 'required',
            'system_role' => 'required',
            'status' => 'required'
        ]);

        //$ldap = $request->user()->ldap()->whereId($id)->update($request->all());
        
        $ldap = \DB::table('ccfc_ldap') ->where('id', $id) ->limit(1)->update($request->all()); 

        $update = \DB::table('users') ->where('common_name', $request->ldap_username) ->limit(1) ->update( [ 'common_name' => $request->ldap_username, 'system_role' => $request->system_role ]); 

        return response()->json([

            'ldap' => $ldap,
            'message' => 'LDAP has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ldap)
    {
        //
        $ccfc_user = \App\Ccfcldap::findOrFail($ldap)->delete();
        
        return response()->json([
            'ldap' => $ccfc_user,
            'message' => 'User LDAP has been deleted'
        ]);
    }
}
