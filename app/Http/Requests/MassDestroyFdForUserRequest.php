<?php

namespace App\Http\Requests;

use App\Models\FdForUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFdForUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('fd_for_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:fd_for_users,id',
        ];
    }
}
