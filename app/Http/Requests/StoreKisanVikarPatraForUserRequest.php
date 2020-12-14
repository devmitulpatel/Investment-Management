<?php

namespace App\Http\Requests;

use App\Models\KisanVikarPatraForUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreKisanVikarPatraForUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kisan_vikar_patra_for_user_create');
    }

    public function rules()
    {
        return [
            'date_of_purchase' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'date_of_maturity' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'certificate_no'   => [
                'string',
                'required',
            ],
            'amount_paid'      => [
                'required',
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
