<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNscForUserRequest;
use App\Http\Requests\StoreNscForUserRequest;
use App\Http\Requests\UpdateNscForUserRequest;
use App\Models\HoldersForAdmin;
use App\Models\NomineesForAdmin;
use App\Models\NscForUser;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class NscForUserController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('nsc_for_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = NscForUser::with(['holders', 'nominees', 'created_by'])->select(sprintf('%s.*', (new NscForUser)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'nsc_for_user_show';
                $editGate      = 'nsc_for_user_edit';
                $deleteGate    = 'nsc_for_user_delete';
                $crudRoutePart = 'nsc-for-users';

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

            $table->editColumn('certificate_no', function ($row) {
                return $row->certificate_no ? $row->certificate_no : "";
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
            $table->editColumn('purchase_from', function ($row) {
                return $row->purchase_from ? $row->purchase_from : "";
            });
            $table->editColumn('ref_contact_name', function ($row) {
                return $row->ref_contact_name ? $row->ref_contact_name : "";
            });
            $table->editColumn('ref_contact_no', function ($row) {
                return $row->ref_contact_no ? $row->ref_contact_no : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? NscForUser::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'holder', 'nominees']);

            return $table->make(true);
        }

        return view('admin.nscForUsers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('nsc_for_user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $holders = HoldersForAdmin::all()->pluck('first_name', 'id');

        $nominees = NomineesForAdmin::all()->pluck('first_name', 'id');

        return view('admin.nscForUsers.create', compact('holders', 'nominees'));
    }

    public function store(StoreNscForUserRequest $request)
    {
        $nscForUser = NscForUser::create($request->all());
        $nscForUser->holders()->sync($request->input('holders', []));
        $nscForUser->nominees()->sync($request->input('nominees', []));

        return redirect()->route('admin.nsc-for-users.index');
    }

    public function edit(NscForUser $nscForUser)
    {
        abort_if(Gate::denies('nsc_for_user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $holders = HoldersForAdmin::all()->pluck('first_name', 'id');

        $nominees = NomineesForAdmin::all()->pluck('first_name', 'id');

        $nscForUser->load('holders', 'nominees', 'created_by');

        return view('admin.nscForUsers.edit', compact('holders', 'nominees', 'nscForUser'));
    }

    public function update(UpdateNscForUserRequest $request, NscForUser $nscForUser)
    {
        $nscForUser->update($request->all());
        $nscForUser->holders()->sync($request->input('holders', []));
        $nscForUser->nominees()->sync($request->input('nominees', []));

        return redirect()->route('admin.nsc-for-users.index');
    }

    public function show(NscForUser $nscForUser)
    {
        abort_if(Gate::denies('nsc_for_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nscForUser->load('holders', 'nominees', 'created_by');

        return view('admin.nscForUsers.show', compact('nscForUser'));
    }

    public function destroy(NscForUser $nscForUser)
    {
        abort_if(Gate::denies('nsc_for_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nscForUser->delete();

        return back();
    }

    public function massDestroy(MassDestroyNscForUserRequest $request)
    {
        NscForUser::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
