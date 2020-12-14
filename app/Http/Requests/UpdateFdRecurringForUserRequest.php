<?php

namespace App\Http\Requests;

use App\Models\FdRecurringForUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFdRecurringForUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fd_recurring_for_user_edit');
    }

    public function rules()
    {
        return [
            'bank_id'         => [
                'required',
                'integer',
            ],
            'account_no'      => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'holders.*'       => [
                'integer',
            ],
            'holders'         => [
                'required',
                'array',
            ],
            'nominees.*'      => [
                'integer',
            ],
            'nominees'        => [
                'array',
            ],
            'interest_rate'   => [
                'numeric',
            ],
            'date_purchase'   => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'date_maturity'   => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'recuring_amount' => [
                'required',
            ],
            'no_recuring'     => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
