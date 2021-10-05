<?php

namespace App\Exports;

use App\CommonSmsEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SmsBatchReport implements FromCollection, ShouldQueue, WithHeadings, WithMapping
{

	use Exportable;
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $batch = [];
    	if (!isset($this->data['batch']) || empty($this->data['batch']))
    	{
    		return false;
    	}

    	$batch = $this->data['batch'];

        $sms_delivery_status_list	= config('constant.SMS_DELIVERY_STATUS_REV');

        $smses	= CommonSmsEmail::with('customer', 'contact', 'start_stage', 'end_stage')
      					->where('ori_common_sms_email.batch_id', $batch->id)
          				->where('ori_common_sms_email.sent_type', config('constant.CH_SMS'))
          				->get();

		$export_data	= array();
		foreach ($smses as $sms)
		{
			$sms_data	= array();
			$customer	= $sms->customer ?? NULL;
			if (empty($customer) || !isset($customer->id) || empty($customer->id))
			{
				$customer = $sms->contact ?? NULL;
			}
			if (empty($customer) || !isset($customer->id) || empty($customer->id))
			{
				continue;
			}

			$sms_data['name']	= $customer->first_name;
			$sms_data['name']	.= (isset($customer->middle_name) && !empty($customer->middle_name)) ? ' ' . $customer->middle_name : '';
			$sms_data['name']	.= (isset($customer->last_name) && !empty($customer->last_name)) ? ' ' . $customer->last_name : '';
			$sms_data['mobile'] = $sms->mobile;
			$sms_data['start_stage']	= $sms->start_stage->process_name ?? '';
			$sms_data['end_stage']	= $sms->end_stage->process_name ?? '';
			$sms_data['status']	= in_array($sms->status, array_keys($sms_delivery_status_list)) ? $sms_delivery_status_list[$sms->status] : '';
			$sms_data['created_at']	= $sms->created_at;

			$export_data[]	= $sms_data;
		}

		$export_data	= collect($export_data);

        return $export_data;
    }

    public function headings() : array
    {
        return [
            'Customer Name',
            'Mobile',
            'Start Stage',
            'End Stage',
            'Status',
            'Created Date'
        ];
    }

    public function map($export_data): array {
        return [
            $export_data['name'],
            $export_data['mobile'],
            $export_data['start_stage'],
            $export_data['end_stage'],
            $export_data['status'],
            $export_data['created_at']
        ];
    }
}
