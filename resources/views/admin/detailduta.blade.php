@extends('admin.index')

@section('body')
<div class="content">
        <div class="row">
          <div class="col">
          <h4 class="m-0 text-dark"  style="margin-left:15px;">Detail Data Duta Wakaf</h4>
            <div class="card demo-icons" style="margin-top:20px;">
            <div class="card-header">
       
        <form action="{{url('admin/detail-duta/'.$duta->id)}}" method="post" style="padding-top: 5px">
            @csrf
            <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Provinsi</label>
                        <input type="text" name="provinsi_id" id="provinsi_id" 
                        value="<?php
                        use App\Models\duta_wakaf;
                         $x= $duta->provinsi_id;
                         $y= $duta->id;
                          //dd($x);
                          $duta_wakaf=duta_wakaf::where('id',$y)->where('provinsi_id', $x)->first();
                          //dd($duta_wakaf);
                          if ($duta_wakaf){
                          $res=DB::select("select name as prov 
                          from loc_provinces JOIN pa_duta_wakaf
                          ON loc_provinces.id=pa_duta_wakaf.provinsi_id
                          
                          WHERE pa_duta_wakaf.provinsi_id='$x' && pa_duta_wakaf.id='$y'");
                          //dd($res);
                          $charData="";
                          foreach($res as $list){
                            $charData.=$list->prov;
                          }
                          $arr=rtrim($charData);
                          echo $charData;
                        }else{
                          return back();
                        }          
                        ?>" 
                        class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Kabupaten</label>
                        <input type="text" name="kabupaten_id" id="kabupaten_id" 
                        value="<?php
                         $r= $duta->kabupaten_id;
                         $y= $duta->id;
                          //dd($x);
                          $duta_wakaf=duta_wakaf::where('id',$y)->where('kabupaten_id', $r)->first();
                          //dd($duta_wakaf);
                          if ($duta_wakaf){
                          $res=DB::select("select name as kab 
                          from loc_regencies JOIN pa_duta_wakaf
                          ON loc_regencies.id=pa_duta_wakaf.kabupaten_id
                          WHERE pa_duta_wakaf.kabupaten_id='$r' && pa_duta_wakaf.id='$y'");
                          //dd($res);
                          $charData="";
                          foreach($res as $list){
                            $charData.=$list->kab;
                          }
                          $arr=rtrim($charData);
                          echo $charData;
                        }else{
                          return back();
                        }          
                        ?>" 
                      class="form-control" disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                      <label>Type Duta</label>
                        <input name="duta_type" class="form-control" id="duta_type" value="{{$duta->duta_type}}" type="number"  disabled>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                      <label>Wakaf Preneur</label>
                        <input name="duta_name" class="form-control" id="duta_name" value="{{$duta->duta_name}}" type="text"  disabled>
                     </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                      <label>Tempat Lahir</label>
                        <input name="duta_birth_place" class="form-control" id="duta_birth_place" 
                        value="<?php
                         $r= $duta->kabupaten_id;
                         $y= $duta->id;
                          //dd($x);
                          $duta_wakaf=duta_wakaf::where('id',$y)->where('kabupaten_id', $r)->first();
                          //dd($duta_wakaf);
                          if ($duta_wakaf){
                          $res=DB::select("select name as kab 
                          from loc_regencies JOIN pa_duta_wakaf
                          ON loc_regencies.id=pa_duta_wakaf.kabupaten_id
                          WHERE pa_duta_wakaf.kabupaten_id='$r' && pa_duta_wakaf.id='$y'");
                          //dd($res);
                          $charData="";
                          foreach($res as $list){
                            $charData.=$list->kab;
                          }
                          $arr=rtrim($charData);
                          echo $charData;
                        }else{
                          return back();
                        }          
                        ?>" 
                        " type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                      <label>Tanggal Lahir</label>
                        <input name="duta_birth" class="form-control" id="duta_birth" value="{{$duta->duta_birth}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                      <label>Username</label>
                        <input name="duta_username" class="form-control" id="duta_username" value="{{$duta->duta_username}}" type="text"  disabled>
                       </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Pendidikan Terakhir</label>
                        <input name="duta_last_education" class="form-control" id="duta_last_education" value="{{$duta->duta_last_education}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Tanggal Kelulusan</label>
                        <input name="bt_graduate_date" class="form-control" id="bt_graduate_date" value="{{$duta->bt_graduate_date}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Pekerjaan</label>
                        <input name="duta_job" class="form-control" id="duta_job" value="{{$duta->duta_job}}" type="text"  disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                      <label>Jenis Kelamin</label>
                        <input name="duta_gender" class="form-control" id="duta_gender" value="{{$duta->duta_gender}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>Nomor Handphone</label>
                        <input name="duta_phone" class="form-control" id="duta_phone" value="{{$duta->duta_phone}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>E-Mail</label>
                        <input name="duta_email" class="form-control" id="duta_email" value="{{$duta->duta_email}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>Kode Refferal</label>
                        <input name="duta_refcode" class="form-control" id="duta_refcode" value="{{$duta->duta_refcode}}" type="text"  disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                      <label>Nama Bank</label>
                        <input name="duta_bank_name" class="form-control" id="duta_bank_name" value="{{$duta->duta_bank_name}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>Cabang Bank</label>
                        <input name="duta_bank_branch" class="form-control" id="duta_bank_branch" value="{{$duta->duta_bank_branch}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>Nomor Rekening Bank</label>
                        <input name="duta_bank_account" class="form-control" id="duta_bank_account" value="{{$duta->duta_bank_account}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>Nama Rekening Bank Duta</label>
                        <input name="duta_bank_account_name" class="form-control" id="duta_bank_account_name" value="{{$duta->duta_bank_account_name}}" type="text"  disabled>
                      </div>
                    </div>
                  </div>
           
            <div class="form-group">
                <label for="duta_reason" class="form-label">Alasan</label>
                <textarea disabled name="duta_reason" class="form-control text-align:left">{{$duta->duta_reason}}
              </textarea>
            </div>
        </form>
    </div>

</div>
@endsection