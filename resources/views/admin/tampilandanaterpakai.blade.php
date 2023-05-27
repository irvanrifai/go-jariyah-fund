@extends('admin.index')

@section('body')
<div class="content">
        <div class="row pl-2 pt-2">
        <h4> Dana Terpakai </h4>
          <div class="col-md-12">
            <div class="card demo-icons" style="margin-top:20px;">
              <div class="card-header">
                <a href="{{ url('admin/add-dana-terpakai') }}" class="btn btn-primary active" style="margin-bottom:10px;" role="button">  <i class="nav-icon fas fa-plus"></i>&nbsp;Tambah Data</a>
                <table id="myTable" class="table table-hover table-striped table-bordered" style="width:100%">
                    <thead class="thead-light" >
                        <tr>
                            <th>Keterangan Peruntukan</th>
                            <th>Dana Terpakai</th>
                            <th>Tanggal Dana Terpakai</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>

    <script>
        const table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            aaSorting: [[ 0, "desc" ]],
           // "sPaginationType": "full_numbers",
            ajax: "{{ route('admin.mudharabah.mudharabah') }}",
            columns: [
                {data:'desc_request',name: 'desc_request'},
                {data:'total_mudharabah', name:'total_mudharabah',  render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' )},
                {
                    render: function(data, type, row, meta)
                    {
                       return moment(row.created_at).format('lll');
                    },
                },
                //{data:'updated_at', name:'updated_at'},
                {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                autowidth: false
                },
            ],
    });
    </script>
    <style>
    .dataTables_filter {
        text-align: right;
        margin-right: 15px;
        margin-top: 0px;   }

    .demo-icons ul li{
        width: auto;
    }

    .dataTables_wrapper .dataTables_paginate {
        float: right;
        text-align: right;
    }
</style>
@endsection
