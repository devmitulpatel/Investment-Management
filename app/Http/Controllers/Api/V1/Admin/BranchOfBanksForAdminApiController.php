<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBranchOfBanksForAdminRequest;
use App\Http\Requests\UpdateBranchOfBanksForAdminRequest;
use App\Http\Resources\Admin\BranchOfBanksForAdminResource;
use App\Models\BranchOfBanksForAdmin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BranchOfBanksForAdminApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('branch_of_banks_for_admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BranchOfBanksForAdminResource(BranchOfBanksForAdmin::with(['bank', 'created_by'])->get());
    }

    public function store(StoreBranchOfBanksForAdminRequest $request)
    {
        $branchOfBanksForAdmin = BranchOfBanksForAdmin::create($request->all());

        return (new BranchOfBanksForAdminResource($branchOfBanksForAdmin))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BranchOfBanksForAdmin $branchOfBanksForAdmin)
    {
        abort_if(Gate::denies('branch_of_banks_for_admin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BranchOfBanksForAdminResource($branchOfBanksForAdmin->load(['bank', 'created_by']));
    }

    public function update(UpdateBranchOfBanksForAdminRequest $request, BranchOfBanksForAdmin $branchOfBanksForAdmin)
    {
        $branchOfBanksForAdmin->update($request->all());

        return (new BranchOfBanksForAdminResource($branchOfBanksForAdmin))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BranchOfBanksForAdmin $branchOfBanksForAdmin)
    {
        abort_if(Gate::denies('branch_of_banks_for_admin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $branchOfBanksForAdmin->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
