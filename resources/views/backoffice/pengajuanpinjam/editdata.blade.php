@extends('adminlte::page')

@section('title', 'Pengajuan Peminjaman')

@section('content_header_title','Pengajuan Peminjaman')
@section('content_header_prev_link','/backoffice/posts')

@section('plugins.Summernote', true)

@section('content')
<div class="row">
    <div class="col-12">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                {!! implode('', $errors->all('<li>:message</li>')) !!}
            </div>
        @endif
        <form action="{{url('anggota/updateajuanpinjam/'.$pengajuanpinjam->id)}}" method="post" style="padding-top: 10px">
            @csrf
            <div class="form-group">
                <label for="group_anggota_id" class="form-label">Group Anggota</label>
                <input type="text" name="group_anggota_id" id="group_anggota_id" value="{{$pengajuanpinjam->group_anggota_id}}" class="form-control" disabled>
            </div>
            <div class="form-group">
                <label for="nominal_request" class="form-label">Nominal Ajuan</label>
                <input type="text" name="nominal_request" id="nominal_request" value="{{$pengajuanpinjam->nominal_request}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="tenor" class="form-label">Tenor</label>
                <input name="tenor" class="form-control" id="tenor" value="{{$pengajuanpinjam->tenor}}" type="number">
            </div>
            <div class="form-group">
                <label for="desc_request" class="form-label">Keterangan</label>
                <input name="desc_request" class="form-control" id="desc_request" value="{{$pengajuanpinjam->desc_request}}" type="text">
            </div>
            <button type="submit" class="btn btn-primary btn-block" style="margin-top: 30px;margin-bottom: 20px;">Simpan</button>
        </form>
    </div>

</div>
@endsection