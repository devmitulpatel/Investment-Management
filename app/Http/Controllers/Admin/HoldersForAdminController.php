<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyHoldersForAdminRequest;
use App\Http\Requests\StoreHoldersForAdminRequest;
use App\Http\Requests\UpdateHoldersForAdminRequest;
use App\Models\HoldersForAdmin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HoldersForAdminController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('holders_for_admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = HoldersForAdmin::with(['created_by'])->select(sprintf('%s.*', (new HoldersForAdmin)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'holders_for_admin_show';
                $editGate      = 'holders_for_admin_edit';
                $deleteGate    = 'holders_for_admin_delete';
                $crudRoutePart = 'holders-for-admins';

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
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : "";
            });
            $table->editColumn('middle_name', function ($row) {
                return $row->middle_name ? $row->middle_name : "";
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->editColumn('contact_no', function ($row) {
                return $row->contact_no ? $row->contact_no : "";
            });
            $table->editColumn('pan', function ($row) {
                return $row->pan ? $row->pan : "";
            });
            $table->editColumn('aadhar_no', function ($row) {
                return $row->aadhar_no ? $row->aadhar_no : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.holdersForAdmins.index');
    }

    public function create()
    {
        abort_if(Gate::denies('holders_for_admin_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.holdersForAdmins.create');
    }

    public function store(StoreHoldersForAdminRequest $request)
    {
        $holdersForAdmin = HoldersForAdmin::create($request->all());

        return redirect()->route('admin.holders-for-admins.index');
    }

    public function edit(HoldersForAdmin $holdersForAdmin)
    {
        abort_if(Gate::denies('holders_for_admin_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $holdersForAdmin->load('created_by');

        return view('admin.holdersForAdmins.edit', compact('holdersForAdmin'));
    }

    public function update(UpdateHoldersForAdminRequest $request, HoldersForAdmin $holdersForAdmin)
    {
        $holdersForAdmin->update($request->all());

        return redirect()->route('admin.holders-for-admins.index');
    }

    public function show(HoldersForAdmin $holdersForAdmin)
    {
        abort_if(Gate::denies('holders_for_admin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $holdersForAdmin->load('created_by');

        return view('admin.holdersForAdmins.show', compact('holdersForAdmin'));
    }

    public function destroy(HoldersForAdmin $holdersForAdmin)
    {
        abort_if(Gate::denies('holders_for_admin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $holdersForAdmin->delete();

        return back();
    }

    public function massDestroy(MassDestroyHoldersForAdminRequest $request)
    {
        HoldersForAdmin::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
