<?php

namespace App\Http\Requests;

use App\Models\KisanVikarPatraForUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyKisanVikarPatraForUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('kisan_vikar_patra_for_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:kisan_vikar_patra_for_users,id',
        ];
    }
}
