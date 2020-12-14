@extends('layouts.admin')
@section('content')
@can('kisan_vikar_patra_for_user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.kisan-vikar-patra-for-users.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.kisanVikarPatraForUser.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.kisanVikarPatraForUser.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-KisanVikarPatraForUser">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.kisanVikarPatraForUser.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.kisanVikarPatraForUser.fields.date_of_purchase') }}
                    </th>
                    <th>
                        {{ trans('cruds.kisanVikarPatraForUser.fields.date_of_maturity') }}
                    </th>
                    <th>
                        {{ trans('cruds.kisanVikarPatraForUser.fields.certificate_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.kisanVikarPatraForUser.fields.amount_paid') }}
                    </th>
                    <th>
                        {{ trans('cruds.kisanVikarPatraForUser.fields.amount_received') }}
                    </th>
                    <th>
                        {{ trans('cruds.kisanVikarPatraForUser.fields.holder') }}
                    </th>
                    <th>
                        {{ trans('cruds.kisanVikarPatraForUser.fields.nominees') }}
                    </th>
                    <th>
                        {{ trans('cruds.kisanVikarPatraForUser.fields.purchase_from') }}
                    </th>
                    <th>
                        {{ trans('cruds.kisanVikarPatraForUser.fields.ref_contact_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.kisanVikarPatraForUser.fields.ref_contact_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.kisanVikarPatraForUser.fields.status') }}
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
@can('kisan_vikar_patra_for_user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.kisan-vikar-patra-for-users.massDestroy') }}",
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
    ajax: "{{ route('admin.kisan-vikar-patra-for-users.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'date_of_purchase', name: 'date_of_purchase' },
{ data: 'date_of_maturity', name: 'date_of_maturity' },
{ data: 'certificate_no', name: 'certificate_no' },
{ data: 'amount_paid', name: 'amount_paid' },
{ data: 'amount_received', name: 'amount_received' },
{ data: 'holder', name: 'holders.first_name' },
{ data: 'nominees', name: 'nominees.first_name' },
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
  let table = $('.datatable-KisanVikarPatraForUser').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection