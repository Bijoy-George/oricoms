<?php

namespace App\Http\Requests;

use App\Group;
use Illuminate\Foundation\Http\FormRequest;

class SaveGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $company_id = auth()->user()->cmpny_id;
        $group_id = request()->post('id');
        $group  = Group::find($group_id);
        if ($group_id && (!isset($group->id) || empty($group->id)))
        {
            return false;
        }
        if (!empty($group->id) && ($company_id != $group->cmpny_id))
        {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $group_id = request()->post('id') ?? 'NULL';
        $company_id = auth()->user()->cmpny_id;
        return [
            'name' => 'required|unique:ori_groups,name,'.$group_id.',id,cmpny_id,' . $company_id
        ];
    }
}
