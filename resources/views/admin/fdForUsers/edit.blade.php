@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.fdForUser.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fd-for-users.update", [$fdForUser->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="bank_id">{{ trans('cruds.fdForUser.fields.bank') }}</label>
                <select class="form-control select2 {{ $errors->has('bank') ? 'is-invalid' : '' }}" name="bank_id" id="bank_id" required>
                    @foreach($banks as $id => $bank)
                        <option value="{{ $id }}" {{ (old('bank_id') ? old('bank_id') : $fdForUser->bank->id ?? '') == $id ? 'selected' : '' }}>{{ $bank }}</option>
                    @endforeach
                </select>
                @if($errors->has('bank'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bank') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fdForUser.fields.bank_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="branch_id">{{ trans('cruds.fdForUser.fields.branch') }}</label>
                <select class="form-control select2 {{ $errors->has('branch') ? 'is-invalid' : '' }}" name="branch_id" id="branch_id">
                    @foreach($branches as $id => $branch)
                        <option value="{{ $id }}" {{ (old('branch_id') ? old('branch_id') : $fdForUser->branch->id ?? '') == $id ? 'selected' : '' }}>{{ $branch }}</option>
                    @endforeach
                </select>
                @if($errors->has('branch'))
                    <div class="invalid-feedback">
                        {{ $errors->first('branch') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fdForUser.fields.branch_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="account_no">{{ trans('cruds.fdForUser.fields.account_no') }}</label>
                <input class="form-control {{ $errors->has('account_no') ? 'is-invalid' : '' }}" type="number" name="account_no" id="account_no" value="{{ old('account_no', $fdForUser->account_no) }}" step="1" required>
                @if($errors->has('account_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('account_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fdForUser.fields.account_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nominees">{{ trans('cruds.fdForUser.fields.nominees') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('nominees') ? 'is-invalid' : '' }}" name="nominees[]" id="nominees" multiple>
                    @foreach($nominees as $id => $nominees)
                        <option value="{{ $id }}" {{ (in_array($id, old('nominees', [])) || $fdForUser->nominees->contains($id)) ? 'selected' : '' }}>{{ $nominees }}</option>
                    @endforeach
                </select>
                @if($errors->has('nominees'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nominees') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fdForUser.fields.nominees_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="holders">{{ trans('cruds.fdForUser.fields.holder') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('holders') ? 'is-invalid' : '' }}" name="holders[]" id="holders" multiple required>
                    @foreach($holders as $id => $holder)
                        <option value="{{ $id }}" {{ (in_array($id, old('holders', [])) || $fdForUser->holders->contains($id)) ? 'selected' : '' }}>{{ $holder }}</option>
                    @endforeach
                </select>
                @if($errors->has('holders'))
                    <div class="invalid-feedback">
                        {{ $errors->first('holders') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fdForUser.fields.holder_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount_paid">{{ trans('cruds.fdForUser.fields.amount_paid') }}</label>
                <input class="form-control {{ $errors->has('amount_paid') ? 'is-invalid' : '' }}" type="number" name="amount_paid" id="amount_paid" value="{{ old('amount_paid', $fdForUser->amount_paid) }}" step="0.01">
                @if($errors->has('amount_paid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount_paid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fdForUser.fields.amount_paid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="interest_rate">{{ trans('cruds.fdForUser.fields.interest_rate') }}</label>
                <input class="form-control {{ $errors->has('interest_rate') ? 'is-invalid' : '' }}" type="number" name="interest_rate" id="interest_rate" value="{{ old('interest_rate', $fdForUser->interest_rate) }}" step="0.00001">
                @if($errors->has('interest_rate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('interest_rate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fdForUser.fields.interest_rate_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_purchase">{{ trans('cruds.fdForUser.fields.date_purchase') }}</label>
                <input class="form-control date {{ $errors->has('date_purchase') ? 'is-invalid' : '' }}" type="text" name="date_purchase" id="date_purchase" value="{{ old('date_purchase', $fdForUser->date_purchase) }}" required>
                @if($errors->has('date_purchase'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_purchase') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fdForUser.fields.date_purchase_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_maturity">{{ trans('cruds.fdForUser.fields.date_maturity') }}</label>
                <input class="form-control date {{ $errors->has('date_maturity') ? 'is-invalid' : '' }}" type="text" name="date_maturity" id="date_maturity" value="{{ old('date_maturity', $fdForUser->date_maturity) }}" required>
                @if($errors->has('date_maturity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_maturity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fdForUser.fields.date_maturity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount_received">{{ trans('cruds.fdForUser.fields.amount_received') }}</label>
                <input class="form-control {{ $errors->has('amount_received') ? 'is-invalid' : '' }}" type="number" name="amount_received" id="amount_received" value="{{ old('amount_received', $fdForUser->amount_received) }}" step="0.01">
                @if($errors->has('amount_received'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount_received') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fdForUser.fields.amount_received_helper') }}</span>
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