<?php

namespace App\Http\Requests;

use App\Models\FdForUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFdForUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fd_for_user_edit');
    }

    public function rules()
    {
        return [
            'bank_id'       => [
                'required',
                'integer',
            ],
            'account_no'    => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'nominees.*'    => [
                'integer',
            ],
            'nominees'      => [
                'array',
            ],
            'holders.*'     => [
                'integer',
            ],
            'holders'       => [
                'required',
                'array',
            ],
            'interest_rate' => [
                'numeric',
            ],
            'date_purchase' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'date_maturity' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
