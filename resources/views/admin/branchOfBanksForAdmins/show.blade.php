@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.branchOfBanksForAdmin.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.branch-of-banks-for-admins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.branchOfBanksForAdmin.fields.id') }}
                        </th>
                        <td>
                            {{ $branchOfBanksForAdmin->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.branchOfBanksForAdmin.fields.bank') }}
                        </th>
                        <td>
                            {{ $branchOfBanksForAdmin->bank->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.branchOfBanksForAdmin.fields.ifsc_code') }}
                        </th>
                        <td>
                            {{ $branchOfBanksForAdmin->ifsc_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.branchOfBanksForAdmin.fields.city') }}
                        </th>
                        <td>
                            {{ $branchOfBanksForAdmin->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.branchOfBanksForAdmin.fields.area') }}
                        </th>
                        <td>
                            {{ $branchOfBanksForAdmin->area }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.branchOfBanksForAdmin.fields.pincode') }}
                        </th>
                        <td>
                            {{ $branchOfBanksForAdmin->pincode }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.branchOfBanksForAdmin.fields.ref_contact_name') }}
                        </th>
                        <td>
                            {{ $branchOfBanksForAdmin->ref_contact_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.branchOfBanksForAdmin.fields.ref_contact_no') }}
                        </th>
                        <td>
                            {{ $branchOfBanksForAdmin->ref_contact_no }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.branch-of-banks-for-admins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection