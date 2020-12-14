@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.bankAccount.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bank-accounts.update", [$bankAccount->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="bank_id">{{ trans('cruds.bankAccount.fields.bank') }}</label>
                <select class="form-control select2 {{ $errors->has('bank') ? 'is-invalid' : '' }}" name="bank_id" id="bank_id">
                    @foreach($banks as $id => $bank)
                        <option value="{{ $id }}" {{ (old('bank_id') ? old('bank_id') : $bankAccount->bank->id ?? '') == $id ? 'selected' : '' }}>{{ $bank }}</option>
                    @endforeach
                </select>
                @if($errors->has('bank'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bank') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccount.fields.bank_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="branch_id">{{ trans('cruds.bankAccount.fields.branch') }}</label>
                <select class="form-control select2 {{ $errors->has('branch') ? 'is-invalid' : '' }}" name="branch_id" id="branch_id" required>
                    @foreach($branches as $id => $branch)
                        <option value="{{ $id }}" {{ (old('branch_id') ? old('branch_id') : $bankAccount->branch->id ?? '') == $id ? 'selected' : '' }}>{{ $branch }}</option>
                    @endforeach
                </select>
                @if($errors->has('branch'))
                    <div class="invalid-feedback">
                        {{ $errors->first('branch') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccount.fields.branch_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="holders">{{ trans('cruds.bankAccount.fields.holder') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('holders') ? 'is-invalid' : '' }}" name="holders[]" id="holders" multiple required>
                    @foreach($holders as $id => $holder)
                        <option value="{{ $id }}" {{ (in_array($id, old('holders', [])) || $bankAccount->holders->contains($id)) ? 'selected' : '' }}>{{ $holder }}</option>
                    @endforeach
                </select>
                @if($errors->has('holders'))
                    <div class="invalid-feedback">
                        {{ $errors->first('holders') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccount.fields.holder_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nominees">{{ trans('cruds.bankAccount.fields.nominees') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('nominees') ? 'is-invalid' : '' }}" name="nominees[]" id="nominees" multiple>
                    @foreach($nominees as $id => $nominees)
                        <option value="{{ $id }}" {{ (in_array($id, old('nominees', [])) || $bankAccount->nominees->contains($id)) ? 'selected' : '' }}>{{ $nominees }}</option>
                    @endforeach
                </select>
                @if($errors->has('nominees'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nominees') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccount.fields.nominees_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="opening_balance">{{ trans('cruds.bankAccount.fields.opening_balance') }}</label>
                <input class="form-control {{ $errors->has('opening_balance') ? 'is-invalid' : '' }}" type="number" name="opening_balance" id="opening_balance" value="{{ old('opening_balance', $bankAccount->opening_balance) }}" step="0.01">
                @if($errors->has('opening_balance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('opening_balance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccount.fields.opening_balance_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.bankAccount.fields.note') }}</label>
                <textarea class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note">{{ old('note', $bankAccount->note) }}</textarea>
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccount.fields.note_helper') }}</span>
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