@extends('layouts.admin')
@section('content')
@can('branch_of_banks_for_admin_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.branch-of-banks-for-admins.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.branchOfBanksForAdmin.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.branchOfBanksForAdmin.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-BranchOfBanksForAdmin">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.branchOfBanksForAdmin.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.branchOfBanksForAdmin.fields.bank') }}
                    </th>
                    <th>
                        {{ trans('cruds.branchOfBanksForAdmin.fields.ifsc_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.branchOfBanksForAdmin.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.branchOfBanksForAdmin.fields.area') }}
                    </th>
                    <th>
                        {{ trans('cruds.branchOfBanksForAdmin.fields.pincode') }}
                    </th>
                    <th>
                        {{ trans('cruds.branchOfBanksForAdmin.fields.ref_contact_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.branchOfBanksForAdmin.fields.ref_contact_no') }}
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
@can('branch_of_banks_for_admin_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.branch-of-banks-for-admins.massDestroy') }}",
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
    ajax: "{{ route('admin.branch-of-banks-for-admins.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'bank_name', name: 'bank.name' },
{ data: 'ifsc_code', name: 'ifsc_code' },
{ data: 'city', name: 'city' },
{ data: 'area', name: 'area' },
{ data: 'pincode', name: 'pincode' },
{ data: 'ref_contact_name', name: 'ref_contact_name' },
{ data: 'ref_contact_no', name: 'ref_contact_no' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-BranchOfBanksForAdmin').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection