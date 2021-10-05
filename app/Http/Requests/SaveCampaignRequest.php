<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCampaignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $company_id = auth()->user()->cmpny_id;
        $campaign_id = request('id');
        $campaign_id = $campaign_id ?? 'NULL';

        return [
            'name'   => 'required|unique:ori_campaigns,name,' . $campaign_id . ',id,cmpny_id,' . $company_id,
            'groups' => 'required',
            'type'   => 'required'
        ];
    }
}
