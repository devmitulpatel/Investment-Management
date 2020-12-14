<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBankForAdminRequest;
use App\Http\Requests\StoreBankForAdminRequest;
use App\Http\Requests\UpdateBankForAdminRequest;
use App\Models\BankForAdmin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BankForAdminController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('bank_for_admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BankForAdmin::with(['created_by'])->select(sprintf('%s.*', (new BankForAdmin)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'bank_for_admin_show';
                $editGate      = 'bank_for_admin_edit';
                $deleteGate    = 'bank_for_admin_delete';
                $crudRoutePart = 'bank-for-admins';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.bankForAdmins.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bank_for_admin_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankForAdmins.create');
    }

    public function store(StoreBankForAdminRequest $request)
    {
        $bankForAdmin = BankForAdmin::create($request->all());

        return redirect()->route('admin.bank-for-admins.index');
    }

    public function edit(BankForAdmin $bankForAdmin)
    {
        abort_if(Gate::denies('bank_for_admin_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankForAdmin->load('created_by');

        return view('admin.bankForAdmins.edit', compact('bankForAdmin'));
    }

    public function update(UpdateBankForAdminRequest $request, BankForAdmin $bankForAdmin)
    {
        $bankForAdmin->update($request->all());

        return redirect()->route('admin.bank-for-admins.index');
    }

    public function show(BankForAdmin $bankForAdmin)
    {
        abort_if(Gate::denies('bank_for_admin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankForAdmin->load('created_by');

        return view('admin.bankForAdmins.show', compact('bankForAdmin'));
    }

    public function destroy(BankForAdmin $bankForAdmin)
    {
        abort_if(Gate::denies('bank_for_admin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankForAdmin->delete();

        return back();
    }

    public function massDestroy(MassDestroyBankForAdminRequest $request)
    {
        BankForAdmin::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
