@extends('adminlte::page')

@section('title', 'Semua Artikel')

@section('content_header_title','Semua Artikel')
@section('content_header_prev_link','/backoffice/')
@section('content_header_prev_text','Dashboard')

@section('content_header')
<h1 class="m-0 text-dark">Semua Artikel</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="daftar-artikel-table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop


@section('adminlte_css')
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/fc-3.3.2/fh-3.1.8/kt-2.6.1/r-2.2.7/rg-1.1.2/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.css" />
@stop

@section('adminlte_js')
<script type="text/javascript"
    src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/fc-3.3.2/fh-3.1.8/kt-2.6.1/r-2.2.7/rg-1.1.2/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.js">
    </script>
<script>
    const table = $('#daftar-artikel-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('backoffice.posts.datatable') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', width: "5%", orderable: false, searchable: false },
            { data: 'title', name: 'title' },
            { data: 'category_title', name: 'category_title', orderable: false, searchable: true },
            { data: 'status', name: 'status', width: "5%", orderable: false, searchable: false },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: "15%"
            },
        ],
    });
</script>

@stop