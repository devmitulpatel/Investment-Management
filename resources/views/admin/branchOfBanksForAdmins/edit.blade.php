@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.branchOfBanksForAdmin.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.branch-of-banks-for-admins.update", [$branchOfBanksForAdmin->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="bank_id">{{ trans('cruds.branchOfBanksForAdmin.fields.bank') }}</label>
                <select class="form-control select2 {{ $errors->has('bank') ? 'is-invalid' : '' }}" name="bank_id" id="bank_id" required>
                    @foreach($banks as $id => $bank)
                        <option value="{{ $id }}" {{ (old('bank_id') ? old('bank_id') : $branchOfBanksForAdmin->bank->id ?? '') == $id ? 'selected' : '' }}>{{ $bank }}</option>
                    @endforeach
                </select>
                @if($errors->has('bank'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bank') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.branchOfBanksForAdmin.fields.bank_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ifsc_code">{{ trans('cruds.branchOfBanksForAdmin.fields.ifsc_code') }}</label>
                <input class="form-control {{ $errors->has('ifsc_code') ? 'is-invalid' : '' }}" type="text" name="ifsc_code" id="ifsc_code" value="{{ old('ifsc_code', $branchOfBanksForAdmin->ifsc_code) }}">
                @if($errors->has('ifsc_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ifsc_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.branchOfBanksForAdmin.fields.ifsc_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.branchOfBanksForAdmin.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $branchOfBanksForAdmin->city) }}">
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.branchOfBanksForAdmin.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="area">{{ trans('cruds.branchOfBanksForAdmin.fields.area') }}</label>
                <input class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" type="text" name="area" id="area" value="{{ old('area', $branchOfBanksForAdmin->area) }}">
                @if($errors->has('area'))
                    <div class="invalid-feedback">
                        {{ $errors->first('area') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.branchOfBanksForAdmin.fields.area_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pincode">{{ trans('cruds.branchOfBanksForAdmin.fields.pincode') }}</label>
                <input class="form-control {{ $errors->has('pincode') ? 'is-invalid' : '' }}" type="number" name="pincode" id="pincode" value="{{ old('pincode', $branchOfBanksForAdmin->pincode) }}" step="1">
                @if($errors->has('pincode'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pincode') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.branchOfBanksForAdmin.fields.pincode_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ref_contact_name">{{ trans('cruds.branchOfBanksForAdmin.fields.ref_contact_name') }}</label>
                <input class="form-control {{ $errors->has('ref_contact_name') ? 'is-invalid' : '' }}" type="text" name="ref_contact_name" id="ref_contact_name" value="{{ old('ref_contact_name', $branchOfBanksForAdmin->ref_contact_name) }}">
                @if($errors->has('ref_contact_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ref_contact_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.branchOfBanksForAdmin.fields.ref_contact_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ref_contact_no">{{ trans('cruds.branchOfBanksForAdmin.fields.ref_contact_no') }}</label>
                <input class="form-control {{ $errors->has('ref_contact_no') ? 'is-invalid' : '' }}" type="number" name="ref_contact_no" id="ref_contact_no" value="{{ old('ref_contact_no', $branchOfBanksForAdmin->ref_contact_no) }}" step="1">
                @if($errors->has('ref_contact_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ref_contact_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.branchOfBanksForAdmin.fields.ref_contact_no_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection