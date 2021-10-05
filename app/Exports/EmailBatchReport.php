<?php

namespace App\Exports;

use App\CommonSmsEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmailBatchReport implements FromCollection, ShouldQueue, WithHeadings, WithMapping
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

        $email_delivery_status_list	= config('constant.EMAIL_DELIVERY_STATUS_REV');

        $emails	= CommonSmsEmail::with('customer', 'contact', 'start_stage', 'end_stage')
      					->where('ori_common_sms_email.batch_id', $batch->id)
          				->where('ori_common_sms_email.sent_type', config('constant.CH_EMAIL'))
          				->get();

		$export_data	= array();
		foreach ($emails as $email)
		{
			$email_data	= array();
			$customer	= $email->customer ?? NULL;
			if (empty($customer) || !isset($customer->id) || empty($customer->id))
			{
				$customer = $email->contact ?? NULL;
			}
			if (empty($customer) || !isset($customer->id) || empty($customer->id))
			{
				continue;
			}

			$email_data['name']	= $customer->first_name;
			$email_data['name']	.= (isset($customer->middle_name) && !empty($customer->middle_name)) ? ' ' . $customer->middle_name : '';
			$email_data['name']	.= (isset($customer->last_name) && !empty($customer->last_name)) ? ' ' . $customer->last_name : '';
			$email_data['email'] = $email->email;
			$email_data['start_stage']	= $email->start_stage->process_name ?? '';
			$email_data['end_stage']	= $email->end_stage->process_name ?? '';
			$email_data['status']	= in_array($email->status, array_keys($email_delivery_status_list)) ? $email_delivery_status_list[$email->status] : '';
			$email_data['created_at']	= $email->created_at;

			$export_data[]	= $email_data;
		}

		$export_data	= collect($export_data);

        return $export_data;


    }

    public function headings() : array
    {
        return [
            'Customer Name',
            'Email',
            'Start Stage',
            'End Stage',
            'Status',
            'Created Date'
        ];
    }

    public function map($export_data): array {
        return [
            $export_data['name'],
            $export_data['email'],
            $export_data['start_stage'],
            $export_data['end_stage'],
            $export_data['status'],
            $export_data['created_at']
        ];
    }
}
