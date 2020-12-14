<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBankAccountRequest;
use App\Http\Requests\StoreBankAccountRequest;
use App\Http\Requests\UpdateBankAccountRequest;
use App\Models\BankAccount;
use App\Models\BankForAdmin;
use App\Models\BranchOfBanksForAdmin;
use App\Models\HoldersForAdmin;
use App\Models\NomineesForAdmin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BankAccountsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('bank_account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BankAccount::with(['bank', 'branch', 'holders', 'nominees', 'created_by'])->select(sprintf('%s.*', (new BankAccount)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'bank_account_show';
                $editGate      = 'bank_account_edit';
                $deleteGate    = 'bank_account_delete';
                $crudRoutePart = 'bank-accounts';

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

            $table->addColumn('branch_city', function ($row) {
                return $row->branch ? $row->branch->city : '';
            });

            $table->editColumn('branch.ifsc_code', function ($row) {
                return $row->branch ? (is_string($row->branch) ? $row->branch : $row->branch->ifsc_code) : '';
            });
            $table->editColumn('branch.area', function ($row) {
                return $row->branch ? (is_string($row->branch) ? $row->branch : $row->branch->area) : '';
            });
            $table->editColumn('branch.pincode', function ($row) {
                return $row->branch ? (is_string($row->branch) ? $row->branch : $row->branch->pincode) : '';
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
            $table->editColumn('opening_balance', function ($row) {
                return $row->opening_balance ? $row->opening_balance : "";
            });
            $table->editColumn('note', function ($row) {
                return $row->note ? $row->note : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'bank', 'branch', 'holder', 'nominees']);

            return $table->make(true);
        }

        return view('admin.bankAccounts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bank_account_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banks = BankForAdmin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $branches = BranchOfBanksForAdmin::all()->pluck('city', 'id')->prepend(trans('global.pleaseSelect'), '');

        $holders = HoldersForAdmin::all()->pluck('first_name', 'id');

        $nominees = NomineesForAdmin::all()->pluck('first_name', 'id');

        return view('admin.bankAccounts.create', compact('banks', 'branches', 'holders', 'nominees'));
    }

    public function store(StoreBankAccountRequest $request)
    {
        $bankAccount = BankAccount::create($request->all());
        $bankAccount->holders()->sync($request->input('holders', []));
        $bankAccount->nominees()->sync($request->input('nominees', []));

        return redirect()->route('admin.bank-accounts.index');
    }

    public function edit(BankAccount $bankAccount)
    {
        abort_if(Gate::denies('bank_account_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banks = BankForAdmin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $branches = BranchOfBanksForAdmin::all()->pluck('city', 'id')->prepend(trans('global.pleaseSelect'), '');

        $holders = HoldersForAdmin::all()->pluck('first_name', 'id');

        $nominees = NomineesForAdmin::all()->pluck('first_name', 'id');

        $bankAccount->load('bank', 'branch', 'holders', 'nominees', 'created_by');

        return view('admin.bankAccounts.edit', compact('banks', 'branches', 'holders', 'nominees', 'bankAccount'));
    }

    public function update(UpdateBankAccountRequest $request, BankAccount $bankAccount)
    {
        $bankAccount->update($request->all());
        $bankAccount->holders()->sync($request->input('holders', []));
        $bankAccount->nominees()->sync($request->input('nominees', []));

        return redirect()->route('admin.bank-accounts.index');
    }

    public function show(BankAccount $bankAccount)
    {
        abort_if(Gate::denies('bank_account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankAccount->load('bank', 'branch', 'holders', 'nominees', 'created_by');

        return view('admin.bankAccounts.show', compact('bankAccount'));
    }

    public function destroy(BankAccount $bankAccount)
    {
        abort_if(Gate::denies('bank_account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankAccount->delete();

        return back();
    }

    public function massDestroy(MassDestroyBankAccountRequest $request)
    {
        BankAccount::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
