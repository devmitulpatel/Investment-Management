<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNscForUserRequest;
use App\Http\Requests\UpdateNscForUserRequest;
use App\Http\Resources\Admin\NscForUserResource;
use App\Models\NscForUser;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NscForUserApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('nsc_for_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NscForUserResource(NscForUser::with(['holders', 'nominees', 'created_by'])->get());
    }

    public function store(StoreNscForUserRequest $request)
    {
        $nscForUser = NscForUser::create($request->all());
        $nscForUser->holders()->sync($request->input('holders', []));
        $nscForUser->nominees()->sync($request->input('nominees', []));

        return (new NscForUserResource($nscForUser))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(NscForUser $nscForUser)
    {
        abort_if(Gate::denies('nsc_for_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NscForUserResource($nscForUser->load(['holders', 'nominees', 'created_by']));
    }

    public function update(UpdateNscForUserRequest $request, NscForUser $nscForUser)
    {
        $nscForUser->update($request->all());
        $nscForUser->holders()->sync($request->input('holders', []));
        $nscForUser->nominees()->sync($request->input('nominees', []));

        return (new NscForUserResource($nscForUser))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(NscForUser $nscForUser)
    {
        abort_if(Gate::denies('nsc_for_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nscForUser->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
