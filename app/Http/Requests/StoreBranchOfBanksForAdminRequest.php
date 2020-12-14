<?php

namespace App\Http\Requests;

use App\Models\BranchOfBanksForAdmin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBranchOfBanksForAdminRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('branch_of_banks_for_admin_create');
    }

    public function rules()
    {
        return [
            'bank_id'          => [
                'required',
                'integer',
            ],
            'ifsc_code'        => [
                'string',
                'nullable',
            ],
            'city'             => [
                'string',
                'nullable',
            ],
            'area'             => [
                'string',
                'nullable',
            ],
            'pincode'          => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'ref_contact_name' => [
                'string',
                'nullable',
            ],
            'ref_contact_no'   => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
