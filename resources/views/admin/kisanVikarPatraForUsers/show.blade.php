@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.kisanVikarPatraForUser.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kisan-vikar-patra-for-users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.kisanVikarPatraForUser.fields.id') }}
                        </th>
                        <td>
                            {{ $kisanVikarPatraForUser->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kisanVikarPatraForUser.fields.date_of_purchase') }}
                        </th>
                        <td>
                            {{ $kisanVikarPatraForUser->date_of_purchase }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kisanVikarPatraForUser.fields.date_of_maturity') }}
                        </th>
                        <td>
                            {{ $kisanVikarPatraForUser->date_of_maturity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kisanVikarPatraForUser.fields.certificate_no') }}
                        </th>
                        <td>
                            {{ $kisanVikarPatraForUser->certificate_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kisanVikarPatraForUser.fields.amount_paid') }}
                        </th>
                        <td>
                            {{ $kisanVikarPatraForUser->amount_paid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kisanVikarPatraForUser.fields.amount_received') }}
                        </th>
                        <td>
                            {{ $kisanVikarPatraForUser->amount_received }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kisanVikarPatraForUser.fields.holder') }}
                        </th>
                        <td>
                            @foreach($kisanVikarPatraForUser->holders as $key => $holder)
                                <span class="label label-info">{{ $holder->first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kisanVikarPatraForUser.fields.nominees') }}
                        </th>
                        <td>
                            @foreach($kisanVikarPatraForUser->nominees as $key => $nominees)
                                <span class="label label-info">{{ $nominees->first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kisanVikarPatraForUser.fields.purchase_from') }}
                        </th>
                        <td>
                            {{ $kisanVikarPatraForUser->purchase_from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kisanVikarPatraForUser.fields.ref_contact_name') }}
                        </th>
                        <td>
                            {{ $kisanVikarPatraForUser->ref_contact_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kisanVikarPatraForUser.fields.ref_contact_no') }}
                        </th>
                        <td>
                            {{ $kisanVikarPatraForUser->ref_contact_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kisanVikarPatraForUser.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\KisanVikarPatraForUser::STATUS_SELECT[$kisanVikarPatraForUser->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kisan-vikar-patra-for-users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection