<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Adldap\Laravel\Facades\Adldap;

Auth::routes([
    'reset' => false,
    'verify' => false,
    'register' => false
]);


Route::get('/dashboard', 'HomeController@index');
Route::get('/forbidden', 'HomeController@forbidden');

Route::get('/', 'HomeController@index')->name('home');

Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {

    //Swimming
    Route::get('/swimming', 'SwimmingController@index');
    Route::resource('/employee_swimming', 'EmployeeSwimmingController');
    Route::resource('/student_swimming', 'StudentSwimmingController');

    //Parking
    Route::get('/parking', 'ParkingController@index');
    Route::resource('/employee_parking', 'EmployeeParkingController');
    Route::resource('/student_parking', 'StudentParkingController');

    //Pricing
    Route::get('/pricing', 'PricingController@index');
    Route::resource('/ccfc_pricing', 'CcfcPricingController');
    Route::get('/ccfc_pricing_1', 'CcfcPricingController@list_pricing');

    //Services
    Route::resource('/ccfc_services', 'CcfcServicesController');

    //EmployeeName
    Route::get('/employee_names', 'EmployeeController@index');

    //StudentName
    Route::get('/student_names', 'StudentController@index');

    //Vehicles
    Route::get('/ccfc_vehicles', 'VehicleController@ccfc_vehicles');
    Route::get('/ccfc_emp_vehicles', 'VehicleController@ccfc_emp_vehicles');
    Route::get('/ccfc_stud_vehicles', 'VehicleController@ccfc_stud_vehicles');
    Route::resource('/ccfc_vehicles_process', 'VehicleController');

    //Vehicle Make
    Route::get('/ccfc_vehicle_make', 'VehicleMakeController@ccfc_vehicle_make');

    //LDAP
    Route::get('/update_barcode', 'LDAPController@show_ldap');
    Route::get('/ldap_roles', 'LDAPController@system_role');
    Route::resource('/ldap_barcode', 'LDAPController');
    //Route::post('/ldap_barcode','LDAPController@store');
    Route::delete('/ldap_barcode/{id}', 'LDAPController@destroy');
});
