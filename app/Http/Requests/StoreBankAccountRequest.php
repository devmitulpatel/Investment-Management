<?php

namespace App\Http\Requests;

use App\Models\BankAccount;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBankAccountRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bank_account_create');
    }

    public function rules()
    {
        return [
            'branch_id'  => [
                'required',
                'integer',
            ],
            'holders.*'  => [
                'integer',
            ],
            'holders'    => [
                'required',
                'array',
            ],
            'nominees.*' => [
                'integer',
            ],
            'nominees'   => [
                'array',
            ],
        ];
    }
}
