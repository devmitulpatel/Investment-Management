@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.nscForUser.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.nsc-for-users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.nscForUser.fields.id') }}
                        </th>
                        <td>
                            {{ $nscForUser->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nscForUser.fields.date_purchase') }}
                        </th>
                        <td>
                            {{ $nscForUser->date_purchase }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nscForUser.fields.date_maturity') }}
                        </th>
                        <td>
                            {{ $nscForUser->date_maturity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nscForUser.fields.certificate_no') }}
                        </th>
                        <td>
                            {{ $nscForUser->certificate_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nscForUser.fields.holder') }}
                        </th>
                        <td>
                            @foreach($nscForUser->holders as $key => $holder)
                                <span class="label label-info">{{ $holder->first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nscForUser.fields.nominees') }}
                        </th>
                        <td>
                            @foreach($nscForUser->nominees as $key => $nominees)
                                <span class="label label-info">{{ $nominees->first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nscForUser.fields.amount_paid') }}
                        </th>
                        <td>
                            {{ $nscForUser->amount_paid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nscForUser.fields.amount_received') }}
                        </th>
                        <td>
                            {{ $nscForUser->amount_received }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nscForUser.fields.purchase_from') }}
                        </th>
                        <td>
                            {{ $nscForUser->purchase_from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nscForUser.fields.ref_contact_name') }}
                        </th>
                        <td>
                            {{ $nscForUser->ref_contact_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nscForUser.fields.ref_contact_no') }}
                        </th>
                        <td>
                            {{ $nscForUser->ref_contact_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nscForUser.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\NscForUser::STATUS_SELECT[$nscForUser->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.nsc-for-users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection