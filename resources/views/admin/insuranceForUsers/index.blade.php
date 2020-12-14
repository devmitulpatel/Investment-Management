@extends('layouts.admin')
@section('content')
@can('insurance_for_user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.insurance-for-users.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.insuranceForUser.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.insuranceForUser.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-InsuranceForUser">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.issuer_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.policy_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.insured_amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.insurance_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.premium_amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.premium_interval') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.no_of_premium') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.holder') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.nominees') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.date_of_purchase') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.date_of_maturity') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.amount_paid') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.amount_received') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.insured_period') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.rate_intrest') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.ref_contact_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.ref_contact_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.note') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceForUser.fields.status') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('insurance_for_user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.insurance-for-users.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.insurance-for-users.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'issuer_name', name: 'issuer_name' },
{ data: 'name', name: 'name' },
{ data: 'policy_no', name: 'policy_no' },
{ data: 'insured_amount', name: 'insured_amount' },
{ data: 'insurance_type', name: 'insurance_type' },
{ data: 'premium_amount', name: 'premium_amount' },
{ data: 'premium_interval', name: 'premium_interval' },
{ data: 'no_of_premium', name: 'no_of_premium' },
{ data: 'holder', name: 'holders.first_name' },
{ data: 'nominees', name: 'nominees.first_name' },
{ data: 'date_of_purchase', name: 'date_of_purchase' },
{ data: 'date_of_maturity', name: 'date_of_maturity' },
{ data: 'amount_paid', name: 'amount_paid' },
{ data: 'amount_received', name: 'amount_received' },
{ data: 'insured_period', name: 'insured_period' },
{ data: 'rate_intrest', name: 'rate_intrest' },
{ data: 'ref_contact_no', name: 'ref_contact_no' },
{ data: 'ref_contact_name', name: 'ref_contact_name' },
{ data: 'note', name: 'note' },
{ data: 'status', name: 'status' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-InsuranceForUser').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection