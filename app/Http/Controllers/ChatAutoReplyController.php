<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AutoReply;
use App\AutoReplyCategory;
use Auth;

class ChatAutoReplyController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    /*
    * GETTING AUTO REPLIES
    * @author LORAINE VARGHESE
    * @date 04/01/2019
    * @since version 1.0.0
    * @param NULL
    * @return FAQ PAGE
    */
    public function index()
    { 
        return view('autoreply.index');
    }

    /*
    * AUTO REPLY LISTING VIEW WITH FILTERS
    * @author LORAINE VARGHESE
    * @date 04/01/2019
    * @since version 1.0.0
    * @param NULL
    * @return AUTO REPLY LIST
    */
    public function search_list(Request $request)
    {
        $response           = $request->all();
        $search_keywords    = $response['search_keywords'];
        $results            = array();  
        $results            = AutoReply::where('cmpny_id',Auth::user()->cmpny_id)->orderBy('id', 'asc');
        
        if(isset($search_keywords) && !empty($search_keywords))
        {
            $results->where(function ($results) use ($search_keywords) {
                $results->orWhere('reply', 'like', '%' . $search_keywords . '%');
            });                 
        }

        $list_count = $results->count();
        $results    = $results->paginate(config('constant.pagination_constant'));       
        $html       = view('autoreply.listview')->with(compact('results','list_count'))->render();    
        $result_arr = array('success' => true,'html' => $html);
        return $result_arr;     
    }

    /*
    * FOR EDIT AUTO REPLIES
    * @author LORAINE
    * @date 04/01/2019
    * @since version 1.0.0
    * @param NULL
    * @return AUTO REPLIES LIST
    */
    public function edit($id = null)
    {   
        $res = AutoReply::with('AutoReplies')
                            ->where('cmpny_id',Auth::user()->cmpny_id)   
                            ->where('id',$id)
                            ->first();
                            //dd($res['AutoReplies']['']);
        $auto_reply_category = AutoReplyCategory::where('cmpny_id',Auth::user()->cmpny_id)
                                ->get();
        
        return view('autoreply.create', compact('id', 'res','auto_reply_category'));
    }

    /*
    * SAVING Auto replies
    * @author LORAINE VARGHESE
    * @date 07/01/2019
    * @since version 1.0.0
    * @param NULL
    * @return AUTO REPLY LIST */   
    public function store(Request $request)
    {
        $this->validate($request,[
                'reply' => 'required',
                ],[
                'reply.required' => ' The reply field is required.',
                ]);
        $response           =   $request->all();

        $autoreplyid = AutoReply::updateOrCreate(
        [
            'id' => request('id')
        ],
        [
            'cmpny_id' => Auth::user()->cmpny_id,
            'reply' => request('reply'),
            'auto_reply_category_id' => request('auto_reply_category_id'),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'status' => request('status'),
        ])->id;
        
        if(!empty($autoreplyid))
        {
            if(!empty(request('id'))){
                $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfully updated');
            }else{
                $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfully added');
            }
        }else{
                $result_arr=array('reset'=>false,'success' => false,'message' => 'Something went wrong');
        }
        return $result_arr;     
    }

    /*
    * Function for creating auto reply
    * @author LORAINE VARGHESE
    * @date 04/01/2019
    * @since version 1.0.0
    * @param NULL
    */
    public function create()
    {
        $auto_reply_category = AutoReplyCategory::where('cmpny_id',Auth::user()->cmpny_id)
                                ->get();

        return view('autoreply.create',compact('auto_reply_category'));
    }
}
