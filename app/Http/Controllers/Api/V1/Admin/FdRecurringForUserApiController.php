<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFdRecurringForUserRequest;
use App\Http\Requests\UpdateFdRecurringForUserRequest;
use App\Http\Resources\Admin\FdRecurringForUserResource;
use App\Models\FdRecurringForUser;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FdRecurringForUserApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fd_recurring_for_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FdRecurringForUserResource(FdRecurringForUser::with(['bank', 'branch', 'holders', 'nominees', 'created_by'])->get());
    }

    public function store(StoreFdRecurringForUserRequest $request)
    {
        $fdRecurringForUser = FdRecurringForUser::create($request->all());
        $fdRecurringForUser->holders()->sync($request->input('holders', []));
        $fdRecurringForUser->nominees()->sync($request->input('nominees', []));

        return (new FdRecurringForUserResource($fdRecurringForUser))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FdRecurringForUser $fdRecurringForUser)
    {
        abort_if(Gate::denies('fd_recurring_for_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FdRecurringForUserResource($fdRecurringForUser->load(['bank', 'branch', 'holders', 'nominees', 'created_by']));
    }

    public function update(UpdateFdRecurringForUserRequest $request, FdRecurringForUser $fdRecurringForUser)
    {
        $fdRecurringForUser->update($request->all());
        $fdRecurringForUser->holders()->sync($request->input('holders', []));
        $fdRecurringForUser->nominees()->sync($request->input('nominees', []));

        return (new FdRecurringForUserResource($fdRecurringForUser))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FdRecurringForUser $fdRecurringForUser)
    {
        abort_if(Gate::denies('fd_recurring_for_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fdRecurringForUser->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
