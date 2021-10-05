<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\AutoReplyCategory;
use Auth;

class AutoReplyCategoriesController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    /*
    * Auto reply Categories 
    * @author LORAINE VARGHESE
    * @date 03/01/2019
    * @since version 1.0.0
    * @param NULL
    * @return auto_reply_categories list
    */
	public function index()
    {
        return view('masters.autoReplyCategories.index');
    }

    /*
    * Chat Auto Reply Categories Listing 
    * @author LORAINE VARGHESE
    * @date 03/01/2019
    * @since version 1.0.0
    * @param NULL
    */
	public function search_list(Request $request)
    {	
        $response           =   $request->all();
        $search_keywords    =   $response['search_keywords'];
        $results 	= array();	
        $results = AutoReplyCategory::orderBy('id', 'asc');
		
        if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('name', 'like', '%' . $search_keywords . '%');
                   
                });
            }
		$list_count = $results->count();
        $results    = $results->paginate(config('constant.pagination_constant'));
		$html 		= view('masters.autoReplyCategories.listview')->with(compact('results','list_count'))
					->render();
		$result_arr=array('success' => true,'html' => $html);
		return $result_arr;		
	}

	/*
    * Update function for category
    * @author LORAINE VARGHESE
    * @date 03/01/2019
    * @since version 1.0.0
    * @param NULL
    * @return view for editings category
    */
	public function edit($id)
    { 
		$res = AutoReplyCategory::findOrFail($id);
				
		return view('masters.autoReplyCategories.create', compact('id','res','categories'));
    }

    /*
    * Save function for Auto Reply Category Add & Update
    * @author LORAINE VARGHESE
    * Updated @date 04/01/2019
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    {
		$this->validate($request,[
				'name' => 'required|string|max:500|unique:ori_auto_reply_category,name,'.request('id').',id,cmpny_id,'.Auth::user()->cmpny_id,
				],
				[
				'name.required' => ' The category_name field is required.',
				]);
		$response           =   $request->all();
		   
		$catid = AutoReplyCategory::updateOrCreate(
        [
            'id' => request('id')
        ],
        [
			'cmpny_id' => Auth::user()->cmpny_id,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
			'name' => request('name'),
            'status' => request('status'),
        ])->id;
			
		if(!empty($catid))
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
    * Function for creating auto reply category
    * @author LORAINE VARGHESE
    * @date 04/01/2019
    * @since version 1.0.0
    * @param NULL
    */
	public function create()
    {
		return view('masters.autoReplyCategories.create');
    }
}
