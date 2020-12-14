<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNomineesForAdminRequest;
use App\Http\Requests\StoreNomineesForAdminRequest;
use App\Http\Requests\UpdateNomineesForAdminRequest;
use App\Models\NomineesForAdmin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class NomineesForAdminController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('nominees_for_admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = NomineesForAdmin::with(['created_by'])->select(sprintf('%s.*', (new NomineesForAdmin)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'nominees_for_admin_show';
                $editGate      = 'nominees_for_admin_edit';
                $deleteGate    = 'nominees_for_admin_delete';
                $crudRoutePart = 'nominees-for-admins';

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

        return view('admin.nomineesForAdmins.index');
    }

    public function create()
    {
        abort_if(Gate::denies('nominees_for_admin_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.nomineesForAdmins.create');
    }

    public function store(StoreNomineesForAdminRequest $request)
    {
        $nomineesForAdmin = NomineesForAdmin::create($request->all());

        return redirect()->route('admin.nominees-for-admins.index');
    }

    public function edit(NomineesForAdmin $nomineesForAdmin)
    {
        abort_if(Gate::denies('nominees_for_admin_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nomineesForAdmin->load('created_by');

        return view('admin.nomineesForAdmins.edit', compact('nomineesForAdmin'));
    }

    public function update(UpdateNomineesForAdminRequest $request, NomineesForAdmin $nomineesForAdmin)
    {
        $nomineesForAdmin->update($request->all());

        return redirect()->route('admin.nominees-for-admins.index');
    }

    public function show(NomineesForAdmin $nomineesForAdmin)
    {
        abort_if(Gate::denies('nominees_for_admin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nomineesForAdmin->load('created_by');

        return view('admin.nomineesForAdmins.show', compact('nomineesForAdmin'));
    }

    public function destroy(NomineesForAdmin $nomineesForAdmin)
    {
        abort_if(Gate::denies('nominees_for_admin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nomineesForAdmin->delete();

        return back();
    }

    public function massDestroy(MassDestroyNomineesForAdminRequest $request)
    {
        NomineesForAdmin::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
