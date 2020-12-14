<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBranchOfBanksForAdminRequest;
use App\Http\Requests\StoreBranchOfBanksForAdminRequest;
use App\Http\Requests\UpdateBranchOfBanksForAdminRequest;
use App\Models\BankForAdmin;
use App\Models\BranchOfBanksForAdmin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BranchOfBanksForAdminController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('branch_of_banks_for_admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BranchOfBanksForAdmin::with(['bank', 'created_by'])->select(sprintf('%s.*', (new BranchOfBanksForAdmin)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'branch_of_banks_for_admin_show';
                $editGate      = 'branch_of_banks_for_admin_edit';
                $deleteGate    = 'branch_of_banks_for_admin_delete';
                $crudRoutePart = 'branch-of-banks-for-admins';

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

            $table->editColumn('ifsc_code', function ($row) {
                return $row->ifsc_code ? $row->ifsc_code : "";
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : "";
            });
            $table->editColumn('area', function ($row) {
                return $row->area ? $row->area : "";
            });
            $table->editColumn('pincode', function ($row) {
                return $row->pincode ? $row->pincode : "";
            });
            $table->editColumn('ref_contact_name', function ($row) {
                return $row->ref_contact_name ? $row->ref_contact_name : "";
            });
            $table->editColumn('ref_contact_no', function ($row) {
                return $row->ref_contact_no ? $row->ref_contact_no : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'bank']);

            return $table->make(true);
        }

        return view('admin.branchOfBanksForAdmins.index');
    }

    public function create()
    {
        abort_if(Gate::denies('branch_of_banks_for_admin_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banks = BankForAdmin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.branchOfBanksForAdmins.create', compact('banks'));
    }

    public function store(StoreBranchOfBanksForAdminRequest $request)
    {
        $branchOfBanksForAdmin = BranchOfBanksForAdmin::create($request->all());

        return redirect()->route('admin.branch-of-banks-for-admins.index');
    }

    public function edit(BranchOfBanksForAdmin $branchOfBanksForAdmin)
    {
        abort_if(Gate::denies('branch_of_banks_for_admin_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banks = BankForAdmin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $branchOfBanksForAdmin->load('bank', 'created_by');

        return view('admin.branchOfBanksForAdmins.edit', compact('banks', 'branchOfBanksForAdmin'));
    }

    public function update(UpdateBranchOfBanksForAdminRequest $request, BranchOfBanksForAdmin $branchOfBanksForAdmin)
    {
        $branchOfBanksForAdmin->update($request->all());

        return redirect()->route('admin.branch-of-banks-for-admins.index');
    }

    public function show(BranchOfBanksForAdmin $branchOfBanksForAdmin)
    {
        abort_if(Gate::denies('branch_of_banks_for_admin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $branchOfBanksForAdmin->load('bank', 'created_by');

        return view('admin.branchOfBanksForAdmins.show', compact('branchOfBanksForAdmin'));
    }

    public function destroy(BranchOfBanksForAdmin $branchOfBanksForAdmin)
    {
        abort_if(Gate::denies('branch_of_banks_for_admin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $branchOfBanksForAdmin->delete();

        return back();
    }

    public function massDestroy(MassDestroyBranchOfBanksForAdminRequest $request)
    {
        BranchOfBanksForAdmin::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
