@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.fdForUser.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fd-for-users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.fdForUser.fields.id') }}
                        </th>
                        <td>
                            {{ $fdForUser->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdForUser.fields.bank') }}
                        </th>
                        <td>
                            {{ $fdForUser->bank->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdForUser.fields.branch') }}
                        </th>
                        <td>
                            {{ $fdForUser->branch->ifsc_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdForUser.fields.account_no') }}
                        </th>
                        <td>
                            {{ $fdForUser->account_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdForUser.fields.nominees') }}
                        </th>
                        <td>
                            @foreach($fdForUser->nominees as $key => $nominees)
                                <span class="label label-info">{{ $nominees->first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdForUser.fields.holder') }}
                        </th>
                        <td>
                            @foreach($fdForUser->holders as $key => $holder)
                                <span class="label label-info">{{ $holder->first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdForUser.fields.amount_paid') }}
                        </th>
                        <td>
                            {{ $fdForUser->amount_paid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdForUser.fields.interest_rate') }}
                        </th>
                        <td>
                            {{ $fdForUser->interest_rate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdForUser.fields.date_purchase') }}
                        </th>
                        <td>
                            {{ $fdForUser->date_purchase }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdForUser.fields.date_maturity') }}
                        </th>
                        <td>
                            {{ $fdForUser->date_maturity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdForUser.fields.amount_received') }}
                        </th>
                        <td>
                            {{ $fdForUser->amount_received }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fd-for-users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection