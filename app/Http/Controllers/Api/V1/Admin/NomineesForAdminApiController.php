<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNomineesForAdminRequest;
use App\Http\Requests\UpdateNomineesForAdminRequest;
use App\Http\Resources\Admin\NomineesForAdminResource;
use App\Models\NomineesForAdmin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NomineesForAdminApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('nominees_for_admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NomineesForAdminResource(NomineesForAdmin::with(['created_by'])->get());
    }

    public function store(StoreNomineesForAdminRequest $request)
    {
        $nomineesForAdmin = NomineesForAdmin::create($request->all());

        return (new NomineesForAdminResource($nomineesForAdmin))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(NomineesForAdmin $nomineesForAdmin)
    {
        abort_if(Gate::denies('nominees_for_admin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NomineesForAdminResource($nomineesForAdmin->load(['created_by']));
    }

    public function update(UpdateNomineesForAdminRequest $request, NomineesForAdmin $nomineesForAdmin)
    {
        $nomineesForAdmin->update($request->all());

        return (new NomineesForAdminResource($nomineesForAdmin))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(NomineesForAdmin $nomineesForAdmin)
    {
        abort_if(Gate::denies('nominees_for_admin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nomineesForAdmin->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
