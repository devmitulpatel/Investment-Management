<?php

namespace App\Http\Requests;

use App\Models\BankForAdmin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBankForAdminRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bank_for_admin_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:bank_for_admins,name,' . request()->route('bank_for_admin')->id,
            ],
        ];
    }
}
