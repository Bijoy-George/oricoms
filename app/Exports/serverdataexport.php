<?php

namespace App\Exports;

use DB;
use App\Asset;
use App\ServiceHistory;
use Auth;
use App\ServerService;
use App\Serverresource;
use App\Server;
use App\Helpers;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class serverdataexport implements FromView, ShouldQueue, ShouldAutoSize
{
  use Exportable;
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function view(): View
    {
     $search_criteria=$this->data;
        $cond_arr = array();
        $start_date = $search_criteria['startdate'];
        $stage = $search_criteria['stage'];
 
        $s_date ='';
        $e_date='';
        if(isset($start_date) && !empty($start_date) && $start_date != '00-00-0000')
        {
            $date_format_sdate  =   explode('/', $start_date);
            $sdate  =   $date_format_sdate[2].'-'.$date_format_sdate[1].'-'.$date_format_sdate[0];
            $s_date =$sdate;
        }
        $results1 = Server::with('getresource','getservice')->whereHas('getresource', function($query) use ($s_date) { $query->where('created_at', '>=', $s_date . ' 00:00:00')->where('created_at', '<=', $s_date . ' 23:59:59'); });

        if(isset($stage) && !empty($stage))
        {
            $results1 = Server::with('getresource','getservice')->whereHas('getresource', function($query) use ($s_date) { $query->where('created_at', '>=', $s_date . ' 00:00:00')->where('created_at', '<=', $s_date . ' 23:59:59'); })->where('stage',$stage);
        }
        $results1 = $results1->get();
      
       
        return view('server_management.server.assets', [
            'results1'       => $results1,
            'export_type'   => 'xlsx'
        ]);
    
    }
}
/*use App\Asset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AssetExportDataPdf implements FromView, ShouldQueue
{
  use Exportable;
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function view(): View
    { 
        $id    = $this->data['id'] ?? '';
    $results = Asset::select('company_id','asset_name','asset_model','vendor_contact_name','vendor_email','vendor_phone_number','manufacturer_name','manufactured_year')->where('id',$id);    
    $results = $results->first();
    return view('exports.assets', [
            'assets' => $results
        ]); 
    }
}*/
