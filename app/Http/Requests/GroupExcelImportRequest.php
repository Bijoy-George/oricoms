<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupExcelImportRequest extends FormRequest
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
        return [
            'source_type'   => 'required',
            'lead_source'   => 'required',
            'file'          => 'required|file|mimes:xls,xlsx'
        ];
    }
}
