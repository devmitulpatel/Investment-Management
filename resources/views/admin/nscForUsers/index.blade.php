@extends('layouts.admin')
@section('content')
@can('nsc_for_user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.nsc-for-users.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.nscForUser.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.nscForUser.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-NscForUser">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.nscForUser.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.nscForUser.fields.date_purchase') }}
                    </th>
                    <th>
                        {{ trans('cruds.nscForUser.fields.date_maturity') }}
                    </th>
                    <th>
                        {{ trans('cruds.nscForUser.fields.certificate_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.nscForUser.fields.holder') }}
                    </th>
                    <th>
                        {{ trans('cruds.nscForUser.fields.nominees') }}
                    </th>
                    <th>
                        {{ trans('cruds.nscForUser.fields.amount_paid') }}
                    </th>
                    <th>
                        {{ trans('cruds.nscForUser.fields.amount_received') }}
                    </th>
                    <th>
                        {{ trans('cruds.nscForUser.fields.purchase_from') }}
                    </th>
                    <th>
                        {{ trans('cruds.nscForUser.fields.ref_contact_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.nscForUser.fields.ref_contact_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.nscForUser.fields.status') }}
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
@can('nsc_for_user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.nsc-for-users.massDestroy') }}",
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
    ajax: "{{ route('admin.nsc-for-users.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'date_purchase', name: 'date_purchase' },
{ data: 'date_maturity', name: 'date_maturity' },
{ data: 'certificate_no', name: 'certificate_no' },
{ data: 'holder', name: 'holders.first_name' },
{ data: 'nominees', name: 'nominees.first_name' },
{ data: 'amount_paid', name: 'amount_paid' },
{ data: 'amount_received', name: 'amount_received' },
{ data: 'purchase_from', name: 'purchase_from' },
{ data: 'ref_contact_name', name: 'ref_contact_name' },
{ data: 'ref_contact_no', name: 'ref_contact_no' },
{ data: 'status', name: 'status' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-NscForUser').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection