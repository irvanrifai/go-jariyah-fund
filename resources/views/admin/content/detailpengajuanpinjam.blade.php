@extends('admin.index')

@section('header')
<meta charset="utf-8" />
  <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
 
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="/assets/demo/demo.css" rel="stylesheet" />
@stop

@section('body')
<div class="content">
        <div class="row">
          <div class="col">
          <h4 class="m-0 text-dark" style="margin-bottom:10px;">Detail Data Pinjaman</h4>
            <div class="card demo-icons" style="margin-top:20px;">
            <div class="card-header" >
        
        <form action="{{url('admin/detailpengajuanpinjam/'.$pinjam->id)}}" >
            @csrf
            <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Kelompok</label>
                        <input type="text" name="group_anggota_id" id="group_anggota_id" value="{{$pinjam->group_anggota_id}}" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Nominal Pengajuan</label>
                        <input type="text" name="nominal_request" id="nominal_request" 
                        value="<?php
                        $o=$pinjam->nominal_request;
                        //dd($o);
                        echo "Rp.",number_format($o);
                        ?>" class="form-control" disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                  <div class="col">
                      <div class="form-group">
                      <label>Nominal Disetujui</label>
                        <input name="nominal_accepted" class="form-control" 
                        value="<?php
                        $o=$pinjam->nominal_accepted;
                        //dd($o);
                        echo "Rp.",number_format($o);
                        ?>" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                      <label>status</label>
                        <input name="status" class="form-control" value="{{$pinjam->status}}" type="text"  disabled>
                    </div>
                  </div>
                  </div>
                  
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Tenor</label>
                        <input name="Tenor" class="form-control" value="{{$pinjam->tenor}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Total Mudharabah</label>
                        <input name="total_mudharabah" class="form-control" 
                        value="<?php
                        $o=$pinjam->total_mudharabah;
                        //dd($o);
                        echo "Rp.",number_format($o);
                        ?>" type="text"  disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                      <label>Cicilan Perbulan</label>
                        <input name="cicilan_perbulan" class="form-control" 
                        value="<?php
                        $o=$pinjam->cicilan_perbulan;
                        //dd($o);
                        echo "Rp.",number_format($o);
                        ?>" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                      <label>Cicilan Pokok</label>
                        <input name="cicilan_pokok" class="form-control" 
                        value="<?php
                        $o=$pinjam->cicilan_pokok;
                        //dd($o);
                        echo "Rp.",number_format($o);
                        ?>" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                      <label>Cicilan Modharabah</label>
                        <input name="cicilan_modharabah" class="form-control" 
                        value="<?php
                        $o=$pinjam->cicilan_modharabah;
                        //dd($o);
                        echo "Rp.",number_format($o);
                        ?>" type="text"  disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                      <label>accepted_hji_at</label>
                        <input name="accepted_hji_at" class="form-control" value="{{$pinjam->accepted_hji_at}}" type="text"  disabled>
                      </div>
                    </div>
                </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                      <label>Keterangan</label>
                        <input name="desc_request" class="form-control" value="{{$pinjam->desc_request}}" type="text"  disabled>
                      </div>
                    </div>
                    </div>
                  </div>
        </form>
    </div>
</div>
@endsection