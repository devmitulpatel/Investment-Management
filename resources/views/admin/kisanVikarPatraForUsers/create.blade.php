@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.kisanVikarPatraForUser.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.kisan-vikar-patra-for-users.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="date_of_purchase">{{ trans('cruds.kisanVikarPatraForUser.fields.date_of_purchase') }}</label>
                <input class="form-control date {{ $errors->has('date_of_purchase') ? 'is-invalid' : '' }}" type="text" name="date_of_purchase" id="date_of_purchase" value="{{ old('date_of_purchase') }}" required>
                @if($errors->has('date_of_purchase'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_purchase') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kisanVikarPatraForUser.fields.date_of_purchase_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_maturity">{{ trans('cruds.kisanVikarPatraForUser.fields.date_of_maturity') }}</label>
                <input class="form-control date {{ $errors->has('date_of_maturity') ? 'is-invalid' : '' }}" type="text" name="date_of_maturity" id="date_of_maturity" value="{{ old('date_of_maturity') }}">
                @if($errors->has('date_of_maturity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_maturity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kisanVikarPatraForUser.fields.date_of_maturity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="certificate_no">{{ trans('cruds.kisanVikarPatraForUser.fields.certificate_no') }}</label>
                <input class="form-control {{ $errors->has('certificate_no') ? 'is-invalid' : '' }}" type="text" name="certificate_no" id="certificate_no" value="{{ old('certificate_no', '') }}" required>
                @if($errors->has('certificate_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('certificate_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kisanVikarPatraForUser.fields.certificate_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount_paid">{{ trans('cruds.kisanVikarPatraForUser.fields.amount_paid') }}</label>
                <input class="form-control {{ $errors->has('amount_paid') ? 'is-invalid' : '' }}" type="number" name="amount_paid" id="amount_paid" value="{{ old('amount_paid', '') }}" step="0.01" required>
                @if($errors->has('amount_paid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount_paid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kisanVikarPatraForUser.fields.amount_paid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount_received">{{ trans('cruds.kisanVikarPatraForUser.fields.amount_received') }}</label>
                <input class="form-control {{ $errors->has('amount_received') ? 'is-invalid' : '' }}" type="number" name="amount_received" id="amount_received" value="{{ old('amount_received', '') }}" step="0.01">
                @if($errors->has('amount_received'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount_received') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kisanVikarPatraForUser.fields.amount_received_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="holders">{{ trans('cruds.kisanVikarPatraForUser.fields.holder') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('holders') ? 'is-invalid' : '' }}" name="holders[]" id="holders" multiple>
                    @foreach($holders as $id => $holder)
                        <option value="{{ $id }}" {{ in_array($id, old('holders', [])) ? 'selected' : '' }}>{{ $holder }}</option>
                    @endforeach
                </select>
                @if($errors->has('holders'))
                    <div class="invalid-feedback">
                        {{ $errors->first('holders') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kisanVikarPatraForUser.fields.holder_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nominees">{{ trans('cruds.kisanVikarPatraForUser.fields.nominees') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('nominees') ? 'is-invalid' : '' }}" name="nominees[]" id="nominees" multiple>
                    @foreach($nominees as $id => $nominees)
                        <option value="{{ $id }}" {{ in_array($id, old('nominees', [])) ? 'selected' : '' }}>{{ $nominees }}</option>
                    @endforeach
                </select>
                @if($errors->has('nominees'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nominees') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kisanVikarPatraForUser.fields.nominees_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="purchase_from">{{ trans('cruds.kisanVikarPatraForUser.fields.purchase_from') }}</label>
                <textarea class="form-control {{ $errors->has('purchase_from') ? 'is-invalid' : '' }}" name="purchase_from" id="purchase_from">{{ old('purchase_from') }}</textarea>
                @if($errors->has('purchase_from'))
                    <div class="invalid-feedback">
                        {{ $errors->first('purchase_from') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kisanVikarPatraForUser.fields.purchase_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ref_contact_name">{{ trans('cruds.kisanVikarPatraForUser.fields.ref_contact_name') }}</label>
                <input class="form-control {{ $errors->has('ref_contact_name') ? 'is-invalid' : '' }}" type="text" name="ref_contact_name" id="ref_contact_name" value="{{ old('ref_contact_name', '') }}">
                @if($errors->has('ref_contact_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ref_contact_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kisanVikarPatraForUser.fields.ref_contact_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ref_contact_no">{{ trans('cruds.kisanVikarPatraForUser.fields.ref_contact_no') }}</label>
                <input class="form-control {{ $errors->has('ref_contact_no') ? 'is-invalid' : '' }}" type="number" name="ref_contact_no" id="ref_contact_no" value="{{ old('ref_contact_no', '') }}" step="1">
                @if($errors->has('ref_contact_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ref_contact_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kisanVikarPatraForUser.fields.ref_contact_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.kisanVikarPatraForUser.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\KisanVikarPatraForUser::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kisanVikarPatraForUser.fields.status_helper') }}</span>
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