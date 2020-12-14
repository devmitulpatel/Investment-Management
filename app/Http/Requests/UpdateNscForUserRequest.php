<?php

namespace App\Http\Requests;

use App\Models\NscForUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateNscForUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('nsc_for_user_edit');
    }

    public function rules()
    {
        return [
            'date_purchase'    => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'date_maturity'    => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'certificate_no'   => [
                'string',
                'required',
            ],
            'holders.*'        => [
                'integer',
            ],
            'holders'          => [
                'required',
                'array',
            ],
            'nominees.*'       => [
                'integer',
            ],
            'nominees'         => [
                'array',
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
