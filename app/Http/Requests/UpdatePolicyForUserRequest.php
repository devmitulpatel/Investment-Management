<?php

namespace App\Http\Requests;

use App\Models\PolicyForUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePolicyForUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('policy_for_user_edit');
    }

    public function rules()
    {
        return [
            'issuer_name'      => [
                'string',
                'required',
            ],
            'name'             => [
                'string',
                'required',
            ],
            'policy_no'        => [
                'string',
                'required',
            ],
            'no_of_premium'    => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'holders.*'        => [
                'integer',
            ],
            'holders'          => [
                'array',
            ],
            'nominees.*'       => [
                'integer',
            ],
            'nominees'         => [
                'array',
            ],
            'date_of_purchase' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'date_of_maturity' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'rate_intrest'     => [
                'numeric',
            ],
            'ref_contact_no'   => [
                'string',
                'nullable',
            ],
            'ref_contact_name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
