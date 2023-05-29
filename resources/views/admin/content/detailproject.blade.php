@extends('admin.index')

@section('body')
<div class="content">
        <div class="row">
          <div class="col">
          <h4 style="margin-left:15px;">Detail Data Project</h4>
            <div class="card demo-icons"  style="margin-top:20px;">
            <div class="card-header">
      
        <form action="{{url('admin/detail-project/'.$project->id)}}" style="padding-top: 10px">
            @csrf
            <div class="form-group">
                <label for="project_name" class="form-label">Nama Project</label>
                <input name="project_name" class="form-control" id="project_name" value="{{$project->project_name}}" type="text"  disabled>
            </div>
          
            <div class="form-group">
                <label for="project_description" class="form-label">Deskripsi Project</label>
                <textarea disabled name="project_description" class="form-control text-align:left" id="project_description"><?php echo strip_tags($project->project_description)?>
                </textarea>
            </div>

            <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Provinsi</label>
                        <input type="text" name="provinsi_id" 
                        value="<?php
                        use App\Models\ProjectModel;
                         $x= $project->provinsi_id;
                         $y= $project->id;
                          //dd($x);
                          $project=ProjectModel::where('id',$y)->where('provinsi_id', $x)->first();
                          //dd($duta_wakaf);
                          if ($project){
                          $res=DB::select("select name as prov 
                          from loc_provinces JOIN pa_project
                          ON loc_provinces.id=pa_project.provinsi_id
                          
                          WHERE pa_project.provinsi_id='$x' && pa_project.id='$y'");
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
                        ?>
                        " class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Kabupaten</label>
                        <input type="text" name="kabupaten_id" id="kabupaten_id" 
                        value="<?php
                         $r= $project->kabupaten_id;
                         $y= $project->id;
                          //dd($x);
                          $project=ProjectModel::where('id',$y)->where('kabupaten_id', $r)->first();
                          //dd($duta_wakaf);
                          if ($project){
                          $res=DB::select("select name as kab 
                          from loc_regencies JOIN pa_project
                          ON loc_regencies.id=pa_project.kabupaten_id
                          WHERE pa_project.kabupaten_id='$r' && pa_project.id='$y'");
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
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Kecamatan</label>
                        <input name="kecamatan_id" class="form-control" id="kecamatan_id" 
                        value="<?php
                         $r= $project->kecamatan_id;
                         $y= $project->id;
                          //dd($x);
                          $project=ProjectModel::where('id',$y)->where('kecamatan_id', $r)->first();
                          //dd($duta_wakaf);
                          if ($project){
                          $res=DB::select("select name as kec 
                          from loc_districts JOIN pa_project
                          ON loc_districts.id=pa_project.kecamatan_id
                          WHERE pa_project.kecamatan_id='$r' && pa_project.id='$y'");
                          //dd($res);
                          $charData="";
                          foreach($res as $list){
                            $charData.=$list->kec;
                          }
                          $arr=rtrim($charData);
                          echo $charData;
                        }else{
                          return back();
                        }          
                        ?>
                        " type="text"  disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                      <label for="project_document_name" class="form-label">Nama Dokumen Project</label>
                            <input name="project_document_name" class="form-control" id="project_document_name" value="{{$project->project_document_name}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>Tanggal Proyek</label>
                        <input name="project_date" class="form-control" id="project_date" value="{{$project->project_date}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>Proyek Hasend</label>
                        <input name="project_hasend" class="form-control" id="project_hasend" value="{{$project->project_hasend}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>Tanggal Proyek Berakhir</label>
                        <input name="project_date_end" class="form-control" id="project_date_end" value="{{$project->project_date_end}}" type="text"  disabled>
                      </div>
                    </div>
                  </div>


            <div class="row">
                    <div class="col">
                      <div class="form-group">
                      <label>has_abadi</label>
                        <input name="has_abadi" class="form-control" id="has_abadi" 
                        value="<?php
                          $d=$project->has_abadi;
                          //dd($d);
                          if ($d==1){
                            echo "YA";}
                            else if($d==0){
                              echo "TIDAK";
                            }
                        ?>" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group" >
                      <label>Target Project Abadi</label>
                        <input name="project_target_abadi" class="form-control text-left" id="project_target_abadi" 
                        value="<?php
                        //{{$project->project_target_berjangka}}
                        $a=$project->project_target_abadi;
                        //dd($o);
                        echo "Rp.",number_format($a);
                        ?>
                        "disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>has_kolektif</label>
                        <input name="has_kolektif" class="form-control" id="has_kolektif" 
                        value="<?php
                          $d=$project->has_kolektif;
                          //dd($d);
                          if ($d==1){
                            echo "YA";}
                            else if($d==0){
                              echo "TIDAK";
                            }
                        ?>
                        " type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>Target Project Kolektif</label>
                        <input name="project_target_kolektif" class="form-control" id="project_target_kolektif" 
                        value="<?php
                        //{{$project->project_target_berjangka}}
                        $k=$project->project_target_kolektif;
                        //dd($o);
                        echo "Rp.",number_format($k);
                        ?>
                        " type="text"  disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                      <label>has_berjangka</label>
                        <input name="has_berjangka" class="form-control" id="has_berjangka" 
                        value="<?php
                          $d=$project->has_berjangka;
                          //dd($d);
                          if ($d==1){
                            echo "YA";}
                            else if($d==0){
                              echo "TIDAK";
                            }
                        ?>
                        " type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>Target Proyek Berjangka</label>
                        <input name="project_target_berjangka" class="form-control" id="project_target_berjangka" 
                        value="<?php
                        //{{$project->project_target_berjangka}}
                        $o=$project->project_target_berjangka;
                        //dd($o);
                        echo "Rp.",number_format($o);
                        ?>
                        " type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>has_tabarru</label>
                        <input name="has_tabarru" class="form-control" id="has_tabarru" 
                        value="<?php
                          $d=$project->has_tabarru;
                          //dd($d);
                          if ($d==1){
                            echo "YA";}
                            else if($d==0){
                              echo "TIDAK";
                            }
                        ?>
                        " type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                      <label>Target Proyek Tabarru</label>
                        <input name="project_target_tabarru" class="form-control" id="project_target_tabarru" 
                        value=<?php
                        //{{$project->project_target_berjangka}}
                        $p=$project->project_target_tabarru;
                        //dd($o);
                        echo "Rp.",number_format($p);
                        ?>
                        " type="text"  disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>PIC Nazhir</label>
                        <input type="text" name="nazhir_pic_id" id="nazhir_pic_id" 
                        value="<?php
                         $o= $project->nazhir_id;
                         $p= $project->id;
                         // dd($o);
                          $project=ProjectModel::where('id',$p)->where('nazhir_id', $o)->first();
                          //dd($duta_wakaf);
                          if ($project){
                          $res=DB::select("select nazhir_pic as name 
                          from pa_nazhir JOIN pa_project
                          ON pa_nazhir.id=pa_project.nazhir_id
                          WHERE pa_project.nazhir_id='$o' && pa_project.id='$p'");
                          //dd($res);
                          $charData="";
                          foreach($res as $list){
                            $charData.=$list->name;
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
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                        <label>Mitra Nazhir</label>
                        <input name="mitra_nazhir_id" class="form-control" id="mitra_nazhir_id" 
                        value="{{$project->mitra_nazhir_id}}" type="number"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                        <label>PIC Mitra Nazhir</label>
                        <input name="mitra_nazhir_pic_id" class="form-control" id="mitra_nazhir_pic_id" value="{{$project->mitra_nazhir_pic_id}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                        <label>Kategori</label>
                        <input name="category_id" class="form-control" id="category_id" 
                        value="<?php
                         $r= $project->category_id;
                         $y= $project->id;
                          //dd($x);
                          $project=ProjectModel::where('id',$y)->where('category_id', $r)->first();
                          //dd($duta_wakaf);
                          if ($project){
                          $res=DB::select("select category_name as kat
                          from pa_category JOIN pa_project
                          ON pa_category.id=pa_project.category_id
                          WHERE pa_project.category_id='$r' && pa_project.id='$y'");
                          //dd($res);
                          $charData="";
                          foreach($res as $list){
                            $charData.=$list->kat;
                          }
                          $arr=rtrim($charData);
                          echo strip_tags($charData);
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
                        <label>Status Proyek</label>
                        <input name="project_status" class="form-control" id="project_status" value="{{$project->project_status}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                        <label>Disematkan</label>
                        <input name="is_pinned" class="form-control" id="is_pinned" value="{{$project->is_pinned}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                        <label>wr_priority</label>
                        <input name="wr_priority" class="form-control" id="wr_priority" value="{{$project->wr_priority}}" type="text"  disabled>
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                        <label>Quickaction Default</label>
                        <input name="is_quickaction_default" class="form-control" id="is_quickaction_default" value="{{$project->is_quickaction_default}}" type="text"  disabled>
                      </div>
                    </div>
                  </div>
        </form>
    </div>

</div>
@endsection