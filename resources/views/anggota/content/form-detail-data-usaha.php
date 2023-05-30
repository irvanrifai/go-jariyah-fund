@extends('adminlte::page')
@section('title', 'Informasi')
@section('content_header_prev_link','/anggota/dashboard')
@section('plugins.Summernote', true)

@section('content')
<form action="{{ url('anggota/tambahpinjam') }}" method="POST" enctype="multipart/form-data" name="formpengajuan">
    @csrf
    <div class="container-fluid p-1">
        <div class="row">
            <div class="col-lg-8">
                <div class="card p-4">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input name="id" class="form-control input-sm text-left amount" value="{{ auth()->user()->id }}" type="hidden" id="id" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nominal_request">Nama Owner</label>
                                <input name="nominal_request" class="form-control input-sm text-left amount num_request" type="text" id="nominal_request" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nominal_request">Nama UMKM</label>
                                <input name="nominal_request" class="form-control input-sm text-left amount num_request" type="text" id="nominal_request" placeholder="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="nominal_request">Alamat UMKM</label>
                                <input name="nominal_request" class="form-control input-sm text-left amount num_request" type="text" id="nominal_request" placeholder="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="nominal_request">No Telepon</label>
                                <input name="nominal_request" class="form-control input-sm text-left amount num_request" type="text" id="nominal_request" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="nominal_request">Jenis Usaha</label>
                                <input name="nominal_request" class="form-control input-sm text-left amount num_request" type="text" id="nominal_request" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="nominal_request">Omset Usaha</label>
                                <input name="nominal_request" class="form-control input-sm text-left amount num_request" type="text" id="nominal_request" placeholder="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="nominal_request">Total dana usaha</label>
                                <input name="nominal_request" class="form-control input-sm text-left amount num_request" type="text" id="nominal_request" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="nominal_request">Dana sekarang</label>
                                <input name="nominal_request" class="form-control input-sm text-left amount num_request" type="text" id="nominal_request" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="nominal_request">Dana Pinjaman Dibutuhkan</label>
                                <input name="nominal_request" class="form-control input-sm text-left amount num_request" type="text" id="nominal_request" placeholder="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="nominal_request">Rincian Kebutuhan Dana</label>
                                <input name="nominal_request" class="form-control input-sm text-left amount num_request" type="text" id="nominal_request" placeholder="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nominal_request">Lama Pengembalian Pinjaman</label>
                                <input name="nominal_request" class="form-control input-sm text-left amount num_request" type="text" id="nominal_request" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nominal_request">Jumlah Pengembalian Per Bulan</label>
                                <input name="nominal_request" class="form-control input-sm text-left amount num_request" type="text" id="nominal_request" placeholder="0" required>
                            </div>
                        </div>
                    </div>
                    <h4>Dokumen detail data usaha</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nominal_request">Akta Pendirian Usaha</label>
                                <input name="nominal_request" class="form-control input-sm text-left amount num_request" type="file" id="nominal_request" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nominal_request">Nomor Pokok Wajib Pajak (NPWP)</label>
                                <input name="nominal_request" class="form-control input-sm text-left amount num_request" type="file" id="nominal_request" placeholder="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nominal_request">Nomor Induk Berusaha (NIB)</label>
                                <input name="nominal_request" class="form-control input-sm text-left amount num_request" type="file" id="nominal_request" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nominal_request">Pangan Industri Rumah Tangga (PIRT)</label>
                                <input name="nominal_request" class="form-control input-sm text-left amount num_request" type="file" id="nominal_request" placeholder="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nominal_request">Sertifikat Halal</label>
                                <input name="nominal_request" class="form-control input-sm text-left amount num_request" type="file" id="nominal_request" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nominal_request">Laporan Keuangan Usaha</label>
                                <input name="nominal_request" class="form-control input-sm text-left amount num_request" type="file" id="nominal_request" placeholder="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-cloud-upload-alt"></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@stop
