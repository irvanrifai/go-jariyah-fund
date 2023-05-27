@extends('adminlte::page')

@section('title', 'Manajemen User')

@section('content_header_title','Manajemen User')
@section('content_header_prev_link','/backoffice/')
@section('content_header_prev_text','Dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Admin: Detail</h3>

        <div class="card-tools btn-group mr-0">
            <a href="{{ route('backoffice.users.index') }}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Kembali ke Daftar Admin">
                <i class="far fa-arrow-alt-circle-left mr-1"></i> Kembali
            </a>
            <a href="{{ route('backoffice.users.edit', $user->id) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit Data Admin">
                <i class="far fa-edit mr-1"></i> Edit
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered">
            <tr>
                <th class="col-sm-2">Nama</th>
                <td>{{ ucwords($user->name) }}</td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td>{{ $user->email ?? '-' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucwords($user->status ?? '-') }}</td>
            </tr>
            <tr>
                <th>Kata Sandi</th>
                <td>{!! \Hash::check(env('PRIVATE_PASSWORD'), $user->password) ? '<span class="badge badge-secondary">Default Password</span>' : '-' !!}</td>
            </tr>
        </table>
    </div>
</div>
@endsection
