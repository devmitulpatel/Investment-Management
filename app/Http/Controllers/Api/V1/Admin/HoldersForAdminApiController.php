<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHoldersForAdminRequest;
use App\Http\Requests\UpdateHoldersForAdminRequest;
use App\Http\Resources\Admin\HoldersForAdminResource;
use App\Models\HoldersForAdmin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HoldersForAdminApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('holders_for_admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HoldersForAdminResource(HoldersForAdmin::with(['created_by'])->get());
    }

    public function store(StoreHoldersForAdminRequest $request)
    {
        $holdersForAdmin = HoldersForAdmin::create($request->all());

        return (new HoldersForAdminResource($holdersForAdmin))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(HoldersForAdmin $holdersForAdmin)
    {
        abort_if(Gate::denies('holders_for_admin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HoldersForAdminResource($holdersForAdmin->load(['created_by']));
    }

    public function update(UpdateHoldersForAdminRequest $request, HoldersForAdmin $holdersForAdmin)
    {
        $holdersForAdmin->update($request->all());

        return (new HoldersForAdminResource($holdersForAdmin))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(HoldersForAdmin $holdersForAdmin)
    {
        abort_if(Gate::denies('holders_for_admin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $holdersForAdmin->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
