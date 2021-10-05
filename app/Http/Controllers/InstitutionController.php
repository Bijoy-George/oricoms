<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\DistInstitutionRelation;
use App\Institution;
use App\QueryTypes;
use App\Helpers;
use Auth;
use DB;
use App\Http\Controllers\Controller;

class InstitutionController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
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
        return view('masters.institution.index');
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
        $results = Institution::orderBy('id', 'asc')->orderBy('sort_order','asc');
		
        if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('institution_name', 'like', '%' . $search_keywords . '%');
                   
                });
            }
		$list_count = $results->count();
        $results    = $results->paginate(config('constant.pagination_constant'));
		$html 		= view('masters.institution.listview')->with(compact('results','list_count'))
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
		return view('masters.institution.create');
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
		
		$res 		 	=Institution::findOrFail($id);
		$cat_res 		=Institution::where('id',$id)	
						->pluck('id', 'id')
						->all();
		
		$type_relation 	=DistInstitutionRelation::orderBy('id', 'asc')
						->where('institution_id',$id)	
						
						->all();
		
		//echo "<pre>"; var_dump($categories); //exit;

		/* $institutions = ['' => 'Select'] +DistInstitutionRelation::select('ori_mast_faq_categories.id','ori_mast_faq_categories.category_name')
				 ->leftJoin('ori_mast_faq_categories', 'ori_mast_query_category_relation.category_id', '=', 'ori_mast_faq_categories.id')
				 ->whereIn('ori_mast_query_category_relation.query_type_id',$type_relation)
				 ->whereNotIn('ori_mast_faq_categories.id',$cat_res)
				 ->distinct('ori_mast_query_category_relation.category_id')
				 ->pluck('ori_mast_faq_categories.category_name', 'ori_mast_faq_categories.id')
						->all(); */
        $institutions = array();
        $array = array();
		//$array = DB::select("SELECT `cat`.`category_name` AS 'category_name', `cat2`.`category_name` AS 'parent_category' FROM `ori_mast_faq_categories` AS `cat` LEFT JOIN `ori_mast_faq_categories` AS `cat2` ON `cat`.`parent_category_id` = `cat2`.`id` LEFT JOIN `ori_mast_query_category_relation` AS `q_cat_rel` ON `q_cat_rel`.`category_id` = `cat2`.`id` WHERE `q_cat_rel`.`query_type_id` IN ('6') ORDER BY 'parent_category'");

		//dd($res); exit;
		//echo "<pre>"; var_dump($categories); exit;
		return view('masters.faqCategories.create', compact('id','res','institutions','type_relation','array'));
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
					'institution_name' => 'required|string|max:500|unique:ori_mast_institution,institution_name,'.request('id').',id,cmpny_id,'.Auth::user()->cmpny_id.',parent_institution_id,'.request('parent_institution_id'),
					'district_id' => 'required',
					],[
					'institution_name.required' => ' The institution_name field is required.',
					'district_id.required' => ' The District field is required.',
				]);
			$response           =   $request->all();
			$district_id      =   $response['district_id'];
		   
			$catid = Institution::updateOrCreate(
            [
                
                'id' => request('id')
            ],
            [
				'cmpny_id' => Auth::user()->cmpny_id,
				'institution_name' => request('institution_name'),
				//'slug'          => strtolower(str_replace(" ", "_",request('institution_name'))),
				//'short_code'  	=> request('short_code'),
                'parent_institution_id' => request('parent_institution_id'),
                'status' => request('status'),
				'sort_order' => request('sort_order'),
				//'is_other' => request('is_other'),
            ])->id;
			
			 
			$rel     	= DistInstitutionRelation::where('cmpny_id',Auth::user()->cmpny_id)
						->where('institution_id',$catid)
						->forceDelete();
			
			   $statuss = DistInstitutionRelation::Create(
				[
					'cmpny_id' => Auth::user()->cmpny_id,
					'dist_id' => request('district_id'),
					'institution_id' => $catid,
					'status' => request('status'),
					'sort_order' => request('sort_order'),
				]);
			
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
}
