@extends('admin.layout.main')

@section('title', 'Nazhir')

@section('body')
<div class="content">
    <div class="row">
        <div class="col-md-12">
        <h4 class="p-2">Data Nazhir</h4>
          <div class="card demo-icons" style="margin-top:20px;">
            <div class="card-header">
                    {{-- <a href="{{ url('admin/add-nazhir') }}" class="btn btn-primary active" style="margin-bottom:10px;" role="button"><i class="nav-icon fas fa-plus"></i>&nbsp;Tambah Data</a> --}}
                    <div class="table-responsive">
                        <table id="myTable" class="table table-hover table-striped table-bordered">
                        <thead class="thead-light" >
                            <tr>
                                <th>Nama Nazhir</th>
                                <th>Level Nazhir</th>
                                <th>PIC Nazhir</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>

    <script>
        const table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            //"sPaginationType": "full_numbers",
            ajax: "{{ route('admin.data-nazhir') }}",
            columns: [
                //{data:'group_anggota_id', name : 'group_anggota_id'},
                {data:'nazhir_name',name: 'nazhir_name'},
                {data:'nazhir_level', name:'nazhir_level'},
                {data:'nazhir_pic', name:'nazhir_pic'},

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
