<?php
//designation management
Route::resource('/designations', 'DesignationController');
Route::post('search_designation', 'DesignationController@search_list');
Route::post('add_designation', 'DesignationController@add_designation');
Route::post('/get_dept_designation', 'DesignationController@get_designation_by_dept');

Route::post('/get_location','CustomerProfileController@get_location');
Route::post('/get_localbody','CustomerProfileController@get_localbody'); 
Route::post('/get_panchayath_details','CustomerProfileController@get_panchayath_details');
Route::post('/get_taluk_village','CustomerProfileController@get_taluk_village'); 
