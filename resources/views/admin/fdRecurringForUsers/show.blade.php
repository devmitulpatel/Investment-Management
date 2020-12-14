@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.fdRecurringForUser.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fd-recurring-for-users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.fdRecurringForUser.fields.id') }}
                        </th>
                        <td>
                            {{ $fdRecurringForUser->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdRecurringForUser.fields.bank') }}
                        </th>
                        <td>
                            {{ $fdRecurringForUser->bank->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdRecurringForUser.fields.branch') }}
                        </th>
                        <td>
                            {{ $fdRecurringForUser->branch->ifsc_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdRecurringForUser.fields.account_no') }}
                        </th>
                        <td>
                            {{ $fdRecurringForUser->account_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdRecurringForUser.fields.holder') }}
                        </th>
                        <td>
                            @foreach($fdRecurringForUser->holders as $key => $holder)
                                <span class="label label-info">{{ $holder->first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdRecurringForUser.fields.nominees') }}
                        </th>
                        <td>
                            @foreach($fdRecurringForUser->nominees as $key => $nominees)
                                <span class="label label-info">{{ $nominees->first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdRecurringForUser.fields.amount_paid') }}
                        </th>
                        <td>
                            {{ $fdRecurringForUser->amount_paid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdRecurringForUser.fields.interest_rate') }}
                        </th>
                        <td>
                            {{ $fdRecurringForUser->interest_rate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdRecurringForUser.fields.date_purchase') }}
                        </th>
                        <td>
                            {{ $fdRecurringForUser->date_purchase }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdRecurringForUser.fields.date_maturity') }}
                        </th>
                        <td>
                            {{ $fdRecurringForUser->date_maturity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdRecurringForUser.fields.amount_received') }}
                        </th>
                        <td>
                            {{ $fdRecurringForUser->amount_received }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdRecurringForUser.fields.recuring_amount') }}
                        </th>
                        <td>
                            {{ $fdRecurringForUser->recuring_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fdRecurringForUser.fields.no_recuring') }}
                        </th>
                        <td>
                            {{ $fdRecurringForUser->no_recuring }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fd-recurring-for-users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection