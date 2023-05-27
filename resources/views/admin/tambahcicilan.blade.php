@extends('admin.index')

@section('content_judul')
<h4 class="m-0 text-dark">Data Cicil</h4>
@stop

@section('body')
    <form action="{{ url('admin/tambahcicilan') }}" method="POST" enctype="multipart/form-data" name="formcicil">
      @csrf
        <div class="container-fluid p-1">
            <div class="card p-4">
            <div class="row ">
                    <div class="col">
                        <div class="form-group">
                            <label for="is_valid">Peminjaman</label>   
                            <select name="pinjam_id" id="desc_request" class="form-control"> 
                            <option value=""> Pilih </option>
                            @foreach($ket as $item)
                            <option value="{{$item->id}}">{{$item->desc_request}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="nominal">Nominal Bayar</label>
                            <input name="nominal" class="form-control input-sm text-left" type="text" id="nominal" required>
                        </div>
                    </div>
                </div>
                   
                <div class="row ">
                    <div class="col">
                        <div class="form-group">
                            <label for="file">Bukti Bayar</label></br>
                            <div class="input-group">
                            <input class="form-control" type="file" id="file" name="file">
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="row ">
                    <div class="col">
                        <div class="form-group">
                            <label for="is_valid">Status</label>
                            <input value="0" name="is_valid" class="form-control" id="is_valid">
                        </div>
                    </div>
                </div><br>

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

