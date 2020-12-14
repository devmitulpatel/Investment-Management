@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.holdersForAdmin.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.holders-for-admins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.holdersForAdmin.fields.id') }}
                        </th>
                        <td>
                            {{ $holdersForAdmin->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.holdersForAdmin.fields.first_name') }}
                        </th>
                        <td>
                            {{ $holdersForAdmin->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.holdersForAdmin.fields.middle_name') }}
                        </th>
                        <td>
                            {{ $holdersForAdmin->middle_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.holdersForAdmin.fields.last_name') }}
                        </th>
                        <td>
                            {{ $holdersForAdmin->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.holdersForAdmin.fields.email') }}
                        </th>
                        <td>
                            {{ $holdersForAdmin->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.holdersForAdmin.fields.contact_no') }}
                        </th>
                        <td>
                            {{ $holdersForAdmin->contact_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.holdersForAdmin.fields.pan') }}
                        </th>
                        <td>
                            {{ $holdersForAdmin->pan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.holdersForAdmin.fields.aadhar_no') }}
                        </th>
                        <td>
                            {{ $holdersForAdmin->aadhar_no }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.holders-for-admins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection