@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bankAccount.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bank-accounts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccount.fields.id') }}
                        </th>
                        <td>
                            {{ $bankAccount->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccount.fields.bank') }}
                        </th>
                        <td>
                            {{ $bankAccount->bank->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccount.fields.branch') }}
                        </th>
                        <td>
                            {{ $bankAccount->branch->city ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccount.fields.holder') }}
                        </th>
                        <td>
                            @foreach($bankAccount->holders as $key => $holder)
                                <span class="label label-info">{{ $holder->first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccount.fields.nominees') }}
                        </th>
                        <td>
                            @foreach($bankAccount->nominees as $key => $nominees)
                                <span class="label label-info">{{ $nominees->first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccount.fields.opening_balance') }}
                        </th>
                        <td>
                            {{ $bankAccount->opening_balance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccount.fields.note') }}
                        </th>
                        <td>
                            {{ $bankAccount->note }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bank-accounts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection