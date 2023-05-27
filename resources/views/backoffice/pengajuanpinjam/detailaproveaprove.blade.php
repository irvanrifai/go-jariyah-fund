@extends('adminlte::page')

@section('title', 'Detail Approve')

@section('content_header_title','Detail Approve')
@section('content_header_prev_link','/backoffice/')
@section('content_header_prev_text','Detail Approve')

@section('content_header')
<h4 class="m-0 text-dark">Detail Approve</h4>
@stop

@section('content')
@foreach($duta as $duta)
<form action="{{url('anggota/detailaprove-aprove/')}}" style="padding-top: 10px">
            @csrf
             <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Keterangan Pinjaman </label>
                        <input name="nazhir_address" class="form-control" value="{{$duta->de}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Kelompok</label>
                        <input name="nazhir_pic" class="form-control" value="{{$duta->name}}" type="text"  disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label>Status </label>
                        <input name="nazhir_contact" class="form-control" value="{{$duta->status}}" type="text"  disabled>
                      </div>
                    </div>
                   
                    <div class="col-6">
                      <div class="form-group">
                        <label>Tanggal Disetujui </label>
                        <input name="nazhir_website" class="form-control" value="{{$duta->dt}}" type="text"  disabled>
                      </div>
                    </div>
                  </div>


<div class="row">
<div class="col">
                      <div class="form-group">
                        <label>Note </label>
                        <input name="nazhir_email" class="form-control" value="{{$duta->note}}" type="text"  disabled>
                      </div>
                    </div>
                
                    @endforeach
                    @stop