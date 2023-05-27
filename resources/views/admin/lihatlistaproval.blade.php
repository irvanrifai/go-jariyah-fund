@extends('admin.index')

@section('header')
@stop

@section('content_judul')

@stop

@section('body')
<div class="content">
<div class="row" >

    <div class="col">
    <h4 class="m-0 text-dark" style="margin-top:20px;">Data Perizinan Anggota</h4>
    <div class="card demo-icons" style="margin-top:20px;">
            <div class="card-header">


        <table id="detail-3" class="table table-hover table-striped table-bordered">

            <thead class="thead-light" >
                <tr>
                    <th>Deskripsi Peminjaman</th>
                    <th>Tanggal Disetujui</th>
                    <th>Status</th>
                    <th>Note</th>
                </tr>
                @foreach ($aprove as $d)
                <tr>
                    <td>{{$d->de}}</td>
                    <td>{{Carbon\Carbon::parse($d->dt)->format('Y-m-d H:m')."WIB"}}</td>
                    <td>
                    <?php
                       if($d->status == 'reject'){
                        echo '<span class="badge badge-danger badge-pill">REJECT</span>';
                       }else {
                        echo '<span class="badge badge-success badge-pill">ACCEPTED</span>';
                       }?>
                    </td>
                    <td>{{$d->note}}</td>
                </tr>
                @endforeach
            </thead>
        </table>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
@endsection
