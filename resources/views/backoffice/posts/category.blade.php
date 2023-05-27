@extends('adminlte::page')

@section('title', 'Kategori Artikel')

@section('content_header_prev_link','/backoffice/')
@section('content_header_prev_text','Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Kategori Artikel</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <table id="categories-table" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th></th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach($list as $li)
                            <tr id="row-num-{{ $li['id'] }}">
                                <td>
                                    <a href="/backoffice/posts/{{ $li['id'] }}/edit">{{ $li['title'] }}</a><br>
                                </td>
                                <td>
                                    <a target="_blank" class="btn btn-link btn-sm text-info"
                                       href="/topik/{{ $li['slug'] }}/?preview=1" style="display: none"><i class="fas fa-eye"></i>&nbsp;
                                        Lihat</a> &nbsp;
                                    <a class="btn btn-link btn-sm text-primary"
                                       href="/backoffice/categories/{{ $li['id'] }}/edit"><i class="fas fa-pen-fancy"></i>&nbsp;
                                        Edit</a> &nbsp;
                                    <button class="btn btn-link btn-sm text-danger"
                                            onclick="formHapus({{ $li['id'] }})"><i class="fas fa-trash"></i>&nbsp;
                                        Hapus
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    Tambah Kategori
                </div>
                <div class="card-body">
                    <form class="main-form" action="{{ route('backoffice.categories.store') }}" method="POST"
          enctype="multipart/form-data">
        @csrf
                    <div class="form-group">
                        <input name="title" placeholder="Judul Kategori" type="text" class="form-control"
                               id="titleCategory"
                               aria-describedby="helperTitle">
                    </div>
                    <div class="form-group">
                        <label for="descriptionCategory">Deskripsi</label><textarea name="description"
                                                                                    class="form-control"
                                                                                    id="descriptionCategory"
                                                                                    rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"><i
                                class="fas fa-tag"></i>&nbsp;&nbsp;&nbsp;Tambahkan Kategori
                        </button>

                    </div>
                    </form>
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
            $("#categories-table").DataTable({
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
                        url: '{{route('backoffice.categories.destroy','')}}/' + id,
                        type: 'POST',
                        data: {
                            '_method': 'DELETE',
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function () {
                            $("#categories-table").DataTable().row('#row-num-' + id).remove().draw();
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
