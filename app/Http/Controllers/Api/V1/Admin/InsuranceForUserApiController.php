<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInsuranceForUserRequest;
use App\Http\Requests\UpdateInsuranceForUserRequest;
use App\Http\Resources\Admin\InsuranceForUserResource;
use App\Models\InsuranceForUser;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InsuranceForUserApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('insurance_for_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InsuranceForUserResource(InsuranceForUser::with(['holders', 'nominees', 'created_by'])->get());
    }

    public function store(StoreInsuranceForUserRequest $request)
    {
        $insuranceForUser = InsuranceForUser::create($request->all());
        $insuranceForUser->holders()->sync($request->input('holders', []));
        $insuranceForUser->nominees()->sync($request->input('nominees', []));

        return (new InsuranceForUserResource($insuranceForUser))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(InsuranceForUser $insuranceForUser)
    {
        abort_if(Gate::denies('insurance_for_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InsuranceForUserResource($insuranceForUser->load(['holders', 'nominees', 'created_by']));
    }

    public function update(UpdateInsuranceForUserRequest $request, InsuranceForUser $insuranceForUser)
    {
        $insuranceForUser->update($request->all());
        $insuranceForUser->holders()->sync($request->input('holders', []));
        $insuranceForUser->nominees()->sync($request->input('nominees', []));

        return (new InsuranceForUserResource($insuranceForUser))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(InsuranceForUser $insuranceForUser)
    {
        abort_if(Gate::denies('insurance_for_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $insuranceForUser->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
