<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyProfile;
use Auth;
use App\CompanyMeta;
use App\Plan;
use App\User;
use App\UserRole;
use App\PasswordHistory;
use App\PasswordSecurity;
use App\Permission;
use Carbon\Carbon;
use App\Helpers;
use Illuminate\Support\Facades\Hash;
use App\CustomerProfile;
use App\PackagePermission;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
   /*
    * Profile Controller
    * @author AKHIL MURUKAN
    * @date 11/13/2018
    * @since version 1.0.0
    * @param NULL
    * @return
    */
class CompanyProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   /*
    * Getting Company Profile Details
    * @author AKHIL MURUKAN
    * @date 11/13/2018
    * @since version 1.0.0
    * @param NULL
    * @return profile page
    */
   
	
	
	
}
