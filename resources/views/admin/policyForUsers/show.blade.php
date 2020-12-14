@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.policyForUser.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.policy-for-users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.policyForUser.fields.id') }}
                        </th>
                        <td>
                            {{ $policyForUser->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyForUser.fields.issuer_name') }}
                        </th>
                        <td>
                            {{ $policyForUser->issuer_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyForUser.fields.name') }}
                        </th>
                        <td>
                            {{ $policyForUser->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyForUser.fields.policy_no') }}
                        </th>
                        <td>
                            {{ $policyForUser->policy_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyForUser.fields.premium_amount') }}
                        </th>
                        <td>
                            {{ $policyForUser->premium_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyForUser.fields.no_of_premium') }}
                        </th>
                        <td>
                            {{ $policyForUser->no_of_premium }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyForUser.fields.premium_interval') }}
                        </th>
                        <td>
                            {{ App\Models\PolicyForUser::PREMIUM_INTERVAL_SELECT[$policyForUser->premium_interval] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyForUser.fields.holder') }}
                        </th>
                        <td>
                            @foreach($policyForUser->holders as $key => $holder)
                                <span class="label label-info">{{ $holder->first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyForUser.fields.nominees') }}
                        </th>
                        <td>
                            @foreach($policyForUser->nominees as $key => $nominees)
                                <span class="label label-info">{{ $nominees->first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyForUser.fields.date_of_purchase') }}
                        </th>
                        <td>
                            {{ $policyForUser->date_of_purchase }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyForUser.fields.date_of_maturity') }}
                        </th>
                        <td>
                            {{ $policyForUser->date_of_maturity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyForUser.fields.amount_paid') }}
                        </th>
                        <td>
                            {{ $policyForUser->amount_paid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyForUser.fields.amount_received') }}
                        </th>
                        <td>
                            {{ $policyForUser->amount_received }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyForUser.fields.rate_intrest') }}
                        </th>
                        <td>
                            {{ $policyForUser->rate_intrest }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyForUser.fields.ref_contact_no') }}
                        </th>
                        <td>
                            {{ $policyForUser->ref_contact_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyForUser.fields.ref_contact_name') }}
                        </th>
                        <td>
                            {{ $policyForUser->ref_contact_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyForUser.fields.note') }}
                        </th>
                        <td>
                            {{ $policyForUser->note }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyForUser.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\PolicyForUser::STATUS_SELECT[$policyForUser->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.policy-for-users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection