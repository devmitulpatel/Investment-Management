<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFdForUserRequest;
use App\Http\Requests\UpdateFdForUserRequest;
use App\Http\Resources\Admin\FdForUserResource;
use App\Models\FdForUser;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FdForUserApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fd_for_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FdForUserResource(FdForUser::with(['bank', 'branch', 'nominees', 'holders', 'created_by'])->get());
    }

    public function store(StoreFdForUserRequest $request)
    {
        $fdForUser = FdForUser::create($request->all());
        $fdForUser->nominees()->sync($request->input('nominees', []));
        $fdForUser->holders()->sync($request->input('holders', []));

        return (new FdForUserResource($fdForUser))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FdForUser $fdForUser)
    {
        abort_if(Gate::denies('fd_for_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FdForUserResource($fdForUser->load(['bank', 'branch', 'nominees', 'holders', 'created_by']));
    }

    public function update(UpdateFdForUserRequest $request, FdForUser $fdForUser)
    {
        $fdForUser->update($request->all());
        $fdForUser->nominees()->sync($request->input('nominees', []));
        $fdForUser->holders()->sync($request->input('holders', []));

        return (new FdForUserResource($fdForUser))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FdForUser $fdForUser)
    {
        abort_if(Gate::denies('fd_for_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fdForUser->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
