<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKisanVikarPatraForUserRequest;
use App\Http\Requests\UpdateKisanVikarPatraForUserRequest;
use App\Http\Resources\Admin\KisanVikarPatraForUserResource;
use App\Models\KisanVikarPatraForUser;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KisanVikarPatraForUserApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kisan_vikar_patra_for_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KisanVikarPatraForUserResource(KisanVikarPatraForUser::with(['holders', 'nominees', 'created_by'])->get());
    }

    public function store(StoreKisanVikarPatraForUserRequest $request)
    {
        $kisanVikarPatraForUser = KisanVikarPatraForUser::create($request->all());
        $kisanVikarPatraForUser->holders()->sync($request->input('holders', []));
        $kisanVikarPatraForUser->nominees()->sync($request->input('nominees', []));

        return (new KisanVikarPatraForUserResource($kisanVikarPatraForUser))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(KisanVikarPatraForUser $kisanVikarPatraForUser)
    {
        abort_if(Gate::denies('kisan_vikar_patra_for_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KisanVikarPatraForUserResource($kisanVikarPatraForUser->load(['holders', 'nominees', 'created_by']));
    }

    public function update(UpdateKisanVikarPatraForUserRequest $request, KisanVikarPatraForUser $kisanVikarPatraForUser)
    {
        $kisanVikarPatraForUser->update($request->all());
        $kisanVikarPatraForUser->holders()->sync($request->input('holders', []));
        $kisanVikarPatraForUser->nominees()->sync($request->input('nominees', []));

        return (new KisanVikarPatraForUserResource($kisanVikarPatraForUser))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(KisanVikarPatraForUser $kisanVikarPatraForUser)
    {
        abort_if(Gate::denies('kisan_vikar_patra_for_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kisanVikarPatraForUser->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
