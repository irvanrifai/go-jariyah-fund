@extends('adminlte::page')

@section('title', 'Manajemen User')

@section('content_header_title','Manajemen User')
@section('content_header_prev_link','/backoffice/')
@section('content_header_prev_text','Dashboard')

@section('content')
    <form class="card" action="{{ route('backoffice.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card-header d-flex align-items-center">
            <h3 class="card-title">Admin: Tambah Baru</h3>

            <div class="card-tools ml-auto mr-0">
                <a href="{{ route('backoffice.users.index') }}" class="btn btn-secondary btn-sm" data-toggle="tooltip" title="Kembali ke Daftar Admin">
                    <i class="far fa-arrow-alt-circle-left mr-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="form-group row">
                <label for="input-name" class="col-sm-2 col-form-label">Nama{!! printRequired() !!}</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="input-name" placeholder="Nama Admin" value="{{ old('name') }}" required>
                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-email" class="col-sm-2 col-form-label">Email{!! printRequired() !!}</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="input-email" placeholder="Email Admin" value="{{ old('email') }}" required>
                    @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-password" class="col-sm-2 col-form-label">Kata Sandi{!! printRequired() !!}</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="input-password" placeholder="Kata Sandi Admin" value="{{ old('password') }}" required>
                    @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-password" class="col-sm-2 col-form-label">Konfirmasi Kata Sandi{!! printRequired() !!}</label>
                <div class="col-sm-10">
                    <input id="password-confirm" placeholder="Konfirmasi Kata Sandi Admin" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row mb-0">
                <label for="input-status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10 d-flex align-items-center">
                    <div class="custom-control custom-checkbox">
                        <input name="status" class="custom-control-input" type="checkbox" id="input-status" value="aktif" {{ old('status') && old('status') == 'on' ? 'checked' : '' }}>
                        <label for="input-status" class="custom-control-label">Aktif</label>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="btn-group float-right">
                <button type="submit" class="btn btn-sm btn-primary">Tambahkan</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- /.card-footer-->
    </form>
@endsection


