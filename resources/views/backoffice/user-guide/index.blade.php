@extends('adminlte::page')

@section('title', 'User Guide')

@section('content_header_title','Settings')
@section('content_header_prev_link','/')
@section('content_header_prev_text','Halaman Depan')

@section('content')
    <form class="card">
        <div class="card-header d-flex align-items-center">
            <h3 class="card-title">Petunjuk Penggunaan Go-Fund</h3>
        </div>

        <div class="card-body">
            <div id="accordion">
                <h3>Akses Halaman</h3>
                <div class="card">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#login">
                            Login
                        </a>
                    </div>
                    <div id="login" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <p>1. Akses halaman Login Anggota Go-Fund <a href="{{ url('/') }}" target="_blank" class="text-decoration-none">disini</a>.</p>
                                </div>
                                <div class="col-6">
                                    <p class="text-justify">2. Masukkan alamat e-mail dan password yang telah terdaftar dan tekan tombol masuk.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <img src="{{ asset('img/static/user-guide/login.PNG') }}" width="350" height="400" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}">
                                </div>
                                <div class="col-6">
                                    <img src="{{ asset('img/static/user-guide/login-fill.PNG') }}" width="350" height="400" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="Masukkan alamat e-mail dan password">
                                </div>
                            </div>
                        </div>
                        <hr class="bord-no pad-all">
                    </div>
                </div>

                <h3>Dashboard</h3>
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#dashboard">
                            Halaman Grafik & Chart
                        </a>
                    </div>
                    <div id="dashboard" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menampilkan Chart dan Grafik data kelompok dan individu, akses halaman <a href="{{ url('/anggota/dashboard') }}" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\gratifikasi.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Keterangan Gambar:</p>
                            <ol>
                                <li>Ajuan anda</li>
                                <li>Ajuan anda disetujui</li>
                                <li>Ajuan anggota</li>
                                <li>Ajuan anggota disetujui</li>
                                <li>Pinjaman aktif anda</li>
                                <li>Akumulasi anda</li>
                                <li>Pengumpulan dana wakaf pada kelompok ini</li>
                                <li>Peminjaman dana wakaf pada kelompok ini</li>
                                <li>Pinjaman aktif semua anggota</li>
                                <li>Akumulasi semuanya</li>
                            </ol>
                        </div>
                        <hr class="bord-no pad-all">
                    </div>
                </div>

                <h3>Peminjaman</h3>
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#riwayat-pinjam">
                            Riwayat Pinjam
                        </a>
                    </div>
                    <div id="riwayat-pinjam" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menampilkan list laporan gratifikasi yang diterima, akses halaman <a href="{{ env('APP_URL') }}/backoffice/gratifikasi" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\gratifikasi.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Keterangan Gambar:</p>
                            <ol>
                                <li></li>
                            </ol>
                        </div>
                        <hr class="bord-no pad-all">
                    </div>

                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#pengajuan-pinjam">
                            Pengajuan Pinjam
                        </a>
                    </div>
                    <div id="pengajuan-pinjam" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menampilkan list laporan benturan kepentingan yang diterima, akses halaman <a href="{{ env('APP_URL') }}/backoffice/conflict-interest" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\list-conflict-interests.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Keterangan Gambar:</p>
                            <ol>
                                <li></li>
                            </ol>
                            <hr class="bord-no pad-all">
                            <h5>Sunting Laporan Benturan Kepentingan</h5>
                            <p>Penyuntingan pada laporan hanya dapat dilakukan pada field status, tindak lanjut dan lampiran.</p>
                            <img src="\img\static\user-guide\edit-conflict-interest.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Keterangan Gambar:</p>
                            <ol>
                                <li></li>
                            </ol>
                        </div>
                    </div>
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#simulasi-pinjam">
                            Simulasi Pinjam
                        </a>
                    </div>
                    <div id="simulasi-pinjam" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menampilkan list laporan gratifikasi yang diterima, akses halaman <a href="{{ env('APP_URL') }}/backoffice/gratifikasi" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\gratifikasi.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Keterangan Gambar:</p>
                            <ol>
                                <li></li>
                            </ol>
                        </div>
                        <hr class="bord-no pad-all">
                    </div>
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#pinjaman-anggota-lain">
                            Pinjaman Anggota Lain
                        </a>
                    </div>
                    <div id="pinjaman-anggota-lain" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menampilkan list laporan gratifikasi yang diterima, akses halaman <a href="{{ env('APP_URL') }}/backoffice/gratifikasi" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\gratifikasi.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Keterangan Gambar:</p>
                            <ol>
                                <li></li>
                            </ol>
                        </div>
                        <hr class="bord-no pad-all">
                    </div>
                </div>

                <h3>Dana Bersama</h3>
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#statistik">
                            Statistik
                        </a>
                    </div>
                    <div id="statistik" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menampilkan list laporan gratifikasi yang diterima, akses halaman <a href="{{ env('APP_URL') }}/backoffice/gratifikasi" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\gratifikasi.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Keterangan Gambar:</p>
                            <ol>
                                <li></li>
                            </ol>
                        </div>
                        <hr class="bord-no pad-all">
                    </div>

                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#peruntukan">
                            Peruntukan
                        </a>
                    </div>
                    <div id="peruntukan" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menampilkan list laporan benturan kepentingan yang diterima, akses halaman <a href="{{ env('APP_URL') }}/backoffice/conflict-interest" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\list-conflict-interests.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Keterangan Gambar:</p>
                            <ol>
                                <li></li>
                            </ol>

                            <hr class="bord-no pad-all">
                            <h5>Sunting Laporan Benturan Kepentingan</h5>
                            <p>Penyuntingan pada laporan hanya dapat dilakukan pada field status, tindak lanjut dan lampiran.</p>
                            <img src="\img\static\user-guide\edit-conflict-interest.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Keterangan Gambar:</p>
                            <ol>
                                <li></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
        </div>
    </form>
@endsection
