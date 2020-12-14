<?php

namespace App\Http\Requests;

use App\Models\InsuranceForUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyInsuranceForUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('insurance_for_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:insurance_for_users,id',
        ];
    }
}
