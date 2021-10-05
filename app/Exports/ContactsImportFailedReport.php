<?php

namespace App\Exports;

use App\GroupExcelImportFailedRow;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\HeadingRowImport;

class ContactsImportFailedReport implements FromCollection, WithHeadings, ShouldQueue
{

	use Exportable;

    public $batch;

    public function __construct($batch)
    {
        $this->batch = $batch;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$file_name		= $this->batch->file_name;
    	$excel_headings = (new HeadingRowImport)->toArray('import/' . $file_name);
    	$excel_headings	= $excel_headings[0][0];
        $failed_rows	= GroupExcelImportFailedRow::where('batch_process_id', $this->batch->id)
        					->where('status', config('constant.ACTIVE'))
        					->get();

		$export_data	= array();
		foreach ($failed_rows as $row)
		{
			$failed_row_data	= array();
			$row_data 			= json_decode($row->row_data);
			foreach ($excel_headings as $heading)
			{
				$failed_row_data[$heading]	= $row_data->$heading ?? NULL;
			}
			$export_data[]	= $failed_row_data;
		}

		$export_data	= collect($export_data);

		return $export_data;
    }

    public function headings() : array
    {
    	$headings 		= array();
        $file_name		= $this->batch->file_name;
    	$excel_headings = (new HeadingRowImport)->toArray('import/' . $file_name);
    	$excel_headings	= $excel_headings[0][0];
    	foreach ($excel_headings as $heading)
    	{
    		$headings[]	= ucfirst(str_replace('_', ' ', $heading));
    	}

    	return $headings;
    }
}
