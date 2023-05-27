@extends('adminlte::page')

@section('title', 'Bayar Cicilan')

@section('content_header_title','Bayar Cicilan')
@section('content_header_prev_link','/backoffice/posts')


@section('plugins.Summernote', true)

@section('content')
@if ($message = Session::get('success'))
<!-- Modal -->

{{-- <div class="modal fade d-block" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div> --}}
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif

    <form action="{{ url('anggota/tambahcicilan') }}" method="POST" enctype="multipart/form-data" name="formcicil">
        @csrf
        <?php $user=auth()->user()->id;
        //dd($user);
        $code=auth()->user()->duta_refcode;
        //dd($code);?>
        <div class="container-fluid p-1">
            <div class="card p-4">

            <div class="row ">
                    <div class="col">
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
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="nominal">Nominal Bayar</label>
                                <input onchange="myChangeFunction(this)" name="nominal" class="form-control input-sm text-left" 
                                type="text" id="nominal" required>
                        </div>
                    </div>
                    </div>
                   
                <div class="row ">
                    <div class="col">
                        <div class="form-group">
                            <label for="file">Bukti Bayar</label>
                            <div class="input-group">
                            <input class="form-control" type="file" min="0" max="15" id="file" name="file" required>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="row ">
                    <div class="col">
                        <div class="form-group">
                            <!--<label for="is_valid">Status</label>-->
                            <div class="input-group">
                            <input value="0" name="is_valid" class="form-control" id="is_valid" type="hidden">
                            </div>
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

