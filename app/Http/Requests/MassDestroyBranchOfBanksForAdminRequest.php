<?php

namespace App\Http\Requests;

use App\Models\BranchOfBanksForAdmin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBranchOfBanksForAdminRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('branch_of_banks_for_admin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:branch_of_banks_for_admins,id',
        ];
    }
}
