<?php

namespace App\Http\Requests;

use App\Models\FdRecurringForUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFdRecurringForUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('fd_recurring_for_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:fd_recurring_for_users,id',
        ];
    }
}
