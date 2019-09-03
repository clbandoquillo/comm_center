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

Route::get('/dashboard', 'HomeController@dashboard');

Route::get('/', 'HomeController@index')->name('home');

Route::get('/','HomeController@index');

Route::group(['middleware' => 'auth'], function () {

//Parking
Route::get('/parking','ParkingController@index');
Route::resource('/employee_parking', 'EmployeeParkingController');

//EmployeeName
Route::get('/employee_names','EmployeeController@index');

//LDAP
Route::get('/update_barcode','UpdateLDAPController@index');
Route::resource('/ldap_barcode','LDAPController');
Route::delete('/ldap_barcode/{id}','LDAPController@destroy');
});

Auth::routes();

