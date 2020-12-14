<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBankForAdminRequest;
use App\Http\Requests\UpdateBankForAdminRequest;
use App\Http\Resources\Admin\BankForAdminResource;
use App\Models\BankForAdmin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BankForAdminApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bank_for_admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankForAdminResource(BankForAdmin::with(['created_by'])->get());
    }

    public function store(StoreBankForAdminRequest $request)
    {
        $bankForAdmin = BankForAdmin::create($request->all());

        return (new BankForAdminResource($bankForAdmin))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BankForAdmin $bankForAdmin)
    {
        abort_if(Gate::denies('bank_for_admin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankForAdminResource($bankForAdmin->load(['created_by']));
    }

    public function update(UpdateBankForAdminRequest $request, BankForAdmin $bankForAdmin)
    {
        $bankForAdmin->update($request->all());

        return (new BankForAdminResource($bankForAdmin))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BankForAdmin $bankForAdmin)
    {
        abort_if(Gate::denies('bank_for_admin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankForAdmin->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
