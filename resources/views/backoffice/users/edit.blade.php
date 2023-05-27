@extends('adminlte::page')

@section('title', 'Manajemen User')

@section('content_header_title','Manajemen User')
@section('content_header_prev_link','/backoffice/')
@section('content_header_prev_text','Dashboard')

@section('content')
    <form class="card" action="{{ route('backoffice.users.update', $user->id) }}" method="POST">
        @csrf
        @method('patch')

        <div class="card-header d-flex align-items-center">
            <h3 class="card-title">Admin: Sunting Data</h3>

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
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="input-name" placeholder="Nama Admin" value="{{ $user->name }}" required>
                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-email" class="col-sm-2 col-form-label">Email{!! printRequired() !!}</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="input-email" placeholder="Email Admin" value="{{ $user->email}}" required>
                    @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-email" class="col-sm-2 col-form-label">Kata Sandi</label>
                <a class="btn btn-link btn-sm text-primary" title="Edit" style="margin-top: 6px"
                href="{{ route('backoffice.users.editPassword', $user->id) }}"><i class="fas fa-pen-fancy">&nbsp Ubah Kata Sandi?</i>&nbsp;
                </a> &nbsp;   
            </div>

            <div class="form-group row mb-0">
                <label for="input-status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10 d-flex align-items-center">
                    <div class="custom-control custom-checkbox">
                        <input name="status" class="custom-control-input" type="checkbox" id="input-status" value="aktif" {{ $user->status ? 'checked' : '' }}>
                        <label for="input-status" class="custom-control-label">Aktif</label>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="btn-group float-right">
                <button type="submit" class="btn btn-sm btn-primary">Perbarui</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- /.card-footer-->
    </form>
@endsection

