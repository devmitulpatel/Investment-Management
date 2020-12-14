<?php

namespace App\Http\Requests;

use App\Models\NomineesForAdmin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyNomineesForAdminRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('nominees_for_admin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:nominees_for_admins,id',
        ];
    }
}
