@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.insuranceForUser.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.insurance-for-users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.id') }}
                        </th>
                        <td>
                            {{ $insuranceForUser->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.issuer_name') }}
                        </th>
                        <td>
                            {{ $insuranceForUser->issuer_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.name') }}
                        </th>
                        <td>
                            {{ $insuranceForUser->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.policy_no') }}
                        </th>
                        <td>
                            {{ $insuranceForUser->policy_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.insured_amount') }}
                        </th>
                        <td>
                            {{ $insuranceForUser->insured_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.insurance_type') }}
                        </th>
                        <td>
                            {{ App\Models\InsuranceForUser::INSURANCE_TYPE_SELECT[$insuranceForUser->insurance_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.premium_amount') }}
                        </th>
                        <td>
                            {{ $insuranceForUser->premium_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.premium_interval') }}
                        </th>
                        <td>
                            {{ App\Models\InsuranceForUser::PREMIUM_INTERVAL_SELECT[$insuranceForUser->premium_interval] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.no_of_premium') }}
                        </th>
                        <td>
                            {{ $insuranceForUser->no_of_premium }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.holder') }}
                        </th>
                        <td>
                            @foreach($insuranceForUser->holders as $key => $holder)
                                <span class="label label-info">{{ $holder->first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.nominees') }}
                        </th>
                        <td>
                            @foreach($insuranceForUser->nominees as $key => $nominees)
                                <span class="label label-info">{{ $nominees->first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.date_of_purchase') }}
                        </th>
                        <td>
                            {{ $insuranceForUser->date_of_purchase }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.date_of_maturity') }}
                        </th>
                        <td>
                            {{ $insuranceForUser->date_of_maturity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.amount_paid') }}
                        </th>
                        <td>
                            {{ $insuranceForUser->amount_paid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.amount_received') }}
                        </th>
                        <td>
                            {{ $insuranceForUser->amount_received }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.insured_period') }}
                        </th>
                        <td>
                            {{ $insuranceForUser->insured_period }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.rate_intrest') }}
                        </th>
                        <td>
                            {{ $insuranceForUser->rate_intrest }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.ref_contact_no') }}
                        </th>
                        <td>
                            {{ $insuranceForUser->ref_contact_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.ref_contact_name') }}
                        </th>
                        <td>
                            {{ $insuranceForUser->ref_contact_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.note') }}
                        </th>
                        <td>
                            {{ $insuranceForUser->note }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceForUser.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\InsuranceForUser::STATUS_SELECT[$insuranceForUser->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.insurance-for-users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection