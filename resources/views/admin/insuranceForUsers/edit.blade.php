@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.insuranceForUser.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.insurance-for-users.update", [$insuranceForUser->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="issuer_name">{{ trans('cruds.insuranceForUser.fields.issuer_name') }}</label>
                <input class="form-control {{ $errors->has('issuer_name') ? 'is-invalid' : '' }}" type="text" name="issuer_name" id="issuer_name" value="{{ old('issuer_name', $insuranceForUser->issuer_name) }}" required>
                @if($errors->has('issuer_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('issuer_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.issuer_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.insuranceForUser.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $insuranceForUser->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="policy_no">{{ trans('cruds.insuranceForUser.fields.policy_no') }}</label>
                <input class="form-control {{ $errors->has('policy_no') ? 'is-invalid' : '' }}" type="text" name="policy_no" id="policy_no" value="{{ old('policy_no', $insuranceForUser->policy_no) }}" required>
                @if($errors->has('policy_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('policy_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.policy_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="insured_amount">{{ trans('cruds.insuranceForUser.fields.insured_amount') }}</label>
                <input class="form-control {{ $errors->has('insured_amount') ? 'is-invalid' : '' }}" type="number" name="insured_amount" id="insured_amount" value="{{ old('insured_amount', $insuranceForUser->insured_amount) }}" step="0.01">
                @if($errors->has('insured_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('insured_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.insured_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.insuranceForUser.fields.insurance_type') }}</label>
                <select class="form-control {{ $errors->has('insurance_type') ? 'is-invalid' : '' }}" name="insurance_type" id="insurance_type">
                    <option value disabled {{ old('insurance_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\InsuranceForUser::INSURANCE_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('insurance_type', $insuranceForUser->insurance_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('insurance_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('insurance_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.insurance_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="premium_amount">{{ trans('cruds.insuranceForUser.fields.premium_amount') }}</label>
                <input class="form-control {{ $errors->has('premium_amount') ? 'is-invalid' : '' }}" type="number" name="premium_amount" id="premium_amount" value="{{ old('premium_amount', $insuranceForUser->premium_amount) }}" step="0.01">
                @if($errors->has('premium_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('premium_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.premium_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.insuranceForUser.fields.premium_interval') }}</label>
                <select class="form-control {{ $errors->has('premium_interval') ? 'is-invalid' : '' }}" name="premium_interval" id="premium_interval">
                    <option value disabled {{ old('premium_interval', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\InsuranceForUser::PREMIUM_INTERVAL_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('premium_interval', $insuranceForUser->premium_interval) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('premium_interval'))
                    <div class="invalid-feedback">
                        {{ $errors->first('premium_interval') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.premium_interval_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_of_premium">{{ trans('cruds.insuranceForUser.fields.no_of_premium') }}</label>
                <input class="form-control {{ $errors->has('no_of_premium') ? 'is-invalid' : '' }}" type="number" name="no_of_premium" id="no_of_premium" value="{{ old('no_of_premium', $insuranceForUser->no_of_premium) }}" step="1">
                @if($errors->has('no_of_premium'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_of_premium') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.no_of_premium_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="holders">{{ trans('cruds.insuranceForUser.fields.holder') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('holders') ? 'is-invalid' : '' }}" name="holders[]" id="holders" multiple>
                    @foreach($holders as $id => $holder)
                        <option value="{{ $id }}" {{ (in_array($id, old('holders', [])) || $insuranceForUser->holders->contains($id)) ? 'selected' : '' }}>{{ $holder }}</option>
                    @endforeach
                </select>
                @if($errors->has('holders'))
                    <div class="invalid-feedback">
                        {{ $errors->first('holders') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.holder_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nominees">{{ trans('cruds.insuranceForUser.fields.nominees') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('nominees') ? 'is-invalid' : '' }}" name="nominees[]" id="nominees" multiple>
                    @foreach($nominees as $id => $nominees)
                        <option value="{{ $id }}" {{ (in_array($id, old('nominees', [])) || $insuranceForUser->nominees->contains($id)) ? 'selected' : '' }}>{{ $nominees }}</option>
                    @endforeach
                </select>
                @if($errors->has('nominees'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nominees') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.nominees_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_purchase">{{ trans('cruds.insuranceForUser.fields.date_of_purchase') }}</label>
                <input class="form-control date {{ $errors->has('date_of_purchase') ? 'is-invalid' : '' }}" type="text" name="date_of_purchase" id="date_of_purchase" value="{{ old('date_of_purchase', $insuranceForUser->date_of_purchase) }}">
                @if($errors->has('date_of_purchase'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_purchase') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.date_of_purchase_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_maturity">{{ trans('cruds.insuranceForUser.fields.date_of_maturity') }}</label>
                <input class="form-control date {{ $errors->has('date_of_maturity') ? 'is-invalid' : '' }}" type="text" name="date_of_maturity" id="date_of_maturity" value="{{ old('date_of_maturity', $insuranceForUser->date_of_maturity) }}">
                @if($errors->has('date_of_maturity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_maturity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.date_of_maturity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount_paid">{{ trans('cruds.insuranceForUser.fields.amount_paid') }}</label>
                <input class="form-control {{ $errors->has('amount_paid') ? 'is-invalid' : '' }}" type="number" name="amount_paid" id="amount_paid" value="{{ old('amount_paid', $insuranceForUser->amount_paid) }}" step="0.01">
                @if($errors->has('amount_paid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount_paid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.amount_paid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount_received">{{ trans('cruds.insuranceForUser.fields.amount_received') }}</label>
                <input class="form-control {{ $errors->has('amount_received') ? 'is-invalid' : '' }}" type="number" name="amount_received" id="amount_received" value="{{ old('amount_received', $insuranceForUser->amount_received) }}" step="0.01">
                @if($errors->has('amount_received'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount_received') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.amount_received_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="insured_period">{{ trans('cruds.insuranceForUser.fields.insured_period') }}</label>
                <input class="form-control {{ $errors->has('insured_period') ? 'is-invalid' : '' }}" type="number" name="insured_period" id="insured_period" value="{{ old('insured_period', $insuranceForUser->insured_period) }}" step="1">
                @if($errors->has('insured_period'))
                    <div class="invalid-feedback">
                        {{ $errors->first('insured_period') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.insured_period_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rate_intrest">{{ trans('cruds.insuranceForUser.fields.rate_intrest') }}</label>
                <input class="form-control {{ $errors->has('rate_intrest') ? 'is-invalid' : '' }}" type="number" name="rate_intrest" id="rate_intrest" value="{{ old('rate_intrest', $insuranceForUser->rate_intrest) }}" step="0.01">
                @if($errors->has('rate_intrest'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rate_intrest') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.rate_intrest_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ref_contact_no">{{ trans('cruds.insuranceForUser.fields.ref_contact_no') }}</label>
                <input class="form-control {{ $errors->has('ref_contact_no') ? 'is-invalid' : '' }}" type="text" name="ref_contact_no" id="ref_contact_no" value="{{ old('ref_contact_no', $insuranceForUser->ref_contact_no) }}">
                @if($errors->has('ref_contact_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ref_contact_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.ref_contact_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ref_contact_name">{{ trans('cruds.insuranceForUser.fields.ref_contact_name') }}</label>
                <input class="form-control {{ $errors->has('ref_contact_name') ? 'is-invalid' : '' }}" type="text" name="ref_contact_name" id="ref_contact_name" value="{{ old('ref_contact_name', $insuranceForUser->ref_contact_name) }}">
                @if($errors->has('ref_contact_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ref_contact_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.ref_contact_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.insuranceForUser.fields.note') }}</label>
                <textarea class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note">{{ old('note', $insuranceForUser->note) }}</textarea>
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.note_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.insuranceForUser.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\InsuranceForUser::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $insuranceForUser->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceForUser.fields.status_helper') }}</span>
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