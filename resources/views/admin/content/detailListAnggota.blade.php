@extends('admin.index')

@section('body')
<div class="content">
        <div class="row">
          <div class="col">
          <h4 style="margin-left:15px;"> Detail Data List Kelompok </h4>
            <div class="card demo-icons" style="margin-top:20px;">
            <div class="card-header">
       
        <form action="{{url('admin/detail-list-anggota/'.$listAnggota->id)}}" style="padding-top: 5px">
            @csrf
            <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Nama Kelompok</label>
                        <input type="text" name="name" id="name" 
                        value="{{$listAnggota->name}}" 
                      class="form-control" disabled>
                      </div>
                    </div>
                  </div>

            <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Group</label>
                        <input type="text" name="group_id" id="group_id" 
                        value="{{$listAnggota->group_id}}" 
                      class="form-control" disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                      <label>Wakaf Preneur</label>
                        <input name="duta_name" class="form-control" id="duta_name" 
                        value="<?php
                        use App\Models\group_anggota;
                         $x= $listAnggota->duta_wakaf_id;
                         $y= $listAnggota->id;
                          //dd($y);
                          $listAnggota=group_anggota::where('id',$y)->where('duta_wakaf_id', $x)->first();
                          //dd($listAnggota);
                          if ($listAnggota){
                          $res=DB::select("select duta_name as name
                          from pa_duta_wakaf JOIN jf_group_anggota
                          ON pa_duta_wakaf.id=jf_group_anggota.duta_wakaf_id
                          
                          WHERE jf_group_anggota.duta_wakaf_id='$x' && jf_group_anggota.id='$y'");
                          //dd($res);
                          $charData="";
                          foreach($res as $list){
                            $charData.=$list->name;
                          }
                          $arr=rtrim($charData);
                          //dd($charData);
                          echo $charData;
                        }else{
                          return back();
                        }          
                        ?>" type="text"  disabled>
                      </div>
                    </div>
                      </div>
                    
                    <div class="row">
                    <div class="col">
                      <div class="form-group">
                      <label>Status</label>
                        <input name="duta_name" class="form-control" id="duta_name" 
                        value="<?php
                        $t=$listAnggota->status == 0;
                        $q=$listAnggota->status == 1;
                        $w=$listAnggota->status == 2;
                        $e=$listAnggota->status == 3;
                        if($t){
                          echo "TIDAK AKTIF";
                         }else if($q){
                          echo "AKTIF";
                         }else if($w){
                          echo "FREEZE";
                         }else{
                          echo "PENDING";
                         }?>" type="text"  disabled>
                     </div>
                    </div>
                  </div>
@endsection