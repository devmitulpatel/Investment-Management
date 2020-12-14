<?php

namespace App\Http\Requests;

use App\Models\PolicyForUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPolicyForUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('policy_for_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:policy_for_users,id',
        ];
    }
}
