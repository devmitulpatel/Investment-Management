@extends('layouts.admin')
@section('content')
@can('fd_for_user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.fd-for-users.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.fdForUser.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.fdForUser.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-FdForUser">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.fdForUser.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.fdForUser.fields.bank') }}
                    </th>
                    <th>
                        {{ trans('cruds.fdForUser.fields.branch') }}
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
                        {{ trans('cruds.fdForUser.fields.account_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.fdForUser.fields.nominees') }}
                    </th>
                    <th>
                        {{ trans('cruds.fdForUser.fields.holder') }}
                    </th>
                    <th>
                        {{ trans('cruds.fdForUser.fields.amount_paid') }}
                    </th>
                    <th>
                        {{ trans('cruds.fdForUser.fields.interest_rate') }}
                    </th>
                    <th>
                        {{ trans('cruds.fdForUser.fields.date_purchase') }}
                    </th>
                    <th>
                        {{ trans('cruds.fdForUser.fields.date_maturity') }}
                    </th>
                    <th>
                        {{ trans('cruds.fdForUser.fields.amount_received') }}
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
@can('fd_for_user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.fd-for-users.massDestroy') }}",
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
    ajax: "{{ route('admin.fd-for-users.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'bank_name', name: 'bank.name' },
{ data: 'branch_ifsc_code', name: 'branch.ifsc_code' },
{ data: 'branch.city', name: 'branch.city' },
{ data: 'branch.area', name: 'branch.area' },
{ data: 'branch.pincode', name: 'branch.pincode' },
{ data: 'account_no', name: 'account_no' },
{ data: 'nominees', name: 'nominees.first_name' },
{ data: 'holder', name: 'holders.first_name' },
{ data: 'amount_paid', name: 'amount_paid' },
{ data: 'interest_rate', name: 'interest_rate' },
{ data: 'date_purchase', name: 'date_purchase' },
{ data: 'date_maturity', name: 'date_maturity' },
{ data: 'amount_received', name: 'amount_received' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-FdForUser').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection