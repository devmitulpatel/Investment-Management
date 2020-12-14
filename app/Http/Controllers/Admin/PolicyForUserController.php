<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPolicyForUserRequest;
use App\Http\Requests\StorePolicyForUserRequest;
use App\Http\Requests\UpdatePolicyForUserRequest;
use App\Models\HoldersForAdmin;
use App\Models\NomineesForAdmin;
use App\Models\PolicyForUser;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PolicyForUserController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('policy_for_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PolicyForUser::with(['holders', 'nominees', 'created_by'])->select(sprintf('%s.*', (new PolicyForUser)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'policy_for_user_show';
                $editGate      = 'policy_for_user_edit';
                $deleteGate    = 'policy_for_user_delete';
                $crudRoutePart = 'policy-for-users';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('issuer_name', function ($row) {
                return $row->issuer_name ? $row->issuer_name : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('policy_no', function ($row) {
                return $row->policy_no ? $row->policy_no : "";
            });
            $table->editColumn('premium_amount', function ($row) {
                return $row->premium_amount ? $row->premium_amount : "";
            });
            $table->editColumn('no_of_premium', function ($row) {
                return $row->no_of_premium ? $row->no_of_premium : "";
            });
            $table->editColumn('premium_interval', function ($row) {
                return $row->premium_interval ? PolicyForUser::PREMIUM_INTERVAL_SELECT[$row->premium_interval] : '';
            });
            $table->editColumn('holder', function ($row) {
                $labels = [];

                foreach ($row->holders as $holder) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $holder->first_name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('nominees', function ($row) {
                $labels = [];

                foreach ($row->nominees as $nominee) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $nominee->first_name);
                }

                return implode(' ', $labels);
            });

            $table->editColumn('amount_paid', function ($row) {
                return $row->amount_paid ? $row->amount_paid : "";
            });
            $table->editColumn('amount_received', function ($row) {
                return $row->amount_received ? $row->amount_received : "";
            });
            $table->editColumn('rate_intrest', function ($row) {
                return $row->rate_intrest ? $row->rate_intrest : "";
            });
            $table->editColumn('ref_contact_no', function ($row) {
                return $row->ref_contact_no ? $row->ref_contact_no : "";
            });
            $table->editColumn('ref_contact_name', function ($row) {
                return $row->ref_contact_name ? $row->ref_contact_name : "";
            });
            $table->editColumn('note', function ($row) {
                return $row->note ? $row->note : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? PolicyForUser::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'holder', 'nominees']);

            return $table->make(true);
        }

        return view('admin.policyForUsers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('policy_for_user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $holders = HoldersForAdmin::all()->pluck('first_name', 'id');

        $nominees = NomineesForAdmin::all()->pluck('first_name', 'id');

        return view('admin.policyForUsers.create', compact('holders', 'nominees'));
    }

    public function store(StorePolicyForUserRequest $request)
    {
        $policyForUser = PolicyForUser::create($request->all());
        $policyForUser->holders()->sync($request->input('holders', []));
        $policyForUser->nominees()->sync($request->input('nominees', []));

        return redirect()->route('admin.policy-for-users.index');
    }

    public function edit(PolicyForUser $policyForUser)
    {
        abort_if(Gate::denies('policy_for_user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $holders = HoldersForAdmin::all()->pluck('first_name', 'id');

        $nominees = NomineesForAdmin::all()->pluck('first_name', 'id');

        $policyForUser->load('holders', 'nominees', 'created_by');

        return view('admin.policyForUsers.edit', compact('holders', 'nominees', 'policyForUser'));
    }

    public function update(UpdatePolicyForUserRequest $request, PolicyForUser $policyForUser)
    {
        $policyForUser->update($request->all());
        $policyForUser->holders()->sync($request->input('holders', []));
        $policyForUser->nominees()->sync($request->input('nominees', []));

        return redirect()->route('admin.policy-for-users.index');
    }

    public function show(PolicyForUser $policyForUser)
    {
        abort_if(Gate::denies('policy_for_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyForUser->load('holders', 'nominees', 'created_by');

        return view('admin.policyForUsers.show', compact('policyForUser'));
    }

    public function destroy(PolicyForUser $policyForUser)
    {
        abort_if(Gate::denies('policy_for_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyForUser->delete();

        return back();
    }

    public function massDestroy(MassDestroyPolicyForUserRequest $request)
    {
        PolicyForUser::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
