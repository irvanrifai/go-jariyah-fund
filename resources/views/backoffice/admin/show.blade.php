@extends('adminlte::page')

@section('title', 'Manajemen User')

@section('content_header_title','Manajemen User')
@section('content_header_prev_link','/')
@section('content_header_prev_text','Halaman Depan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Admin: Detail</h3>

        <div class="card-tools btn-group mr-0">
            <a href="{{ route('adm.master-data.admin.index') }}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Kembali ke Daftar Admin">
                <i class="far fa-arrow-alt-circle-left mr-1"></i> Kembali
            </a>
            <a href="{{ route('adm.master-data.admin.edit', $data->id) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit Data Admin">
                <i class="far fa-edit mr-1"></i> Edit
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered">
            <tr>
                <th>Nama</th>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td>{{ $data->email ?? '-' }}</td>
            </tr>
            <tr>
                <th>Username</th>
                <td>{{ $data->username ?? '-' }}</td>
            </tr>
            <tr>
                <th>Password</th>
                <td>{!! \Hash::check(env('PRIVATE_PASSWORD'), $data->password) ? '<span class="badge badge-secondary">Default Password</span>' : '-' !!}</td>
            </tr>
        </table>
    </div>
</div>
@endsection
