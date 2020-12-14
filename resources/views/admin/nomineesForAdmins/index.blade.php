@extends('layouts.admin')
@section('content')
@can('nominees_for_admin_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.nominees-for-admins.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.nomineesForAdmin.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.nomineesForAdmin.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-NomineesForAdmin">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.nomineesForAdmin.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.nomineesForAdmin.fields.first_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.nomineesForAdmin.fields.middle_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.nomineesForAdmin.fields.last_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.nomineesForAdmin.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.nomineesForAdmin.fields.contact_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.nomineesForAdmin.fields.pan') }}
                    </th>
                    <th>
                        {{ trans('cruds.nomineesForAdmin.fields.aadhar_no') }}
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
@can('nominees_for_admin_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.nominees-for-admins.massDestroy') }}",
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
    ajax: "{{ route('admin.nominees-for-admins.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'first_name', name: 'first_name' },
{ data: 'middle_name', name: 'middle_name' },
{ data: 'last_name', name: 'last_name' },
{ data: 'email', name: 'email' },
{ data: 'contact_no', name: 'contact_no' },
{ data: 'pan', name: 'pan' },
{ data: 'aadhar_no', name: 'aadhar_no' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-NomineesForAdmin').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection