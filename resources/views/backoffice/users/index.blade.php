@extends('adminlte::page')

@section('title', 'Manajemen User')

@section('content_header_title','Manajemen User')
@section('content_header_prev_link','/backoffice/')
@section('content_header_prev_text','Dashboard')

@section('content')
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title">Daftar Admin</h3>
        
                    <div class="card-tools ml-auto mr-0">
                        <a href="{{ route('backoffice.users.create') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Tambah Data">
                            <i class="fas fa-plus mr-1"></i> Tambah Baru
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="admin-table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($user as $li)
                            <tr id="row-num-{{ $li['id'] }}">
                                <td><a href="{{ route('backoffice.users.show', $li['id']) }}">{{ucwords($li['name'])}}</td>  
                                <td>{{$li['email']}}</td>
                                <td>{{ucwords($li['status'] ?? '-') }}</td>
                                <td>
                                    <a class="btn btn-link btn-sm text-info" title="Lihat Detail"
                                        href="{{ route('backoffice.users.show', $li['id']) }}"><i class="fas fa-eye"></i>&nbsp;
                                    </a> &nbsp;
                                    <a class="btn btn-link btn-sm text-primary" title="Edit"
                                        href="{{ route('backoffice.users.edit', $li['id']) }}"><i class="fas fa-pen-fancy"></i>&nbsp;
                                    </a> &nbsp;            
                                    <button class="btn btn-link btn-sm text-danger" title="Hapus"
                                        onclick="formHapus({{$li['id']}})"><i class="fas fa-trash"></i>&nbsp;
                                    </button>
                                </td>    
                            </tr> 
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop


@section('adminlte_css')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/fc-3.3.2/fh-3.1.8/kt-2.6.1/r-2.2.7/rg-1.1.2/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.css"/>
@stop

@section('adminlte_js')
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/fc-3.3.2/fh-3.1.8/kt-2.6.1/r-2.2.7/rg-1.1.2/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.js"></script>
    <script>
        $(document).ready(() => {
            $("#admin-table").DataTable({
                order: [0, 'asc'],
                responsive: true
            });

        });

        function formHapus(id) {
            Swal.fire({
                title: 'Apakah Anda Yakin Hapus Data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lakukan!',
                cancelButtonText: 'Tidak, Batalkan!',
                reverseButtons: true,
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '{{route('backoffice.users.destroy','')}}/' + id,
                        type: 'POST',
                        data: {
                            '_method': 'DELETE',
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function () {
                            $("#admin-table").DataTable().row('#row-num-' + id).remove().draw();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Hapus Data'
                            })
                        },
                        error: function (xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            console.log(err);
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan Dalam Penghapusan Data'
                            })
                        }
                    })
                }
            });
        }
    </script>

@stop