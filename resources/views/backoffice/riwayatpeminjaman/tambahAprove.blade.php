@extends('adminlte::page')

@section('title', 'Add Approval')

@section('content_header_title','Add Approval')
@section('content_header_prev_link','/backoffice/')
@section('content_header_prev_text','Add Aproval')

@section('content_header')
<h4 class="m-0 text-dark">Tambah Data Approval</h4>
@stop

@section('content')
<form action="{{ url('anggota/tambahaprove') }}" method="POST" enctype="multipart/form-data" name="formcicil">
        @csrf
        <div class="container-fluid p-1">
            <div class="card p-4">

            <div class="row ">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="is_valid">Deskripsi Peminjaman</label>
                            <div class="input-group">
                            <select name="pinjam_id" id="desc_request" class="form-control"> 
                        <option value=""> Pilih </option>
                            @foreach($ket as $item)
                            <option value="{{$item->id}}">{{$item->desc_request}}</option>
                            @endforeach
                        </select>
                            </div>
                        </div>
                    </div>
               
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nominal">Tanggal Disetujui </label>
                                <input name="accepted_at" class="form-control input-sm text-left" 
                                type="date" required>
                        </div>
                    </div>
                    </div>
                   
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="file">Asal Desa</label>
                            <div class="input-group">
                            <select name="viilage" id="village" class="form-control"> 
                                <option value=""> Pilih Desa</option>
                                @foreach($desa as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="is_valid">Status</label>
                            <div class="input-group">
                            <select name="status" id="status" class="form-control"> 
                                <option value="Pilih">Pilih</option>
                                <option value="2">Accepted</option>
                                <option value="3">Reject</option>
                             </select>
                            </div>
                        </div>
                    </div>
                </div><br>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="note_internal">Agen Pengguna</label>
                            <textarea class="form-control" id="textAreaExample3" rows="5" name="user_agen" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="note_internal">Note</label>
                            <textarea class="form-control" id="textAreaExample3" rows="7" name="note_internal" required></textarea>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-cloud-upload-alt">
                            </i>&nbsp;&nbsp;&nbsp;Submit
                        </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop