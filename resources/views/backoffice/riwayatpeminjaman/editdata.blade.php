@extends('adminlte::page')

@section('title', 'Edit Cicilan')

@section('content_header_title','Edit Cicilan')
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
        <form action="{{url('anggota/updatecicil/'.$editcicil->id)}}" method="post" style="padding-top: 10px">
            @csrf
            <div class="form-group">
                <label for="nominal" class="form-label">Nominal Cicilan</label>
                <input type="text" name="nominal" id="nominal" value="{{$editcicil->nominal}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="status" class="form-label">Status</label>
                <input type="text" name="status" id="status" value="{{$editcicil->is_valid}}" class="form-control" disabled>
            </div>
            <button type="submit" class="btn btn-primary btn-block" style="margin-top: 30px;margin-bottom: 20px;">Simpan</button>
        </form>
    </div>

</div>
@endsection