<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use Mail;
use Auth;
use App\NotificationsRolesRelations;
use App\NotificationsList;
use Carbon\Carbon;


 /**
    * Intimations  Controller
    * @author RINKU.E.B
    * @date 13/09/2018
    * @since version 1.0.0
    * @param NULL
    * @return 
   */ 

class NotificationsController extends Controller
{
	public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:notification list',   ['only' => ['index','search_list']]);
    }
	
	/*
    * @author RINKU.E.B. 
    * @date 20/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return NOTIFICATION LIST 
    */
	public function index()
    {
        return view('masters.Notifications.index');
    }
	
	/*
    * NOTIFICATIONS LIST
    * @author RINKU.E.B. 
    * @date 20/11/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function search_list(Request $request)
    {	
        $response           =   $request->all();
        $search_keywords    =   $response['search_keywords'];
        $results = array();	
		$user_id = Auth::User()->id;
        $results = NotificationsRolesRelations::select('ori_notifications_list.title','ori_notifications_list.comment','ori_notifications_list.link','ori_notifications_roles_relations.id','ori_notifications_list.download_flag','ori_notifications_list.created_at')->join('ori_notifications_list','ori_notifications_list.id','=','ori_notifications_roles_relations.notification_id')->where('ori_notifications_roles_relations.user_id',$user_id)->orderBy('ori_notifications_list.id','desc');
        if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('title', 'like', '%' . $search_keywords . '%');
					$results->orWhere('comment', 'like', '%' . $search_keywords . '%');
                });
            }
		$list_count = $results->count();
        $results    =   $results->paginate(config('constant.pagination_constant'));
		$arr = array('status' => config('constant.ACTIVE'));
		foreach($results as $data)
		{
			NotificationsRolesRelations::where('id',$data->id)->where('status',config('constant.INACTIVE'))->update($arr);
		}
		$html = view('masters.Notifications.listview')->with(compact('results','list_count'))->render();
		$result_arr=array('success' => true,'html' => $html);
		return $result_arr;		
	}
	/**
    * Notification List
    * @author RINKU.E.B
    * @date 19/11/2018
    * @param NULL
    * @return 
   */ 
   public function get_notifications()
   { 
		$user_id = Auth::User()->id;
		$results = NotificationsRolesRelations::select('ori_notifications_list.title','ori_notifications_list.comment','ori_notifications_list.link','ori_notifications_list.download_flag', 'ori_notifications_list.created_at')->join('ori_notifications_list','ori_notifications_list.id','=','ori_notifications_roles_relations.notification_id')->where('ori_notifications_roles_relations.user_id',$user_id)->orderBy('ori_notifications_list.id','desc')->limit(5)->get();

		echo json_encode($results);
	    
   }
	/**
    * Update Unread Count
    * @author RINKU.E.B
    * @date 19/11/2018
    * @param NULL
    * @return 
   */
	public function update_unreadcount()
	{
		$user_id = Auth::User()->id;
		$count = NotificationsRolesRelations::where('user_id',$user_id)->where('status',config('constant.INACTIVE'))->count();
		echo $count;
	}
	/**
    * Update unseen status of notification
    * @author RINKU.E.B
    * @date 20/11/2018
    * @param NULL
    * @return 
   */
	public function read_notification_status()
	{
		$user_id = Auth::User()->id;
		$updarr = array('status' => config('constant.ACTIVE'));
		$count = NotificationsRolesRelations::where('user_id',$user_id)->where('status',config('constant.INACTIVE'))->update($updarr);
	}
	
	
	
}