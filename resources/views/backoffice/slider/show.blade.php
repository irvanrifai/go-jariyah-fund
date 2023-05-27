@extends('adminlte::page')

@section('title', 'Detail Slide')

@section('content_header_title','Detail Slide')
@section('content_header_prev_link','/backoffice/')
@section('content_header_prev_text','Dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Slide: Detail</h3>

        <div class="card-tools btn-group mr-0">
            <a href="{{ route('backoffice.slider.index') }}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Kembali ke Daftar Slider">
                <i class="far fa-arrow-alt-circle-left mr-1"></i> Kembali
            </a>
            <a href="{{ route('backoffice.slider.edit', $slide->id) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit Data Admin">
                <i class="far fa-edit mr-1"></i> Edit
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered">
            <tr>
                <th>Judul</th>
                <td>{{ $slide->title }}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>{{ $slide->desc ?? '-' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td><input type="checkbox" name="is_show" data-plugin="switchery" data-color="#1bb99a" {{ $slide->is_show ? 'checked' : ''}} disabled></td>
            </tr>
            <tr>
                <th>Gambar</th>
                <td> <img src="{{ $slide->image}}" class="img-fluid rounded mx-auto d-block" alt="{{ env('APP_NAME') }}"> </td>   
            </tr>
            <tr>
                <th>Link</th>
                <td> {{ $slide->link ?? '-' }} </td>            
            </tr>

        </table>
    </div>
</div>
@endsection
