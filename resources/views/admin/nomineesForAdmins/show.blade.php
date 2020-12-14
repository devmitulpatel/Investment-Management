@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.nomineesForAdmin.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.nominees-for-admins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.nomineesForAdmin.fields.id') }}
                        </th>
                        <td>
                            {{ $nomineesForAdmin->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nomineesForAdmin.fields.first_name') }}
                        </th>
                        <td>
                            {{ $nomineesForAdmin->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nomineesForAdmin.fields.middle_name') }}
                        </th>
                        <td>
                            {{ $nomineesForAdmin->middle_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nomineesForAdmin.fields.last_name') }}
                        </th>
                        <td>
                            {{ $nomineesForAdmin->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nomineesForAdmin.fields.email') }}
                        </th>
                        <td>
                            {{ $nomineesForAdmin->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nomineesForAdmin.fields.contact_no') }}
                        </th>
                        <td>
                            {{ $nomineesForAdmin->contact_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nomineesForAdmin.fields.pan') }}
                        </th>
                        <td>
                            {{ $nomineesForAdmin->pan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nomineesForAdmin.fields.aadhar_no') }}
                        </th>
                        <td>
                            {{ $nomineesForAdmin->aadhar_no }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.nominees-for-admins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection