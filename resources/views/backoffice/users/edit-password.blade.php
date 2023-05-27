@extends('adminlte::page')

@section('title', 'Manajemen User')

@section('content_header_title','Manajemen User')
@section('content_header_prev_link','/backoffice/')
@section('content_header_prev_text','Dashboard')

@section('content')
    <form class="card" action="{{ route('backoffice.users.updatePassword', $user->id) }}" method="POST">
        @csrf
        @method('patch')

        <div class="card-header d-flex align-items-center">
            <h3 class="card-title">Admin: Ubah Kata Sandi</h3>

            <div class="card-tools ml-auto mr-0">
                <a href="{{ route('backoffice.users.edit', $user->id) }}" class="btn btn-secondary btn-sm" data-toggle="tooltip" title="Kembali ke Sunting Data Admin">
                    <i class="far fa-arrow-alt-circle-left mr-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card-body">

            <div class="form-group row">
                <label for="current_password" class="col-sm-2 col-form-label">Kata Sandi Lama{!! printRequired() !!}</label>
            
                <div class="col-sm-10">
                    <input id="current_password" placeholder="Kata Sandi Lama" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="current_password">
            
                    @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-password" class="col-sm-2 col-form-label">Kata Sandi Baru{!! printRequired() !!}</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="input-password" placeholder="Kata Sandi Baru" value="{{ old('password') }}" required>
                    @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-password" class="col-sm-2 col-form-label">Konfirmasi Kata Sandi{!! printRequired() !!}</label>
                <div class="col-sm-10">
                    <input id="password-confirm" placeholder="Konfirmasi Kata Sandi" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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

