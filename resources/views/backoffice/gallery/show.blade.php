@extends('adminlte::page')

@section('title', 'Detail Gambar')

@section('content_header_title','Detail Gambar')
@section('content_header_prev_link','/backoffice/')
@section('content_header_prev_text','Dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="margin-top: 1px">Gallery: Detail</h3>

        <div class="card-tools btn-group mr-0">
            <a href="{{ route('backoffice.gallery.index') }}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Kembali ke Daftar Gallery">
                <i class="far fa-arrow-alt-circle-left mr-1"></i> Kembali
            </a>
            <a href="{{ route('backoffice.gallery.edit', $gallery->id) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit Data Admin">
                <i class="far fa-edit mr-1"></i> Edit
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered">
            <tr>
                <th class="col-sm-2">Judul</th>
                <td>{{ $gallery->title }}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>{{ $gallery->desc ?? '-' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td><input type="checkbox" name="is_show" data-plugin="switchery" data-color="#1bb99a" {{ $gallery->is_show ? 'checked' : ''}} disabled></td>
            </tr>
            <tr>
                <th>Gambar</th>
                <td> <img src="{{ $gallery->image ?? '-' }}" class="rounded img-fluid"/></td>
            </tr>
        </table>
    </div>
</div>
@endsection
