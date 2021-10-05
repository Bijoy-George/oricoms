<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Plan;
use App\PlanDuration;
use App\CmpSubscriptions;
use App\CompanyProfile;
use App\CouponCodes;
use Lang;
use Carbon\Carbon;
use App\Helpers;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

     /**
    * login
    * @author AKHIL MURUKAN
    * @date 12/03/2018
    * @since version 1.0.0
   */
    use AuthenticatesUsers;

    protected $maxAttempts = 3;
	protected $decayMinutes = 3; // minute
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	/**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
		
		/*if(request('login_error') == 1){
			$request->merge(['password' => bcrypt(request('password'))]);
		}*/

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
			
		    if(Auth::user()->status == config('constant.INACTIVE'))
			{ 
				$this->guard()->logout();
				return redirect()->back()->with('message', 'Sorry! Your Account has been Inactive.');
			}
			if(request('login_error') == 0 && Auth::user()->logged_in == config('constant.INACTIVE')){ 
			    $chat_agent_role = config('constant.USER_ROLE_CHAT_AGENT');
				$user = User::where('role_id','like','%:"' . $chat_agent_role . '";%')->where('id',Auth::user()->id);
				if(!empty($user)){
					$this->guard()->logout();
					return redirect()->back()->with('error', 'login_error');
				}
			}
			
			
			$sbcryptn_status= config('constant.SUBSCRIPTION_STATUS');
			$first_sub_flag = 1;
			$cmp_id			= Auth::user()->cmpny_id;
			$is_subscribed	= CmpSubscriptions::where('cmpny_id',$cmp_id)
							//->where('status',$sbcryptn_status[1])
							->get();
			$date 			= date('Y-m-d H:i:s');
			$plan_list 	 	 =  PlanDuration::where('status',config('constant.ACTIVE'))
							->whereDate('start_date', '<=' , $date) 
							->whereDate('end_date', '>' , $date) 
							->get();
			foreach($plan_list as $plan)
			{
				$planid		=	$plan->plan_id;
				$amount		=	$plan->amount;
				$res			   =  CouponCodes::select('ori_mast_coupon_codes.coupon_code','ori_mast_coupon_codes.discount','ori_mast_coupon_codes.disc_flag')
										->whereDate('ori_mast_coupon_codes.valid_from', '<' , $date)
										->where('plan_id',$planid)
										->whereDate('ori_mast_coupon_codes.valid_to', '>=' , $date) 
										->first();
				$plan->coupon_code		= $res['coupon_code'];
				$plan->discount			= $res['discount'];
				$plan->disc_flag		= $res['disc_flag'];
				
				if(isset($plan->disc_flag) && ($plan->disc_flag == 1))
				{
					$plan->discount = ($plan->discount / 100 *$amount);
				}
										
			}
			if(Auth::user()->cmpny_id == config('constant.ORICOM_ADMIN'))
			{
				$user = User::find(Auth::user()->id);
				$user->logged_in = config('constant.ACTIVE');
				$user->save();

				Helpers::set_user_logs(Auth::user()->id, 'login', 'you are loggedin');
				return $this->sendLoginResponse($request);
			}
			
			else if(count($is_subscribed)>0)
			{
					$first_sub_flag = 0;
					$last_subscryptn = CmpSubscriptions::select('id','extended_expiry_date')
									->where('cmpny_id',Auth::user()->cmpny_id)
									//->where('status',$sbcryptn_status[1])
									//->where('extended_expiry_date','>',Carbon::now())
									->orderBy('id', 'desc')
									->first();
					$is_Admin	=	CompanyProfile::select('id')
									->where('id',Auth::user()->cmpny_id)
									->where('ori_cmp_org_email',Auth::user()->email)
									->get();
					if(($last_subscryptn['extended_expiry_date']<Carbon::now()) && (count($is_Admin)>0))
					{
						$this->guard()->logout();
						return view('subsriptions.subscription_expired',compact('plan_list','cmp_id','first_sub_flag'));
						
					}
					
					else if($last_subscryptn['extended_expiry_date']<Carbon::now())
					{ 	
						$this->guard()->logout();
						return redirect()->back()->with('error', 'Subsription has been expired.Kindly contact your superadmin');
					}
					else
					{
						$user = User::find(Auth::user()->id);
						$user->logged_in = config('constant.ACTIVE');
						$user->save();

						Helpers::set_user_logs(Auth::user()->id, 'login', 'you are loggedin');
						return $this->sendLoginResponse($request);
					}
			}
			else
			{
					$this->guard()->logout();
					return view('subsriptions.new_subscription',compact('plan_list','cmp_id','first_sub_flag'));
					
			}
				
		}	
				
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
		
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );
    }

	protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        $hours = floor($seconds /3600);
		$minutes = floor(($seconds / 60) % 60);
		$seconds = $seconds % 60;

		$val = $hours.' '.'hours'.' '.$minutes.' '.'minutes'.' '.$seconds;
		
        $message = Lang::get('auth.throttle', ['seconds' => $val]);

        $errors = [$this->username() => $message];

        if ($request->expectsJson()) {
            return response()->json($errors, 423);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }
	/**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
		return array_merge($request->only($this->username(), 'password'));
    }
	public function authenticated(Request $request, $user)
		{
			$request->session()->forget('password_expired_id');
		    if(isset($user->passwordSecurity->password_updated_at) && !empty($user->passwordSecurity->password_updated_at) && isset($user->passwordSecurity->password_expiry_days) && !empty($user->passwordSecurity->password_expiry_days))
			{
				$password_updated_at = $user->passwordSecurity->password_updated_at;
				$password_expiry_days = $user->passwordSecurity->password_expiry_days;
				$password_expiry_at = Carbon::parse($password_updated_at)->addDays($password_expiry_days);
				if($password_expiry_at->lessThan(Carbon::now())){
					$request->session()->put('password_expired_id',$user->id);
					auth()->logout();
					return redirect('/passwordExpiration')->with('message', "Your Password is expired, You need to change your password.");
				}
			}
			$obj_user = User::find($user->id);
			$obj_user->last_logged_in_at = Carbon::now();
			$obj_user->save();
			return redirect()->intended($this->redirectPath());
		}
		  /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        $login = request()->input('login');
 
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
 
        request()->merge([$fieldType => $login]);
 
        return $fieldType;
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

		if(Auth::user() == NULL){
			return redirect('/');
		}
		$user = User::find(Auth::user()->id);
		$user->logged_in = 0;
		$user->save();

		Helpers::set_user_logs(Auth::user()->id, 'logout', 'you are logged out');

        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

	
	/**
     * Restrict login with multiple machine
     *
     * @return void
     */
	protected function sendLoginResponse(Request $request)
	{
		$request->session()->regenerate();

		$previous_session = Auth::User()->session_id;
		$cur_session = User::select('session_id')->where('id', Auth::User()->id)->first();

		if ($previous_session != '' AND $previous_session != $cur_session) {
		//	\Session::getHandler()->destroy($previous_session);
		}

		Auth::user()->session_id = \Session::getId();
		Auth::user()->save();
		$this->clearLoginAttempts($request);

		return $this->authenticated($request, $this->guard()->user())
				?: redirect()->intended($this->redirectPath());
	}
}
