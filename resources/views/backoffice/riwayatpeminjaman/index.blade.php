@extends('adminlte::page')

@section('title', 'Riwayat Peminjaman')

@section('content_header_title','Riwayat Peminjaman')
@section('content_header_prev_link','/backoffice/')
@section('content_header_prev_text','Dashboard')

@section('content_header')
<h1 class="m-0 text-dark">Riwayat Peminjaman</h1>
@stop

@section('content')
<!--<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {{-- <table id="daftar-artikel-table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nominal</th>
                            <th>Keterangan</th>
                            <th>Sisa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody id="myTable">
                        <tr>
                             {{-- @foreach ($riwayat as $item)

                            @endforeach
                            <td>
                                Rp. 50.000.000 (pengajuan)<br>
                                Rp. 50.000.000 <span class="text-success font-weight-bold">(disetujui)</span>
                            </td>
                            <td>
                                23 Agustus 2020<br>
                                22 Agustus 2024
                            </td>
                            <td>
                                Rp. 50.000.000 <br>
                                Rp. 2.800.000/bulan
                            </td>
                            <td>
                                <a target="_blank" class="btn btn-link btn-sm text-info"
                                    href="/riwayatpeminjaman/view.blade.php" ><i class="fas fa-eye"></i>&nbsp;
                                    </a> &nbsp;
                                <a class="btn btn-link btn-sm text-primary"
                                    href="/edit.blade.php"><i class="fas fa-pen-fancy"></i>&nbsp;
                                    </a> &nbsp;
                            </td><br>
                        </tr>

                        {{-- <tr class="border-primary">
                            <td>
                                Rp. 50.000.000 (pengajuan) <br>
                                <span class="text-danger font-italic font-weight-bold">Dibatalkan</span>
                            </td>
                            <td>
                                23 Agustus 2020<br>
                                -
                            </td>
                            <td>
                                Rp. 50.000.000<br>
                                Rp. 2.800.000/bulan
                            </td>
                            <td>
                                <a target="_blank" class="btn btn-link btn-sm text-info"
                                    href="#" ><i class="fas fa-eye"></i>&nbsp;
                                    </a> &nbsp;
                                <a class="btn btn-link btn-sm text-primary"
                                    href="#"><i class="fas fa-pen-fancy"></i>&nbsp;
                                    </a> &nbsp;
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Rp. 50.000.000 (pengajuan)<br>
                                Menunggu <span class="text-danger font-weight-bold">8</span>/20 | HJI : <span class="font-italic">belum</span>
                            </td>
                            <td>
                                23 Agustus 2020<br>
                                22 Agustus 2024
                            </td>
                            <td>
                                Rp. 50.000.000<br>
                                Rp. 2.800.000/bulan
                            </td>
                            <td>
                                <a target="_blank" class="btn btn-link btn-sm text-info"
                                    href="#" ><i class="fas fa-eye"></i>&nbsp;
                                    </a> &nbsp;
                                <a class="btn btn-link btn-sm text-primary"
                                    href="#"><i class="fas fa-pen-fancy"></i>&nbsp;
                                    </a> &nbsp;
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Rp. 50.000.000 (pengajuan)<br>
                                <span class="text-danger font-italic font-weight-bold">Ditolak</span>
                            </td>
                            <td>
                                23 Agustus 2020<br>
                                22 Agustus 2024
                            </td>
                            <td>
                                Rp. 30.000.000<br>
                                Rp. 2.800.000/bulan
                            </td>
                            <td>
                                <a target="_blank" class="btn btn-link btn-sm text-info"
                                    href="#" ><i class="fas fa-eye"></i>&nbsp;
                                    </a> &nbsp;
                                <a class="btn btn-link btn-sm text-primary"
                                    href="#"><i class="fas fa-pen-fancy"></i>&nbsp;
                                    </a> &nbsp;
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Rp. 50.000.000 (pengajuan)<br>
                                Rp. 50.000.000 <span class="text-success font-weight-bold">(disetujui)</span>
                            </td>
                            <td>
                                23 Agustus 2020<br>
                                22 Agustus 2024
                            </td>
                            <td>
                                <span class="text-success font-italic font-weight-bold">LUNAS</span><br>
                                Rp. 2.800.000/bulan
                            </td>
                            <td>
                                <a target="_blank" class="btn btn-link btn-sm text-info"
                                    href="#" ><i class="fas fa-eye"></i>&nbsp;
                                    </a> &nbsp;
                                <a class="btn btn-link btn-sm text-primary"
                                    href="#"><i class="fas fa-pen-fancy"></i>&nbsp;
                                    </a> &nbsp;
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Rp. 50.000.000 (pengajuan)<br>
                                Rp. 50.000.000 <span class="text-success font-weight-bold">(disetujui)</span>
                            </td>
                            <td>
                                23 Agustus 2020<br>
                                22 Agustus 2024
                            </td>
                            <td>
                                Rp. 30.000.000<br>
                                Rp. 2.800.000/bulan
                            </td>
                            <td>
                                <a target="_blank" class="btn btn-link btn-sm text-info"
                                    href="#" ><i class="fas fa-eye"></i>&nbsp;
                                    </a> &nbsp;
                                <a class="btn btn-link btn-sm text-primary"
                                    href="#"><i class="fas fa-pen-fancy"></i>&nbsp;
                                    </a> &nbsp;
                            </td>
                        </tr>
                    </tbody>
                    </tbody>
                </table> --}}-->

                <table id="riwayat-table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nominal Ajuan</th>
                            <th>Keterangan</th>
                            <th>Nominal Disetujui</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@stop


@section('adminlte_css')
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/fc-3.3.2/fh-3.1.8/kt-2.6.1/r-2.2.7/rg-1.1.2/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.css" />
@stop

@section('adminlte_js')
<script type="text/javascript"
    src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/fc-3.3.2/fh-3.1.8/kt-2.6.1/r-2.2.7/rg-1.1.2/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.js">
    </script>
<script>
    const table = $('#riwayat-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('anggota.datapengajuanpinjam.dataajuan') }}",
        columns: [
            { data: 'nominal_request', name: 'nominal_request', width: "25%", render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ),orderable: false, searchable: false },
            { data: 'desc_request', name: 'desc_request', width: "25%"},
            { data: 'nominal_accepted', name: 'nominal_accepted', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ),orderable: false, searchable: true, width: "25%" },
            // { data: 'status', name: 'status', width: "5%", orderable: false, searchable: false },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: "20%"
            },
        ],
    });
</script>

@stop