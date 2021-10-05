<?php

namespace App\Exports;

use App\CommonSmsEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PushBatchReport implements FromCollection, ShouldQueue, WithHeadings, WithMapping
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

    	$push_delivery_status_list	= config('constant.PUSH_DELIVERY_STATUS_REV');

    	$push_messages	= CommonSmsEmail::with('customer', 'contact', 'start_stage', 'end_stage')
      					->where('ori_common_sms_email.batch_id', $batch->id)
          				->where('ori_common_sms_email.sent_type', config('constant.CH_PUSH_MESSAGES'))
          				->get();

		$export_data	= array();
		foreach ($push_messages as $message)
		{
			$push_data	= array();
			$customer = $message->customer ?? NULL;
			if (empty($customer) || !isset($customer->id) || empty($customer->id))
			{
				$customer = $sms->contact ?? NULL;
			}
			if (empty($customer) || !isset($customer->id) || empty($customer->id))
			{
				continue;
			}

			$push_data['name']	= $customer->first_name;
			$push_data['name']	.= (isset($customer->middle_name) && !empty($customer->middle_name)) ? ' ' . $customer->middle_name : '';
			$push_data['name']	.= (isset($customer->last_name) && !empty($customer->last_name)) ? ' ' . $customer->last_name : '';
			$push_data['mobile']	= $customer->mobile;
			$push_data['start_stage']	= $message->start_stage->process_name ?? '';
			$push_data['end_stage']		= $message->end_stage->process_name ?? '';
			$push_data['status']	= in_array($message->status, array_keys($push_delivery_status_list)) ? $push_delivery_status_list[$message->status] : '';
			$push_data['created_at']	= $message->created_at;

			$export_data[]	= $push_data;
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
