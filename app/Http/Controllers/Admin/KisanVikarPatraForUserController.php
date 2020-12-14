<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyKisanVikarPatraForUserRequest;
use App\Http\Requests\StoreKisanVikarPatraForUserRequest;
use App\Http\Requests\UpdateKisanVikarPatraForUserRequest;
use App\Models\HoldersForAdmin;
use App\Models\KisanVikarPatraForUser;
use App\Models\NomineesForAdmin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class KisanVikarPatraForUserController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('kisan_vikar_patra_for_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = KisanVikarPatraForUser::with(['holders', 'nominees', 'created_by'])->select(sprintf('%s.*', (new KisanVikarPatraForUser)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'kisan_vikar_patra_for_user_show';
                $editGate      = 'kisan_vikar_patra_for_user_edit';
                $deleteGate    = 'kisan_vikar_patra_for_user_delete';
                $crudRoutePart = 'kisan-vikar-patra-for-users';

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
            $table->editColumn('amount_paid', function ($row) {
                return $row->amount_paid ? $row->amount_paid : "";
            });
            $table->editColumn('amount_received', function ($row) {
                return $row->amount_received ? $row->amount_received : "";
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
                return $row->status ? KisanVikarPatraForUser::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'holder', 'nominees']);

            return $table->make(true);
        }

        return view('admin.kisanVikarPatraForUsers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('kisan_vikar_patra_for_user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $holders = HoldersForAdmin::all()->pluck('first_name', 'id');

        $nominees = NomineesForAdmin::all()->pluck('first_name', 'id');

        return view('admin.kisanVikarPatraForUsers.create', compact('holders', 'nominees'));
    }

    public function store(StoreKisanVikarPatraForUserRequest $request)
    {
        $kisanVikarPatraForUser = KisanVikarPatraForUser::create($request->all());
        $kisanVikarPatraForUser->holders()->sync($request->input('holders', []));
        $kisanVikarPatraForUser->nominees()->sync($request->input('nominees', []));

        return redirect()->route('admin.kisan-vikar-patra-for-users.index');
    }

    public function edit(KisanVikarPatraForUser $kisanVikarPatraForUser)
    {
        abort_if(Gate::denies('kisan_vikar_patra_for_user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $holders = HoldersForAdmin::all()->pluck('first_name', 'id');

        $nominees = NomineesForAdmin::all()->pluck('first_name', 'id');

        $kisanVikarPatraForUser->load('holders', 'nominees', 'created_by');

        return view('admin.kisanVikarPatraForUsers.edit', compact('holders', 'nominees', 'kisanVikarPatraForUser'));
    }

    public function update(UpdateKisanVikarPatraForUserRequest $request, KisanVikarPatraForUser $kisanVikarPatraForUser)
    {
        $kisanVikarPatraForUser->update($request->all());
        $kisanVikarPatraForUser->holders()->sync($request->input('holders', []));
        $kisanVikarPatraForUser->nominees()->sync($request->input('nominees', []));

        return redirect()->route('admin.kisan-vikar-patra-for-users.index');
    }

    public function show(KisanVikarPatraForUser $kisanVikarPatraForUser)
    {
        abort_if(Gate::denies('kisan_vikar_patra_for_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kisanVikarPatraForUser->load('holders', 'nominees', 'created_by');

        return view('admin.kisanVikarPatraForUsers.show', compact('kisanVikarPatraForUser'));
    }

    public function destroy(KisanVikarPatraForUser $kisanVikarPatraForUser)
    {
        abort_if(Gate::denies('kisan_vikar_patra_for_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kisanVikarPatraForUser->delete();

        return back();
    }

    public function massDestroy(MassDestroyKisanVikarPatraForUserRequest $request)
    {
        KisanVikarPatraForUser::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
