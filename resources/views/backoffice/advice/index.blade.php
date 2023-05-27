@extends('adminlte::page')

@section('title', 'Saran')

@section('content_header_title','Saran')
@section('content_header_prev_link','/backoffice/')
@section('content_header_prev_text','Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Saran</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title">Semua Saran</h3>
        
                    <div class="card-tools ml-auto mr-0">
                        <a href="{{ route('backoffice.export-saran') }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Export">
                            <i class="fas fa-file-export mr-1"></i> Export
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="sarans-table" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Tanggal</th>
                            <th>Judul</th>
                            <th>Saran</th>
                            <th>Aksi</th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach($list as $li)
                            <tr id="row-num-{{ $li['id'] }}">
                                <td>
                                    <a href="/backoffice/advice/{{$li->id}}">{{ $li['name'] }}</a><br>
                                </td>
                                <td>{{ $li['telp'] }}</td>
                                <td>{{ date_format($li['created_at'], "d M Y") }}</td>
                                <td>{{ $li['subject'] }}</td>
                                <td>{{Str::limit(strip_tags( $li->text ), 50)}}</td>
                                <td>
                                    <center>
                                        <a   class="btn btn-link btn-sm text-info"
                                        href="/backoffice/advice/{{$li->id}}"><i class="fas fa-eye"></i>&nbsp;
                                            </a> &nbsp;
                                        <!-- <a class="btn btn-link btn-sm text-primary"
                                        href="/backoffice/advice/{{ $li['id'] }}/edit"><i class="fas fa-pen-fancy"></i>&nbsp;
                                            </a> &nbsp;
                                        <button class="btn btn-link btn-sm text-danger" onclick="formHapus({{ $li['id'] }})">
                                                <i class="fas fa-trash">
                                                </i>&nbsp;
                                        </button> -->
                                    </center>
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
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script> --}}
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> --}}
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/fc-3.3.2/fh-3.1.8/kt-2.6.1/r-2.2.7/rg-1.1.2/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.js"></script>
    <script>
        $(document).ready(() => {
            $("#sarans-table").DataTable({
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
                // console.log(result);
                if (result.value) {
                    $.ajax({
                        url: '{{route('backoffice.advice.destroy','')}}/' + id,
                        type: 'POST',
                        data: {
                            '_method': 'DELETE',
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function () {
                            $("#sarans-table").DataTable().row('#row-num-' + id).remove().draw();
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