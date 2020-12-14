<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInsuranceForUserRequest;
use App\Http\Requests\StoreInsuranceForUserRequest;
use App\Http\Requests\UpdateInsuranceForUserRequest;
use App\Models\HoldersForAdmin;
use App\Models\InsuranceForUser;
use App\Models\NomineesForAdmin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InsuranceForUserController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('insurance_for_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = InsuranceForUser::with(['holders', 'nominees', 'created_by'])->select(sprintf('%s.*', (new InsuranceForUser)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'insurance_for_user_show';
                $editGate      = 'insurance_for_user_edit';
                $deleteGate    = 'insurance_for_user_delete';
                $crudRoutePart = 'insurance-for-users';

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
            $table->editColumn('insured_amount', function ($row) {
                return $row->insured_amount ? $row->insured_amount : "";
            });
            $table->editColumn('insurance_type', function ($row) {
                return $row->insurance_type ? InsuranceForUser::INSURANCE_TYPE_SELECT[$row->insurance_type] : '';
            });
            $table->editColumn('premium_amount', function ($row) {
                return $row->premium_amount ? $row->premium_amount : "";
            });
            $table->editColumn('premium_interval', function ($row) {
                return $row->premium_interval ? InsuranceForUser::PREMIUM_INTERVAL_SELECT[$row->premium_interval] : '';
            });
            $table->editColumn('no_of_premium', function ($row) {
                return $row->no_of_premium ? $row->no_of_premium : "";
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
            $table->editColumn('insured_period', function ($row) {
                return $row->insured_period ? $row->insured_period : "";
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
                return $row->status ? InsuranceForUser::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'holder', 'nominees']);

            return $table->make(true);
        }

        return view('admin.insuranceForUsers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('insurance_for_user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $holders = HoldersForAdmin::all()->pluck('first_name', 'id');

        $nominees = NomineesForAdmin::all()->pluck('first_name', 'id');

        return view('admin.insuranceForUsers.create', compact('holders', 'nominees'));
    }

    public function store(StoreInsuranceForUserRequest $request)
    {
        $insuranceForUser = InsuranceForUser::create($request->all());
        $insuranceForUser->holders()->sync($request->input('holders', []));
        $insuranceForUser->nominees()->sync($request->input('nominees', []));

        return redirect()->route('admin.insurance-for-users.index');
    }

    public function edit(InsuranceForUser $insuranceForUser)
    {
        abort_if(Gate::denies('insurance_for_user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $holders = HoldersForAdmin::all()->pluck('first_name', 'id');

        $nominees = NomineesForAdmin::all()->pluck('first_name', 'id');

        $insuranceForUser->load('holders', 'nominees', 'created_by');

        return view('admin.insuranceForUsers.edit', compact('holders', 'nominees', 'insuranceForUser'));
    }

    public function update(UpdateInsuranceForUserRequest $request, InsuranceForUser $insuranceForUser)
    {
        $insuranceForUser->update($request->all());
        $insuranceForUser->holders()->sync($request->input('holders', []));
        $insuranceForUser->nominees()->sync($request->input('nominees', []));

        return redirect()->route('admin.insurance-for-users.index');
    }

    public function show(InsuranceForUser $insuranceForUser)
    {
        abort_if(Gate::denies('insurance_for_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $insuranceForUser->load('holders', 'nominees', 'created_by');

        return view('admin.insuranceForUsers.show', compact('insuranceForUser'));
    }

    public function destroy(InsuranceForUser $insuranceForUser)
    {
        abort_if(Gate::denies('insurance_for_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $insuranceForUser->delete();

        return back();
    }

    public function massDestroy(MassDestroyInsuranceForUserRequest $request)
    {
        InsuranceForUser::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
