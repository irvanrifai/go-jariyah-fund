@extends('admin.index')

@section('body')
<div class="content">
        <div class="row">
          <div class="col">
          <h4 class="m-0 text-dark">Detail Cicilan</h4>
            <div class="card demo-icons">
            <div class="card-header">
        
        <form action="{{url('detailcicil/'.$cicil->id)}}" method="post" style="padding-top: 5px">
            @csrf
            <div class="row">
                    <div class="col-4">
                      <div class="form-group">
                        <label>Nama Peminjam</label>
                        <input type="text" name="note_internal" id="note_internal" 
                        value="<?php 
                        $o= $cicil->pinjam_id;
                        $p= $cicil->id;
                        //dd($p);
                        $data=DB::table('jf_cicilan')->select(
                          //'jf_pinjam.*'
                          'pa_duta_wakaf.duta_name as oke'
                        )->where('jf_cicilan.id',$p)->where('jf_cicilan.pinjam_id', $o);
                       //dd($data);
                        $data=$data
                        ->join('jf_pinjam','jf_cicilan.pinjam_id', '=', 'jf_pinjam.id')
                        ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=','jf_group_anggota.id')
                        ->join('pa_duta_wakaf','jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')->get();
                        $charData="";
                        foreach($data as $list){
                          $charData.=$list->oke;
                        }
                        $arr=rtrim($charData);
                        echo $charData;    
                        ?>" class="form-control" disabled>
                      </div>
                    </div>

                    <div class="col-4">
                      <div class="form-group">
                        <label>Keterangan Pinjaman</label>
                        <input type="text" name="desc_request" id="desc_request" 
                        value="<?php
                        use App\Models\CicilanModel;
                         $o= $cicil->pinjam_id;
                         $p= $cicil->id;
                         // dd($o);
                          $cicil=CicilanModel::where('id',$p)->where('pinjam_id', $o)->first();
                          //dd($cicil);
                          if ($cicil){
                          $res=DB::select("select desc_request as oke
                          from jf_pinjam JOIN jf_cicilan
                          ON jf_pinjam.id=jf_cicilan.pinjam_id
                          WHERE jf_cicilan.pinjam_id='$o' && jf_cicilan.id='$p'");
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
                        ?>" class="form-control" disabled>
                      </div>
                    </div>
                    
                    <div class="col-4">
                      <div class="form-group">
                        <label>Status</label>
                        <input type="text" name="is_valid" id="is_valid" 
                        value="<?php 
                        $o=$cicil->is_valid;
                        //dd($o);
                          if ($o==0){
                           echo "TIDAK VALID";
                          }else{
                            echo "VALID";
                          }
                        ?>" class="form-control" disabled>
                      </div>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-4">
                      <div class="form-group">
                        <label>Nominal</label>
                        <input type="text" name="nominal" id="nominal" 
                        value="<?php
                        //{{$project->project_target_berjangka}}
                        $o=$cicil->nominal;
                        //dd($o);
                        echo "Rp.",number_format($o);
                        ?>" class="form-control" disabled>
                      </div>
                        </div>

                    <div class="col-4">
                      <div class="form-group">
                        <label>Tanggal Bayar</label>
                        <input type="text" name="created_at" id="created_at" value="{{$cicil->created_at}}" class="form-control" disabled>
                      </div>
                    </div>

                    <div class="col-4">
                      <div class="form-group">
                        <label>Tanggal Update</label>
                        <input type="text" name="updated_at" id="updated_at" value="{{$cicil->updated_at}}" class="form-control" disabled>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Note Internal</label>
                        <input type="text" name="note_internal" id="note_internal" value="{{$cicil->note_internal}}" class="form-control" disabled>
                      </div>
                    </div>
                </div>
              
                <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Bukti Bayar</label></br>
                        <!--<input type="text" name="fie" id="fie" value="{{$cicil->fie}}" class="form-control" disabled>-->
                        <!--<img src="../img/static/logo-utama.png">-->
                        <img src="/img/<?php echo $cicil->fie; ?>" height="300px" width="400px;">
                    </div>
                    </div>
                </div>
                
               
@endsection