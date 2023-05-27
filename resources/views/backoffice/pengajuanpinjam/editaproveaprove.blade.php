@extends('adminlte::page')

@section('title', 'Edit Izin Yang Anda Berikan')

@section('content_header_title','Edit Izin Yang Anda Berikan')
@section('content_header_prev_link','/backoffice/')
@section('content_header_prev_text','Edit Izin Yang Anda Berikan')

@section('content_header')
<h4 class="m-0 text-dark">Edit Izin Yang Anda Berikan</h4>
@stop

@section('content')
<form>
<div class="card" style="padding:20px;">
    <div class="row">
        <div class="col">
            <label for="message-text" class="col-form-label">Status:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="accepted" name="radio" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Setuju
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="reject" name="radio" id="flexRadioDefault2" checked>
                <label class="form-check-label" for="flexRadioDefault2">
                    Tolak
                </label>
            </div>
        </div>
    </div></br>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label>Note</label>
                    <textarea type="text" name="note_internal" id="note_internal" value="{{$data->note_internal}}" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@stop