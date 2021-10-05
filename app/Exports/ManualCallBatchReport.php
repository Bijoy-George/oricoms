<?php

namespace App\Exports;

use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\CommonSmsEmail;

class ManualCallBatchReport implements FromCollection, ShouldQueue, WithHeadings, WithMapping
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

    	$calls	= CommonSmsEmail::with('customer', 'contact', 'start_stage', 'end_stage', 'followup.GetQueryType', 'followup.GetQueryCategory', 'followup.GetSubQueryCategory', 'followup.GetCustomerNature', 'followup.GetPriority', 'followup.GetQueryStatus', 'followup.GetEscalateUser')
      					->where('ori_common_sms_email.batch_id', $batch->id)
          				->where('ori_common_sms_email.sent_type', config('constant.CH_MANUAL_CALL'))
          				->get();

		$export_data	= array();
		foreach ($calls as $call)
		{
			$call_data	= array();
			$customer	= $call->customer ?? NULL;
			if (empty($customer) || !isset($customer->id) || empty($customer->id))
			{
				$customer = $call->contact ?? NULL;
			}
			if (empty($customer) || !isset($customer->id) || empty($customer->id))
			{
				continue;
			}

			$call_data['name']	= $customer->first_name;
			$call_data['name']	.= (isset($customer->middle_name) && !empty($customer->middle_name)) ? ' ' . $customer->middle_name : '';
			$call_data['name']	.= (isset($customer->last_name) && !empty($customer->last_name)) ? ' ' . $customer->last_name : '';
			$call_data['mobile'] 		= $call->mobile;
			$call_data['query_type']	= $call->followup->GetQueryType->query_type ?? '';
			$call_data['escalated_user']	= $call->followup->GetEscalateUser->name ?? '';
			$call_data['category']			= $call->followup->GetQueryCategory->category_name ?? '';
			$call_data['sub_category']			= $call->followup->GetSubQueryCategory->category_name ?? '';
			$call_data['customer_nature']			= $call->followup->GetCustomerNature->customer_nature ?? '';
			$call_data['priority']			= $call->followup->GetPriority->name ?? '';
			$call_data['query_status']		= $call->followup->GetQueryStatus->name ?? '';
			$call_data['request_title']		= $call->followup->req_title ?? '';
			$call_data['question']			= $call->followup->question ?? '';
			$call_data['answer']			= $call->followup->answer ?? '';
			$call_data['start_stage']		= $call->start_stage->process_name ?? '';
			$call_data['end_stage']			= $call->end_stage->process_name ?? '';

			$export_data[]	= $call_data;
		}

		$export_data	= collect($export_data);

        return $export_data;
    }

    public function headings() : array
    {
        return [
            'Customer Name',
            'Mobile',
            'Query Type',
            'Escalated User',
            'Category',
            'Sub Category',
            'Customer Nature',
            'Priority',
            'Query Status',
            'Request Title',
            'Question',
            'Answer',
            'Start Stage',
            'End Stage'
        ];
    }

    public function map($export_data): array {
        return [
            $export_data['name'],
            $export_data['mobile'],
            $export_data['query_type'],
            $export_data['escalated_user'],
            $export_data['category'],
            $export_data['sub_category'],
            $export_data['customer_nature'],
            $export_data['priority'],
            $export_data['query_status'],
            $export_data['request_title'],
            $export_data['question'],
            $export_data['answer'],
            $export_data['start_stage'],
            $export_data['end_stage']
        ];
    }
}
