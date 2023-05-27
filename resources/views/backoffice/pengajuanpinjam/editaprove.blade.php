@extends('adminlte::page')

@section('title', 'Edit Approval')

@section('content_header_title','Edit Approval')
@section('content_header_prev_link','/backoffice/')
@section('content_header_prev_text','Edit Approval')

@section('content_header')
<h4 class="m-0 text-dark">Edit Approval</h4>
@stop

@section('content')
<div class="content">
        <div class="row">
          <div class="col">
            <div class="card demo-icons">
            <div class="card-header">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                {!! implode('', $errors->all('<li>:message</li>')) !!}
            </div>
        @endif
        <form action="{{url('anggota/updateaprove/'.$aprove->id)}}" style="padding-top: 5px">
            @csrf
            <div class="row ">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="desc_request">Deskripsi Peminjaman</label>
                            <div class="input-group">
                            <select name="pinjam_id" id="desc_request" class="form-control"> 
                        <option value=""><?php 
                            use App\Models\jf_pinjam_approval;
                            $o= $aprove->pinjam_id;
                            $p= $aprove->id;
                            //dd($p);
                            $cicil=jf_pinjam_approval::where('id',$p)->where('pinjam_id', $o)->first();
                            //dd($cicil);
                            if ($cicil){
                            $res=DB::select("select desc_request as oke
                            from jf_pinjam JOIN jf_pinjam_approval
                            ON jf_pinjam.id=jf_pinjam_approval.pinjam_id
                            WHERE jf_pinjam_approval.pinjam_id='$o' && jf_pinjam_approval.id='$p'");
                            //dd($res);
                            $charData="";
                            foreach($res as $list){
                                $charData.=$list->oke;
                            }
                            $arr=rtrim($charData);
                            echo $charData;
                            }else{
                                return back();
                            }          
                        ?> </option>
                            @foreach($ket as $item)
                            <option value="{{$item->id}}">{{$item->desc_request}}</option>
                            @endforeach
                        </select>
                            </div>
                        </div></div>

                    <div class="col-6">
                      <div class="form-group">
                        <label> Asal Desa</label>
                        <div class="input-group">
                            <select name="group_anggota_id" id="group_anggota_id" class="form-control"> 
                        <option value=""> Pilih </option>
                            @foreach($des as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                            </div>
                        </div>
                    </div>
                </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                      <label>Tanggal Disetujui</label>
                        <input name="accepted_at" class="form-control" id="duta_name" 
                        value="{{$aprove->accepted_at}}" type="date">
                      </div>
                    </div>
                    
                    <div class="col-6">
                      <div class="form-group">
                      <label>Status</label>
                      <select name="status" id="status" class="form-control"> 
                      <option value="Pilih">Pilih</option>
                        <option value="2">Accepted</option>
                        <option value="3">Reject</option>
                    </select>
                      </div>
                    </div>
                      </div>
                      <div class="row">
                      <div class="col">
                      <button type="submit" class="btn btn-primary btn-block" style="margin-top: 30px;margin-bottom: 20px;">Simpan</button>
@endsection