<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\SupplyOffices;
use App\Helpers;
use Auth;
use DB;
use App\Http\Controllers\Controller;

class SupplyOfficesController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:supply office create', ['only' => ['create']]);
       $this->middleware('check-permission:supply office edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:supply office edit|supply office create',   ['only' => ['store']]);
       $this->middleware('check-permission:supply office list',   ['only' => ['index','search_list']]);
       $this->middleware('check-permission:supply office delete',   ['only' => ['destroy']]);
    }
	/*
    * Faq Categories 
    * @author PRANEESHA KP
    * @date 09/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return faq_categories list
    */
	public function index()
    {
        return view('masters.supply_offices.index');
    }
	
	/*
    * Categories Listing 
    * @author PRANEESHA KP
    * @date 09/10/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function search_list(Request $request)
    {	
        $response           =   $request->all();
        $search_keywords    =   $response['search_keywords'];
        $results 	= array();	
        $results = SupplyOffices::orderBy('id', 'asc')->where('status',config('constant.ACTIVE'))->orderBy('sort_order','asc');
		
        if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('supply_office', 'like', '%' . $search_keywords . '%');
                   
                });
            }
		$list_count = $results->count();
        $results    = $results->paginate(config('constant.pagination_constant'));
		$html 		= view('masters.supply_offices.listview')->with(compact('results','list_count'))
					->render();
		$result_arr=array('success' => true,'html' => $html);
		return $result_arr;		
	}
	
	/*
    * Function for creating category
    * @author PRANEESHA KP
    * @date 09/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for editings query_types
    */
	public function create()
    {
		
		$categories  = ['' => 'Select'] + SupplyOffices::orderBy('supply_office')
					 ->whereNull('parent_id')
					 ->where('status',config('constant.ACTIVE'))
					 ->pluck('supply_office', 'id')
					 ->all();


		$array = DB::select("SELECT
    `cat`.`supply_office` AS 'supply_office',
    `cat`.`id` AS 'id',
    `cat2`.`supply_office` AS 'parent_category'
FROM
    `ori_mast_supply_offices` AS `cat`
LEFT JOIN `ori_mast_supply_offices` AS `cat2` ON `cat`.`parent_id` = `cat2`.`id`
ORDER BY
    'parent_category'");


		return view('masters.supply_offices.create', compact('categories','array'));
    }
	
	/*
    * Update function for category
    * @author PRANEESHA KP
    * @date 09/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for editings category
    */
	public function edit($id)
    { 

		$res 		 	=SupplyOffices::findOrFail($id);
		$cat_res 		=SupplyOffices::where('id',$id)	
						->pluck('id', 'id')
						->all();
		/*$categories = ['' => 'Select'] +QueryCategoryRelation::select('ori_mast_faq_categories.id','ori_mast_faq_categories.category_name')
				 ->leftJoin('ori_mast_faq_categories', 'ori_mast_query_category_relation.category_id', '=', 'ori_mast_faq_categories.id')
				 ->whereIn('ori_mast_query_category_relation.query_type_id',$type_relation)
				 ->whereNotIn('ori_mast_faq_categories.id',$cat_res)
				 ->distinct('ori_mast_query_category_relation.category_id')
				 ->pluck('ori_mast_faq_categories.category_name', 'ori_mast_faq_categories.id')
						->all();*/

		$categories 		= ['' => 'Select'] + SupplyOffices::where('cmpny_id',Auth::user()->cmpny_id)	
						->pluck('supply_office', 'id')
						->all();

		$array = DB::select("SELECT `cat`.`supply_office` AS 'supply_office', `cat2`.`supply_office` AS 'parent_category' FROM `ori_mast_supply_offices` AS `cat` LEFT JOIN `ori_mast_supply_offices` AS `cat2` ON `cat`.`parent_id` = `cat2`.`id`  ORDER BY 'parent_category'");

		//dd($res); exit;
		//echo "<pre>"; var_dump($categories); exit;
		return view('masters.supply_offices.create', compact('id','res','cat_res','categories','array'));
    }


    /*
    * Save function for Query Types Add&Update
    * @author PRANEESHA KP
    * Updated @date 10/10/2018
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    {
    	//$p_id = 3;
			$this->validate($request,[
					'supply_office' => 'required|string|max:500|unique:ori_mast_supply_offices,supply_office,'.request('id').',id,cmpny_id,'.Auth::user()->cmpny_id.',parent_id,'.request('parent_id'),
					],[
					'supply_office.required' => ' The supply_office field is required.',
					'supply_office.unique' => ' The supply_office already exists under this same parent.',
				]);
			$response           =   $request->all();
		   
			$catid = SupplyOffices::updateOrCreate(
            [
                
                'id' => request('id')
            ],
            [
				'cmpny_id' => Auth::user()->cmpny_id,
				'supply_office' => request('supply_office'),
                'parent_id' => request('parent_id'),
                'email' => request('email'),
                'status' => request('status'),
				'sort_order' => request('sort_order'),
            ])->id;
			
			if(!empty($catid))
			{
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
    * Query Type deletion function
    * @author PRANEESHA KP
    * @date 04/10/2018
    * @since version 1.0.0
    * @param NULL
    */
    /* public function destroy(Request $request)
    {
	   $faqid = $request->id;
	   if($faqid)
        {
            $id = FaqCategories::find($faqid);
			$id->delete();
        }
		$result_arr=array('success' => true,'message' => 'Successfuly deleted', 'refresh' => true);
		echo json_encode($result_arr);
    
    } */
	
	/*
    * Get Categories under selected query type
    * @author PRANEESHA KP
    * @date 05/10/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function get_cat_by_qtype(Request $request)
    {	$response           =   $request->all();
        $sel_query_type    =   $response['sel_query_type'];
		//var_dump($search_keywords);die;
        $results 	= array();
		
        $results = QueryCategoryRelation::select('ori_mast_faq_categories.id','ori_mast_faq_categories.category_name')
				 ->leftJoin('ori_mast_faq_categories', 'ori_mast_query_category_relation.category_id', '=', 'ori_mast_faq_categories.id')
				 ->whereIn('ori_mast_query_category_relation.query_type_id',$sel_query_type)
				 //->where('ori_mast_faq_categories.parent_category_id',config('constant.PARENT_CATEGORY'))
				 ->distinct('ori_mast_query_category_relation.category_id')
				 ->get();


				/* $array = DB::select("SELECT
    `cat`.`category_name` AS 'category_name',
    `cat2`.`category_name` AS 'parent_category'
FROM
    `ori_mast_faq_categories` AS `cat`
LEFT JOIN `ori_mast_faq_categories` AS `cat2` ON `cat`.`parent_category_id` = `cat2`.`id`
LEFT JOIN `ori_mast_query_category_relation` AS `q_cat_rel` ON `q_cat_rel`.`parent_category_id` = `cat2`.`id`
ORDER BY
    'parent_category'");
*/


		echo $results;
	}

	/*
    * GET TALUK SUPPLY OFFICE
     * @author ELAVARASI
    * @date 14-02-2019
    * @since version 1.0.0
    * @param NULL
    * @return TALUK SUPPLY OFFICE LIST */
	
    public function get_taluk_supply_office(Request $request){
		$district_supply_office = request('district_supply_office');			
		
		$results =  SupplyOffices::select('supply_office', 'id')               
				->where('parent_id',$district_supply_office)
				->orderBy('sort_order')
				->get();
		
		echo $results;
	}

}
