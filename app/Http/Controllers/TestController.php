<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{

    public function __construct() {
		date_default_timezone_set("Asia/Kolkata");
                header('Access-Control-Allow-Origin: *');
    }


    public function temp_fun()
    { 
        return view('test_file_upload');
    }
        
    public function temp_fun1( Request $request)
    { 
         if($request->hasFile('profile_image')) {
         
            //get filename with extension
            $filenamewithextension = $request->file('profile_image')->getClientOriginalName();
            
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            //Upload File to external server
//            $path = Storage::disk('ftp')->put($filenametostore, fopen($request->file('profile_image'), 'r+'));
            $path = $request->file('profile_image')->storeAs('photos', $filename);
            //Store $filenametostore in the database
             dd($path);
        }
 
     //   return redirect('images')->with('status', "Image uploaded successfully.");
       
    }

}
