<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFdForUserRequest;
use App\Http\Requests\StoreFdForUserRequest;
use App\Http\Requests\UpdateFdForUserRequest;
use App\Models\BankForAdmin;
use App\Models\BranchOfBanksForAdmin;
use App\Models\FdForUser;
use App\Models\HoldersForAdmin;
use App\Models\NomineesForAdmin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FdForUserController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('fd_for_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FdForUser::with(['bank', 'branch', 'nominees', 'holders', 'created_by'])->select(sprintf('%s.*', (new FdForUser)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'fd_for_user_show';
                $editGate      = 'fd_for_user_edit';
                $deleteGate    = 'fd_for_user_delete';
                $crudRoutePart = 'fd-for-users';

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
            $table->editColumn('nominees', function ($row) {
                $labels = [];

                foreach ($row->nominees as $nominee) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $nominee->first_name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('holder', function ($row) {
                $labels = [];

                foreach ($row->holders as $holder) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $holder->first_name);
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

            $table->rawColumns(['actions', 'placeholder', 'bank', 'branch', 'nominees', 'holder']);

            return $table->make(true);
        }

        return view('admin.fdForUsers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('fd_for_user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banks = BankForAdmin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $branches = BranchOfBanksForAdmin::all()->pluck('ifsc_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nominees = NomineesForAdmin::all()->pluck('first_name', 'id');

        $holders = HoldersForAdmin::all()->pluck('first_name', 'id');

        return view('admin.fdForUsers.create', compact('banks', 'branches', 'nominees', 'holders'));
    }

    public function store(StoreFdForUserRequest $request)
    {
        $fdForUser = FdForUser::create($request->all());
        $fdForUser->nominees()->sync($request->input('nominees', []));
        $fdForUser->holders()->sync($request->input('holders', []));

        return redirect()->route('admin.fd-for-users.index');
    }

    public function edit(FdForUser $fdForUser)
    {
        abort_if(Gate::denies('fd_for_user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banks = BankForAdmin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $branches = BranchOfBanksForAdmin::all()->pluck('ifsc_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nominees = NomineesForAdmin::all()->pluck('first_name', 'id');

        $holders = HoldersForAdmin::all()->pluck('first_name', 'id');

        $fdForUser->load('bank', 'branch', 'nominees', 'holders', 'created_by');

        return view('admin.fdForUsers.edit', compact('banks', 'branches', 'nominees', 'holders', 'fdForUser'));
    }

    public function update(UpdateFdForUserRequest $request, FdForUser $fdForUser)
    {
        $fdForUser->update($request->all());
        $fdForUser->nominees()->sync($request->input('nominees', []));
        $fdForUser->holders()->sync($request->input('holders', []));

        return redirect()->route('admin.fd-for-users.index');
    }

    public function show(FdForUser $fdForUser)
    {
        abort_if(Gate::denies('fd_for_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fdForUser->load('bank', 'branch', 'nominees', 'holders', 'created_by');

        return view('admin.fdForUsers.show', compact('fdForUser'));
    }

    public function destroy(FdForUser $fdForUser)
    {
        abort_if(Gate::denies('fd_for_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fdForUser->delete();

        return back();
    }

    public function massDestroy(MassDestroyFdForUserRequest $request)
    {
        FdForUser::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
