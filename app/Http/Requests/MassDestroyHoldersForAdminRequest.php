<?php

namespace App\Http\Requests;

use App\Models\HoldersForAdmin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHoldersForAdminRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('holders_for_admin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:holders_for_admins,id',
        ];
    }
}
