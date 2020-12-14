<?php

namespace App\Http\Requests;

use App\Models\NomineesForAdmin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNomineesForAdminRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('nominees_for_admin_create');
    }

    public function rules()
    {
        return [
            'first_name'  => [
                'string',
                'required',
            ],
            'middle_name' => [
                'string',
                'required',
            ],
            'last_name'   => [
                'string',
                'required',
            ],
            'contact_no'  => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'pan'         => [
                'string',
                'nullable',
            ],
            'aadhar_no'   => [
                'string',
                'nullable',
            ],
        ];
    }
}
