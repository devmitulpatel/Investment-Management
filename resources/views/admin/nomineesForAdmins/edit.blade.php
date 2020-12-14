@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.nomineesForAdmin.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.nominees-for-admins.update", [$nomineesForAdmin->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.nomineesForAdmin.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', $nomineesForAdmin->first_name) }}" required>
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nomineesForAdmin.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="middle_name">{{ trans('cruds.nomineesForAdmin.fields.middle_name') }}</label>
                <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $nomineesForAdmin->middle_name) }}" required>
                @if($errors->has('middle_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('middle_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nomineesForAdmin.fields.middle_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="last_name">{{ trans('cruds.nomineesForAdmin.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $nomineesForAdmin->last_name) }}" required>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nomineesForAdmin.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.nomineesForAdmin.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $nomineesForAdmin->email) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nomineesForAdmin.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_no">{{ trans('cruds.nomineesForAdmin.fields.contact_no') }}</label>
                <input class="form-control {{ $errors->has('contact_no') ? 'is-invalid' : '' }}" type="number" name="contact_no" id="contact_no" value="{{ old('contact_no', $nomineesForAdmin->contact_no) }}" step="1">
                @if($errors->has('contact_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nomineesForAdmin.fields.contact_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pan">{{ trans('cruds.nomineesForAdmin.fields.pan') }}</label>
                <input class="form-control {{ $errors->has('pan') ? 'is-invalid' : '' }}" type="text" name="pan" id="pan" value="{{ old('pan', $nomineesForAdmin->pan) }}">
                @if($errors->has('pan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nomineesForAdmin.fields.pan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="aadhar_no">{{ trans('cruds.nomineesForAdmin.fields.aadhar_no') }}</label>
                <input class="form-control {{ $errors->has('aadhar_no') ? 'is-invalid' : '' }}" type="text" name="aadhar_no" id="aadhar_no" value="{{ old('aadhar_no', $nomineesForAdmin->aadhar_no) }}">
                @if($errors->has('aadhar_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('aadhar_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nomineesForAdmin.fields.aadhar_no_helper') }}</span>
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