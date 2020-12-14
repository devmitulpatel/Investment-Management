<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePolicyForUserRequest;
use App\Http\Requests\UpdatePolicyForUserRequest;
use App\Http\Resources\Admin\PolicyForUserResource;
use App\Models\PolicyForUser;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PolicyForUserApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('policy_for_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PolicyForUserResource(PolicyForUser::with(['holders', 'nominees', 'created_by'])->get());
    }

    public function store(StorePolicyForUserRequest $request)
    {
        $policyForUser = PolicyForUser::create($request->all());
        $policyForUser->holders()->sync($request->input('holders', []));
        $policyForUser->nominees()->sync($request->input('nominees', []));

        return (new PolicyForUserResource($policyForUser))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PolicyForUser $policyForUser)
    {
        abort_if(Gate::denies('policy_for_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PolicyForUserResource($policyForUser->load(['holders', 'nominees', 'created_by']));
    }

    public function update(UpdatePolicyForUserRequest $request, PolicyForUser $policyForUser)
    {
        $policyForUser->update($request->all());
        $policyForUser->holders()->sync($request->input('holders', []));
        $policyForUser->nominees()->sync($request->input('nominees', []));

        return (new PolicyForUserResource($policyForUser))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PolicyForUser $policyForUser)
    {
        abort_if(Gate::denies('policy_for_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyForUser->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
