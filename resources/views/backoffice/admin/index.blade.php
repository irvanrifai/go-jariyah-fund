@extends('adminlte::page')

@section('title', 'Manajemen User')

@section('content_header_title','Manajemen User')
@section('content_header_prev_link','/')
@section('content_header_prev_text','Halaman Depan')

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h3 class="card-title">Daftar Admin</h3>

            <div class="card-tools ml-auto mr-0">
                <a href="{{ route('adm.master-data.admin.create') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Tambah Data">
                    <i class="fas fa-plus mr-1"></i> Tambah Baru
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="admin-table" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="javascript:void(0)" onclick="refreshData()" class="btn btn-sm btn-secondary">Refresh</a>
        </div>
        <!-- /.card-footer-->
    </div>
@endsection


@section('js_inline')
    <script>
        $(document).ready(() => {
            $.fn.dataTable.moment( 'dddd, MMMM Do, YYYY' );
            $('#admin-table thead tr').clone(true).appendTo( '#admin-table thead' );
            $('#admin-table tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                $(this).html(`<input type="text" class="form-control form-control-sm" placeholder="Pencarian ${title}" />`);

                $( 'input', this ).on( 'keyup change', function () {
                    if ( admin_table.column(i).search() !== this.value ) {
                        admin_table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
            });
            const admin_table = $("#admin-table").DataTable({
                orderCellsTop: true,
                order: [0, 'asc'],
                lengthMenu: [5, 10, 25],
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: {
                    url: "{{ route('adm.json.datatable.master-data.admin') }}",
                    type: "GET",
                },
                initComplete: ( settings, json) => {
                    console.log(json);
                },
                columns: [
                    { "data": "name" },
                    { "data": "kontak" },
                    { "data": "status" },
                    { "data": "" }
                ],
                columnDefs: [
                    {
                        "targets": 0,
                        "render": (row, type, data) => {
                            return row;
                        }
                    }, {
                        "targets": 1,
                        "sortable": false,
                        "render": (row, type, data) => {
                            return row;
                        }
                    }, {
                        "targets": 2,
                        "render": (row, type, data) => {
                            return row;
                        }
                    }, {
                        "targets": 3,
                        "searchable": false,
                        "sortable": false,
                        "render": (row, type, data) => {
                            return `
                                <div class='btn-group'>
                                    <a href="{{ route('adm.master-data.admin.index') }}/${data.id}" class="btn btn-caction btn-info btn-sm">
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <a href="{{ route('adm.master-data.admin.index') }}/${data.id}/edit" class="btn btn-caction btn-warning btn-sm">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </div>
                            `;
                        }
                    }
                ],
                responsive: true
            });
        });

        function refreshData(){
            $("#admin-table").DataTable().ajax.reload();
        }
    </script>
@endsection
