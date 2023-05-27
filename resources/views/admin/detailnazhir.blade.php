@extends('admin.index')

@section('body')  
<div class="content">
        <div class="row">
          <div class="col">
          <h4 style="margin-left:15px;">Detail Data Nazhir</h4>
            <div class="card demo-icons" style="margin-top:20px;">
            <div class="card-header">
       
        <form action="{{url('admin/detail-nazhir/'.$nazhir->id)}}" style="padding-top: 10px">
            @csrf
            <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Provinsi</label>
                        <input type="text" name="provinsi_id" id="provinsi_id" value="
                        <?php
                        use App\Models\NazhirModel;
                         $x= $nazhir->provinsi_id;
                         $y= $nazhir->id;
                          //dd($x);
                          $nazhir=NazhirModel::where('id',$y)->where('provinsi_id', $x)->first();
                          //dd($duta_wakaf);
                          if ($nazhir){
                          $res=DB::select("select name as prov 
                          from loc_provinces JOIN pa_nazhir
                          ON loc_provinces.id=pa_nazhir.provinsi_id
                          
                          WHERE pa_nazhir.provinsi_id='$x' && pa_nazhir.id='$y'");
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
                        " class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Kabupaten</label>
                        <input type="text" name="kabupaten_id" id="kabupaten_id" value="
                        <?php
                         $r= $nazhir->kabupaten_id;
                         $y= $nazhir->id;
                          //dd($x);
                          $nazhir=NazhirModel::where('id',$y)->where('kabupaten_id', $r)->first();
                          //dd($duta_wakaf);
                          if ($nazhir){
                          $res=DB::select("select name as kab 
                          from loc_regencies JOIN pa_nazhir
                          ON loc_regencies.id=pa_nazhir.kabupaten_id
                          WHERE pa_nazhir.kabupaten_id='$r' && pa_nazhir.id='$y'");
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
                        ?>
                        " class="form-control" disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Alamat Nazhir</label>
                        <input name="nazhir_address" class="form-control" value="{{$nazhir->nazhir_address}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>PIC Nazhir</label>
                        <input name="nazhir_pic" class="form-control" value="{{$nazhir->nazhir_pic}}" type="text"  disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Kontak Nazhir</label>
                        <input name="nazhir_contact" class="form-control" value="{{$nazhir->nazhir_contact}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>E-Mail Nazhir</label>
                        <input name="nazhir_email" class="form-control" value="{{$nazhir->nazhir_email}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Website Nazhir</label>
                        <input name="nazhir_website" class="form-control" value="{{$nazhir->nazhir_website}}" type="text"  disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                      <label>Type Nazhir</label>
                        <input name="nazhir_type" class="form-control" value="{{$nazhir->nazhir_type}}" type="number"  disabled>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                      <label>Level nazhir</label>
                        <input name="nazhir_level" class="form-control" value="{{$nazhir->nazhir_level}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                      <label>Username</label>
                        <input name="nazhir_username" class="form-control" value="{{$nazhir->nazhir_username}}" type="text"  disabled>
                      </div>
                    </div>
                  </div>

                  
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                      <label>nazhir_va_abadi</label>
                        <input name="nazhir_va_abadi" class="form-control" value="{{$nazhir->nazhir_va_abadi}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>nazhir_va_berjangka</label>
                        <input name="nazhir_va_berjangka" class="form-control" value="{{$nazhir->nazhir_va_berjangka}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>Tanggal Akta Nazhir</label>
                        <input name="nazhir_akta_date" class="form-control" value="{{$nazhir->nazhir_akta_date}}" type="text"  disabled></div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label> Rekening Nazhir</label>
                        <input name="nazhir_account_bank" class="form-control" value="{{$nazhir->nazhir_account_bank}}" type="text"  disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                      <label>Deskripsi Nazhir</label>
                        <input name="nazhir_description" class="form-control" value="{{$nazhir->nazhir_description}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>Badan Hukum Nazhir</label>
                        <input name="nazhir_legal_entity" class="form-control" value="{{$nazhir->nazhir_legal_entity}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>Nama Nazhir</label>
                        <input name="nazhir_name" class="form-control" value="{{$nazhir->nazhir_name}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>Nomor Koorperasi</label>
                        <input name="coorperation_number" class="form-control" value="{{$nazhir->coorperation_number}}" type="text"  disabled>
                     </div>
                    </div>
                  </div>

            <div class="form-group">
                <label for="nazhir_activity" class="form-label">Aktivitas Nazhir</label>
                <textarea disabled name="nazhir_activity" class="form-control"  type="text">{{$nazhir->nazhir_activity}}
                </textarea>
            </div>
        </form>
    </div>
</div>
@endsection