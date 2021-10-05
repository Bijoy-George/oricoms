<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Leadstatus;
use App\Helpers;
use Auth;
use DB;

class LeadStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('masters.LeadStatus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function search_list(Request $request)
    {   
        $response           = $request->all();
        $search_keywords    = $response['search_keywords'];
        $results            = array();  
        $results = Leadstatus::orderBy('id', 'asc');

        if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('customer', 'like', '%' . $search_keywords . '%');
                });
            }
        $list_count = $results->count();
        $results    =   $results->paginate(config('constant.pagination_constant'));
        $html = view('masters.LeadStatus.listview')->with(compact('results','list_count'))->render();
        $result_arr=array('success' => true,'html' => $html);
        return $result_arr;     
    }

    public function create()
    {
        return view('masters.LeadStatus.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
                'customer' => 'required|string|max:500|unique:leadstatuses,customer,'.request('id').',id,cmpny_id,'.Auth::user()->cmpny_id,
                ],[
                'customer.required' => ' The customer field is required.',
                ]);
        $status = Leadstatus::updateOrCreate(
            [
                'id'              => request('id')
            ],
            [
                'cmpny_id'        => Auth::user()->cmpny_id,
                'customer' => request('customer'),
                'sort_order'      => request('sort_order'),
                'status'          => request('status'),
            ]);
            
            if(!empty(request('id')))
            {
                $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
            }else{
                $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfuly added');
            }
            return $result_arr;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    public function edit($id)
    {
        $lead_status = Leadstatus::findOrFail($id);
        return view('masters.LeadStatus.create', compact('lead_status'));
    }

    /**
     * Update the specified resource in storage.
     *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
}
