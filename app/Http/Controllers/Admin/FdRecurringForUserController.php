<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFdRecurringForUserRequest;
use App\Http\Requests\StoreFdRecurringForUserRequest;
use App\Http\Requests\UpdateFdRecurringForUserRequest;
use App\Models\BankForAdmin;
use App\Models\BranchOfBanksForAdmin;
use App\Models\FdRecurringForUser;
use App\Models\HoldersForAdmin;
use App\Models\NomineesForAdmin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FdRecurringForUserController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('fd_recurring_for_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FdRecurringForUser::with(['bank', 'branch', 'holders', 'nominees', 'created_by'])->select(sprintf('%s.*', (new FdRecurringForUser)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'fd_recurring_for_user_show';
                $editGate      = 'fd_recurring_for_user_edit';
                $deleteGate    = 'fd_recurring_for_user_delete';
                $crudRoutePart = 'fd-recurring-for-users';

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
            $table->addColumn('bank_name', function ($row) {
                return $row->bank ? $row->bank->name : '';
            });

            $table->addColumn('branch_ifsc_code', function ($row) {
                return $row->branch ? $row->branch->ifsc_code : '';
            });

            $table->editColumn('branch.city', function ($row) {
                return $row->branch ? (is_string($row->branch) ? $row->branch : $row->branch->city) : '';
            });
            $table->editColumn('branch.area', function ($row) {
                return $row->branch ? (is_string($row->branch) ? $row->branch : $row->branch->area) : '';
            });
            $table->editColumn('branch.pincode', function ($row) {
                return $row->branch ? (is_string($row->branch) ? $row->branch : $row->branch->pincode) : '';
            });
            $table->editColumn('account_no', function ($row) {
                return $row->account_no ? $row->account_no : "";
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
            $table->editColumn('interest_rate', function ($row) {
                return $row->interest_rate ? $row->interest_rate : "";
            });

            $table->editColumn('amount_received', function ($row) {
                return $row->amount_received ? $row->amount_received : "";
            });
            $table->editColumn('recuring_amount', function ($row) {
                return $row->recuring_amount ? $row->recuring_amount : "";
            });
            $table->editColumn('no_recuring', function ($row) {
                return $row->no_recuring ? $row->no_recuring : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'bank', 'branch', 'holder', 'nominees']);

            return $table->make(true);
        }

        return view('admin.fdRecurringForUsers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('fd_recurring_for_user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banks = BankForAdmin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $branches = BranchOfBanksForAdmin::all()->pluck('ifsc_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $holders = HoldersForAdmin::all()->pluck('first_name', 'id');

        $nominees = NomineesForAdmin::all()->pluck('first_name', 'id');

        return view('admin.fdRecurringForUsers.create', compact('banks', 'branches', 'holders', 'nominees'));
    }

    public function store(StoreFdRecurringForUserRequest $request)
    {
        $fdRecurringForUser = FdRecurringForUser::create($request->all());
        $fdRecurringForUser->holders()->sync($request->input('holders', []));
        $fdRecurringForUser->nominees()->sync($request->input('nominees', []));

        return redirect()->route('admin.fd-recurring-for-users.index');
    }

    public function edit(FdRecurringForUser $fdRecurringForUser)
    {
        abort_if(Gate::denies('fd_recurring_for_user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banks = BankForAdmin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $branches = BranchOfBanksForAdmin::all()->pluck('ifsc_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $holders = HoldersForAdmin::all()->pluck('first_name', 'id');

        $nominees = NomineesForAdmin::all()->pluck('first_name', 'id');

        $fdRecurringForUser->load('bank', 'branch', 'holders', 'nominees', 'created_by');

        return view('admin.fdRecurringForUsers.edit', compact('banks', 'branches', 'holders', 'nominees', 'fdRecurringForUser'));
    }

    public function update(UpdateFdRecurringForUserRequest $request, FdRecurringForUser $fdRecurringForUser)
    {
        $fdRecurringForUser->update($request->all());
        $fdRecurringForUser->holders()->sync($request->input('holders', []));
        $fdRecurringForUser->nominees()->sync($request->input('nominees', []));

        return redirect()->route('admin.fd-recurring-for-users.index');
    }

    public function show(FdRecurringForUser $fdRecurringForUser)
    {
        abort_if(Gate::denies('fd_recurring_for_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fdRecurringForUser->load('bank', 'branch', 'holders', 'nominees', 'created_by');

        return view('admin.fdRecurringForUsers.show', compact('fdRecurringForUser'));
    }

    public function destroy(FdRecurringForUser $fdRecurringForUser)
    {
        abort_if(Gate::denies('fd_recurring_for_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fdRecurringForUser->delete();

        return back();
    }

    public function massDestroy(MassDestroyFdRecurringForUserRequest $request)
    {
        FdRecurringForUser::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
