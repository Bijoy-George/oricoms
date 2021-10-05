<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Lang;
class LandpageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Landpage Controller
    |--------------------------------------------------------------------------
    |
    | This controller loads land page also handles authenticating users for the application | and redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

     /**
    * login
    * @author Chinnu L
    * @date 06/10/2018
    * @since version 1.0.0
   */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index()
    {
		 return view('landpage.index');
    }
 
}
