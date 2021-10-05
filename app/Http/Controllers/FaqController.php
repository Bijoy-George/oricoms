<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Faq;
use App\QueryTypes;
use App\FaqCategories;
use Auth;
use Helpers;

class FaqController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
	   $this->middleware('check-permission:faq create', ['only' => ['create']]);
       $this->middleware('check-permission:faq edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:faq edit|faq create',   ['only' => ['store']]);
       $this->middleware('check-permission:faq list',   ['only' => ['index','search_list']]);
       $this->middleware('check-permission:faq delete',   ['only' => ['destroy']]);
    }
	
   /*
    * GETTINGS FAQ
    * @author ELAVARASI
    * @date 04/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return FAQ PAGE
    */
    public function index()
    { 
        return view('faq.index');
    }
	
	/*
    * FAQ LISTING VIEW WITH FILTERS
    * @author ELAVARASI
    * @date 04/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return FAQ LIST
    */
	public function search_list(Request $request)
	{
		$response           = $request->all();
        $search_keywords    = $response['search_keywords'];
		$results 			= array();	
		$results 			= Faq::where('cmpny_id',Auth::user()->cmpny_id)->orderBy('id', 'asc')->orderBy('sort_order','asc');
		
		if(isset($search_keywords) && !empty($search_keywords))
		{
			$results->where(function ($results) use ($search_keywords) {
				
				$results->orWhere('question_lang1', 'like', '%' . $search_keywords . '%')
				->orWhere('question_lang2', 'like', '%' . $search_keywords . '%')
				->orWhere('answer_lang1', 'like', '%' . $search_keywords . '%')
				->orWhere('answer_lang2', 'like', '%' . $search_keywords . '%')			
				->orWhere('keywords', 'like', '%' . $search_keywords . '%');
		
			});					
		}		
		$list_count = $results->count();
		$results    = $results->paginate(config('constant.pagination_constant'));		
		$html 		= view('faq.listview')->with(compact('results','list_count'))->render();	
		$result_arr = array('success' => true,'html' => $html);
		return $result_arr;		
		

	}
	/*
    * FOR CREATE FAQ
    * @author ELAVARASI
    * @date 04/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return FAQ LIST
    */
	public function create()
    {   
		$query_types = ['' => 'Select'] + QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)->orderBy('query_type')->pluck('query_type', 'id')->all();
		
		$query_categories = ['' => 'Select'] + FaqCategories::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->whereNull('parent_category_id')->orderBy('category_name')->pluck('category_name', 'id')->all();
		
		return view('faq.create', compact('query_types','query_categories'));
    }
    /*
    * FOR EDIT FAQ
	* @author ELAVARASI
    * @date 04/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return FAQ LIST
    */
	public function edit($id = null)
    {   
		$res = Faq::select('id','query_title_lang1','question_lang1','answer_lang1','query_title_lang2','question_lang2','answer_lang2', 'answer_lang1_short', 'answer_lang2_short', 'query_type_id', 'faq_cat_id', 'keywords', 'status','show_in_chat_auto_reply','sort_order')
				->where('id',$id)
				->where('cmpny_id',Auth::user()->cmpny_id)
				->first();
				
		$query_types = ['' => 'Select'] + QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)->orderBy('query_type')->pluck('query_type', 'id')->all();
		
		/*$query_categories = ['' => 'Select'] + FaqCategories::join('ori_mast_query_category_relation', 'ori_mast_query_category_relation.category_id', '=', 'ori_mast_faq_categories.id')
		->where('ori_mast_query_category_relation.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_mast_query_category_relation.query_type_id',$res->query_type_id)
		->where('ori_mast_faq_categories.cmpny_id',Auth::user()->cmpny_id)
		->orderBy('ori_mast_faq_categories.category_name')
		->pluck('ori_mast_faq_categories.category_name', 'ori_mast_faq_categories.id')
		->all();*/

        $query_categories = ['' => 'Select'] + FaqCategories::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->whereNull('parent_category_id')->orderBy('category_name')->pluck('category_name', 'id')->all();
		
		return view('faq.create', compact('id', 'res', 'query_types', 'query_categories'));
		
    }
	/*
    * SAVING FAQ DETAILS
    * @author ELAVARASI
    * @date 04/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return FAQ LIST */	
    public function store(Request $request){
		
		 $this->validate($request,[
    			//'query_title_lang1' => 'required',
    			//'question_lang1' => 'required',
    			//'answer_lang1' => 'required',
    			//'query_title_lang2' => 'required',
    			//'question_lang2' => 'required',
    			//'answer_lang2' => 'required',
    			//'answer_lang1_short' => 'required',
    			//'answer_lang2_short' => 'required',
				'query_title_lang1' => 'required_without:query_title_lang2',
				'query_title_lang2' => 'required_without:query_title_lang1',
    			//'query_type_id' => 'required',
    			'keywords' => 'required',
    			],[
				'query_title_lang1.required' => ' The Query title field is required.',
				//'question_lang1.required' => ' The Question field is required.',
				//'answer_lang1.required' => ' The Answer field is required.',
				'query_title_lang2.required' => ' The Query title field is required.',
				//'question_lang2.required' => ' The Question field is required.',
				//'answer_lang2.required' => ' The Answer field is required.',
				//'answer_lang1_short.required' => ' The Short Answer field is required.',
				//'answer_lang2_short.required' => ' The Short Answer field is required.',
				//'query_type_id.required' => ' The Query Type field is required.',
				'keywords.required' => ' The Keywords field is required.',
				]);
		$faq_cat_id = (request('faq_cat_id') != 0)? request('faq_cat_id') : NULL;
		$res = Faq::updateOrCreate(['id' => request('id')],
								[
									'cmpny_id' => Auth::user()->cmpny_id,
									'query_title_lang1' => request('query_title_lang1'),
									'question_lang1' => request('question_lang1'),
									'answer_lang1' => request('answer_lang1'),'query_title_lang2' => request('query_title_lang2'),
									'question_lang2' => request('question_lang2'),
									'answer_lang2' => request('answer_lang2'),
									'answer_lang1_short' => request('answer_lang1_short'),
									'answer_lang2_short' => request('answer_lang2_short'),
									'query_type_id' => request('query_type_id'),
									'faq_cat_id' => $faq_cat_id,
									'keywords' => request('keywords'),
                                    'status' => request('status'),
                                    'show_in_chat_auto_reply' => request('show_in_chat_auto_reply'),
									'sort_order' => 1
								])->id;
			
		//$result_arr = array('success' => true,'message' => 'Successfully updated');
		//return $result_arr;

         if(!empty($res)){
                if(!empty(request('id'))){
                    $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
                }else{
                    $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfuly added');
                }
            }else{
                    $result_arr=array('reset'=>false,'success' => false,'message' => 'Something went wrong');
            }
            return $result_arr;


			
			
	}
	/*
    * DELETE FAQ
    * @author ELAVARASI
    * @date 04/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return FAQ LIST 
    */
    public function destroy(Request $request)
    {
		$id = request('id');
		if($id)
        {
            $res = FAQ::find($id);
			$res->delete();
        }
		$result_arr = array('success' => true,'message' => 'Successfully deleted');
		return $result_arr;    
    }
	
	/**
    * Faq auto complete list
    * @author PRANEESHA KP
    * @date 20/11/2018
    * @since version 1.0.0
    * @return profile page
   */          
    public function faqAutocomplete(Request $request)
        { 
            $response           =   $request->all();//print_r($response);die;
            $results            = 	array();
			$current_lang       =   ''; 
            if(isset($response['req_title']) && !empty($response['req_title']))
                {
                    $search_keywords    =   $response['req_title'];
                    if(isset($response['cat_id']) && !empty($response['cat_id'])){
                    $search_cat_id      =   $response['cat_id'];
                    }else{
                        $search_cat_id      =0;
                    }
                    if(isset($response['query_type']) && !empty($response['query_type'])){
                    $query_type_id      =   $response['query_type'];
                    }else{
                        $query_type_id      =0;
                    }
                    
					
					$faq=FAQ::where('status',config('constant.ACTIVE'));
                    if($search_cat_id != 0)
                    {
                         $faq->where('faq_cat_id',$search_cat_id);
                    }
                    if($query_type_id != 0)
                    {
                         //$faq->where('query_type_id',$query_type_id);
                    }
                    if(!empty($search_keywords))
                    {
                        if($current_lang == 'true')
                        {
                            $faq->where('query_title_lang1', 'like', '%' . $search_keywords . '%');
                        }else
                        {
                             $faq->where('query_title_lang2', 'like', '%' . $search_keywords . '%'); 
                        }
                         
                    }    
                    $data=$faq->get(); 
					foreach ($data as $key => $v) 
                        {
                            if($current_lang == 'true')
                            {
                            $results[]  =  ['id'=>$v->id,'value'=>$v->query_title_lang1,'ques'=>$v->question_lang1,'desc'=>$v->answer_lang1,'mal_title'=>$v->query_title_lang1,'sol_mal'=>$v->answer_lang1,'short_sms'=>$v->answer_lang1_short];
                            }else
                            {
                            $results[]  =  ['id'=>$v->id,'value'=>$v->query_title_lang2,'ques'=>$v->question_lang2,'desc'=>$v->answer_lang2,'mal_title'=>$v->query_title_lang2,'sol_mal'=>$v->answer_lang2,'short_sms'=>$v->answer_lang2_short];  
                            }    
                            
                        }
					return response()->json($results);
                }
        }
	/*
    * SAVING FAQ DETAILS
    * @author ELAVARASI
    * @date 04/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return FAQ LIST */   
    public function add_faq(Request $request){
        $this->validate($request,[
                'query_type' => 'required',
                'query_category' => 'required',
                'req_title' => 'required',
                'question' => 'required',
                'answer' => 'required',
                ],[
                'query_type.required' => ' The Query Type field is required.',
                'query_category.required' => ' The Query Category field is required.',
                'req_title.required' => ' The Query title field is required.',
                'question.required' => ' The Question field is required.',
                'answer.required' => ' The Answer field is required.',
                ]);                
        $response           =   $request->all();
        $query_type_id      =   $response['query_type'];
        $faq_cat_id         =   $response['query_category'];
        $title              =   $response['req_title'];
        $question_lang2     =   $response['question'];
        $answer_lang2       =   $response['answer'];
        $faq_cat_id = ($faq_cat_id != 0)? $faq_cat_id : NULL;
        $res = Faq::Create([
                            'cmpny_id' => Auth::user()->cmpny_id,
                            'query_title_lang1' => $title,
                            'query_title_lang2' => $title,
                            'question_lang1' => $question_lang2,
                            'answer_lang1' => $answer_lang2,
                            'question_lang2' => $question_lang2,
                            'answer_lang2' => $answer_lang2,
                            'answer_lang1_short' => NULL,
                            'answer_lang2_short' => NULL,
                            'query_type_id' => $query_type_id,
                            'faq_cat_id' => $faq_cat_id,
                            'keywords' => $title,
                            'status' => config('constant.INACTIVE'),
                            'sort_order' => 1
                        ])->id;
        $users = Helpers::getUserByPermission('faq edit');
        if(count($users)){
            foreach ($users as $user => $val) {
                $user_id = $val;
                $cmpny_id = Auth::user()->cmpny_id;
                $title = 'Suggest FAQ';
                $comment = 'View';  
                $fpath = url('/faqs').'/'.$res.'/edit';
                $link = $fpath;
                $created_by = Auth::user()->id;
                $flag = config('constant.INACTIVE');
                Helpers::add_notifications($user_id,$title,$comment,$link,$created_by,$flag,$cmpny_id);
            }
        }

        if(!empty($res)){
            if(!empty(request('id'))){
                $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
            }else{
                $result_arr=array('reset'=>true,'success' => true,'message' => 'Faq added successfuly');
            }
        }else{
            $result_arr=array('reset'=>false,'success' => false,'message' => 'Something went wrong');
        }
        return $result_arr;
            
    }
}
