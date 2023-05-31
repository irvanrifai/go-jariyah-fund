@extends('adminlte::page')

@section('title', 'Informasi')

@section('content_header_prev_link','/backoffice/posts')


@section('plugins.Summernote', true)

@section('content')

<b>
    <center>
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <lottie-player src="https://assets1.lottiefiles.com/private_files/lf30_ijglsbnf.json"  background="transparent"  speed="1"  style="width: 200px; height: auto;" loop autoplay></lottie-player>

        <p><h3>MOHON MAAF PENGAJUAN PINJAM BELUM DAPAT DILAKUKAN KEMBALI<h3></p>
    </center>
</b>
<center><h5>Silakan Menunggu Proses Pengajuan Pinjam Sebelumnya Selesai</h5></center>

    <style type="text/css">
.fa-custom {
color: #FFD700
}</style>
@stop
