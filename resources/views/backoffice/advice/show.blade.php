@extends('adminlte::page')

@section('title', 'Detail Saran')

@section('content_header_title','Detail Saran')
@section('content_header_prev_link','/backoffice/advice/')
@section('content_header_prev_text','Saran')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Saran: Detail</h3>

        <div class="card-tools btn-group mr-0">
            <a href="/backoffice/advice/" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Kembali ke Daftar Saran">
                <i class="far fa-arrow-alt-circle-left mr-1"></i> Kembali
            </a>
            <a href="/backoffice/advice/{{$saran->id}}/edit" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit Data Saran">
                <i class="far fa-edit mr-1"></i> Edit
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered">
            <tr>
                <th>Subjek</th>
                <td>{{ $saran->subject}}</td>
            </tr>
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $saran->name }}</td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td>{{ $saran->email}}</td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td>{{ $saran->telp}}</td>
            </tr>
            <tr>
                <th>Bobot Saran</th>
                <td>
                @php  
                    $status = $saran->status;
                    if($status == "draft"){  
                    echo  'Biasa';
                    };
                    if($status == "read"){  
                    echo  'Bagus';
                    };
                @endphp
                </td>
            </tr>
            <tr>
                <th>Keterangan Saran</th>
                <td>{!! $saran->text!!}</td>
            </tr>
        </table>
        <br>
        <div class="row">
            <div class="col">
                Dibuat pada : {{date_format($saran->created_at, "d M Y")}}, {{date_format($saran->created_at, "H:i")}}
            </div>
            <div class="col">
                 Diubah pada : {{date_format($saran->updated_at, "d M Y")}}, {{date_format($saran->updated_at, "H:i")}}
            </div>
            <div class="col">
                Perangkat :{{ $saran->user_agent}}
            </div>
        </div>
    </div>
</div>
@endsection
