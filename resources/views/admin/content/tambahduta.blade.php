@extends('admin.index')

@section('content_judul')
<h4 class="m-0 text-dark">Tambah Data Duta Wakaf</h4>
@stop

@section('body')
            <div class="card card-user">
              <div class="card-body">
                <form action="{{ url('admin/tambah-duta') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Provinsi</label>
                        <input type="text" class="form-control" name="provinsi" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Kabupaten</label>
                        <input type="text" class="form-control" name="kabupaten" placeholder="">
                      </div>
                    </div>
                  </div>

                 <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Duta_Type</label>
                        <input type="text" class="form-control" name="duta_type" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Parent_id</label>
                        <input type="text" class="form-control" name="parent_id" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Nama Nazhir</label>
                        <input type="text" class="form-control" name="nazhir" placeholder="">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" name="nik" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" placeholder="">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="text" class="form-control" name="tanggal_lahir" placeholder="">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" class="form-control" name="jenis_kelamin" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>No. Handphone</label>
                        <input type="text" class="form-control" name="nohp" placeholder="">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control" name="password" placeholder="">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Pendidikan Terakhir</label>
                        <input type="text" class="form-control" name="pendidikan_terakhir" placeholder="">
                      </div>
                    </div>
                    <!--<div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Tanggal Lulus</label>
                        <input type="text" class="form-control" name="tanggal_lulus" placeholder="">
                      </div>
                    </div>-->
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" class="form-control" name="pekerjaan" placeholder="">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Bank</label>
                        <input type="text" class="form-control" name="norek" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Cabang Bank</label>
                        <input type="text" class="form-control" name="name_pengguna_bank" placeholder="">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>No. Rekening</label>
                        <input type="text" class="form-control" name="norek" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Nama Pengguna Bank</label>
                        <input type="text" class="form-control" name="name_pengguna_bank" placeholder="">
                      </div>
                    </div>
                  </div>

                 <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Kode Referral</label>
                        <input type="text" class="form-control" name="refcode" placeholder="">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Alasan Bergabung</label>
                        <textarea class="form-control textarea" name="alasan"></textarea>
                      </div>
                    </div>
                  </div>

                 <!-- <div class="row">
                    <div class="col-md-12">
                        <label>Foto</label></br>
                        <input type="file" id="image" name="image">
                    </div>
                  </div>-->

                  <div class="row">
                    <div class="col-6">
                      <button type="submit" class="btn btn-primary btn-round">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endsection