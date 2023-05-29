@extends('admin.layout.main')

@section('title', 'Detail')

@section('content_header_title', 'Detail Pengajuan Peminjaman')

@section('content_header')
    <h5 class="m-0 text-dark">Detail Pengajuan Peminjaman</h5>
@stop

@section('body')
    <div class="card" style="padding:20px;">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table id="detail-1" class="table table-hover table-striped table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Nominal Ajuan</th>
                                <th>Deskripsi Peminjaman</th>
                                <th>Tenor</th>
                                <th>Total Mudharabah</th>
                                <th>Cicilan</th>
                                <th>Tanggal</th>
                            </tr>

                            <tr>
                                <td>
                                    Rp. {{ number_format($data->nominal_request, 2, ',', '.') }}<br>
                                    <?php
                                    if ($data->status == 'request') {
                                        echo '<span class="badge badge-warning badge-pill">Request</span>';
                                    } elseif ($data->status == 'accepted') {
                                        echo '<span class="badge badge-success badge-pill">Accepted</span>';
                                    } elseif ($data->status == 'cancel') {
                                        echo '<span class="badge badge-secondary badge-pill">Cancel</span>';
                                    } else {
                                        echo '<span class="badge badge-danger badge-pill">Reject</span>';
                                    }
                                    ?>
                                </td>
                                <td>{{ $data->desc_request }}</td>
                                <td>{{ $data->tenor }} bulan</td>
                                <td>Rp. {{ number_format($data->total_mudharabah, 2, ',', '.') }}</td>
                                <td>
                                    Total <span class="text-bold">Rp. {{ number_format($data->cicilan_perbulan, 2, ',', '.') }}</span><br>
                                    Pokok <span class="text-bold">Rp. {{ number_format($data->cicilan_pokok, 2, ',', '.') }}</span><br>
                                    Mudharabah <span class="text-bold">Rp. {{ number_format($data->cicilan_modharabah, 2, ',', '.') }}</span>
                                </td>
                                <td>
                                    Mengajukan <span class="text-bold">{{ date('D, d M Y H:i', strtotime($data->created_at)) }}</span><br>
                                    Disetujui <span class="text-bold">{{ $data->accepted_at ? date('D, d M Y H:i', strtotime($data->accepted_at)) : '-' }}</span><br>
                                    Dana Cair <span class="text-bold">Rp. {{ number_format($data->nominal_accepted, 2, ',', '.') }}</span>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card" style="padding:20px;">
                <div class="card-header">
                    <h4 class="text-dark text-bold">Detail Approval</h4>
                </div>
                <div class="row pt-4">
                    <div class="col-lg-6">
                        <div class="card p-2">
                            <div class="card-header">
                                <h6 class="text-bold">Approval Anggota <span class="text-muted">({{ $data->amount_approval_other_anggota }}/{{ $data->amount_anggota }})</span> <span class="text-success pl-4"><i class="fa fa-check" aria-hidden="true"></i> {{ $data->other_anggota_acc }}</span> <span class="text-danger px-4"><i class="fa fa-times" aria-hidden="true"></i> {{ $data->other_anggota_reject }}</span> <span class="text-right">Poin : {{ $data->poin_other_anggota_approval }}</span></h6>
                            </div>
                            <div class="table-responsive pt-2">
                                <table id="tb_approval_anggota" class="table table-sm table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Approval By</th>
                                            <th>Tanggal Approval</th>
                                            <th>Status</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card p-2">
                                    <div class="card-header">
                                        <h6 class="text-bold">Approval Pendamping <span class="text-muted">({{ $data->amount_approval_by_pendamping }}/{{ $data->max_amount_approval_by_pendamping }})</span> <span class="text-success pl-4"><i class="fa fa-check" aria-hidden="true"></i> {{ $data->pendamping_acc }}</span> <span class="text-danger px-4"><i class="fa fa-times" aria-hidden="true"></i> {{ $data->pendamping_reject }}</span> <span class="text-right">Poin : {{ $data->poin_pendamping_approval }}</span></h6>
                                    </div>
                                    <div class="table-responsive pt-2">
                                        <table id="tb_approval_pendamping" class="table table-sm table-hover table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Approval By</th>
                                                    <th>Tanggal Approval</th>
                                                    <th>Status</th>
                                                    <th>Note</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card p-2">
                            <div class="card-header">
                                <h6 class="text-bold">Approval Nazhir <span class="text-muted">({{ $data->amount_approval_by_nazhir }}/{{ $data->max_amount_approval_by_nazhir }})</span>
                                    <?php
                                    if ($data->acc_or_reject_nazhir){
                                        if ($data->acc_or_reject_nazhir->status == 'accepted') {
                                            echo '<span class="text-success"><i class="fa fa-check" aria-hidden="true"></i></span>';
                                        } else if ($data->acc_or_reject_nazhir->status == 'reject') {
                                            echo '<span class="text-danger"><i class="fa fa-times" aria-hidden="true"></i></span>';
                                        } else {
                                            echo null;
                                        }
                                    } else {
                                        echo null;
                                    }
                                    ?>
                                </h6>
                            </div>
                            <div class="table-responsive pt-2">
                                <table id="tb_approval_nazhir" class="table table-sm table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Approval By</th>
                                            <th>Tanggal Approval</th>
                                            <th>Status</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card p-2">
                            <div class="card-header">
                                <h6 class="text-bold">Approval Admin <span class="text-muted">({{ $data->amount_approval_by_admin }}/{{ $data->max_amount_approval_by_admin }})</span>
                                <?php
                                if ($data->acc_or_reject_admin) {
                                    if ($data->acc_or_reject_admin->accepted_at != null && $data->acc_or_reject_admin->status == 'accepted') {
                                        echo '<span class="text-success"><i class="fa fa-check" aria-hidden="true"></i></span>';
                                    } else if ($data->acc_or_reject_admin->accepted_at != null && $data->acc_or_reject_admin->status == 'reject') {
                                        echo '<span class="text-danger"><i class="fa fa-times" aria-hidden="true"></i></span>';
                                    } else {
                                        echo null;
                                    }
                                } else {
                                    echo null;
                                }
                                ?>
                                </h6>
                            </div>
                            <div class="table-responsive pt-2">
                                <table id="tb_approval_admin" class="table table-sm table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nominal Disetujui</th>
                                            <th>Tanggal Approval</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-lg-12">
                        <div class="card p-2">
                            <div class="card-header">
                                <h6 class="text-bold">Total Poin : <span class="text-success pl-4"><i class="fa fa-check" aria-hidden="true"></i> Anggota : {{ $data->poin_other_anggota_approval }}</span> <span class="text-success pl-4"><i class="fa fa-check" aria-hidden="true"></i> Pendamping : {{ $data->poin_pendamping_approval }}</span>
                                    <span class="pl-4">Nazhir</span>
                                    <?php
                                    if ($data->acc_or_reject_nazhir) {
                                        if ($data->acc_or_reject_nazhir->status == 'accepted') {
                                            echo '<span class="text-success"><i class="fa fa-check" aria-hidden="true"></i></span>';
                                        } else if ($data->acc_or_reject_nazhir->status == 'reject') {
                                            echo '<span class="text-danger"><i class="fa fa-times" aria-hidden="true"></i></span>';
                                        } else {
                                            echo null;
                                        }
                                    } else {
                                        echo null;
                                    }

                                    ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col">
                <div class="card" style="padding:20px; width:auto">
                    <div class="card-header">
                        <h4>Detail Cicilan</h4>
                    </div>
                    <div class="card-header">
                        {{-- <div class="row">
                            <div class="col-lg-2">
                                <a href="javascript:void(0)" class="btn btn-success add-cicil" id="btn_bayar_cicil" role="button">Bayar Cicilan</a>
                            </div>
                        </div> --}}
                        <div class="row pt-2">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Pinjaman : </label>
                                    <input type="text" class="form-control" name="accepted" id="accepted" value="Rp. {{ number_format($data->data_accepted, 2, ',', '.') }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Dikembalikan : </label>
                                    <input type="text" class="form-control" name="returned" id="returned" value="Rp. {{ number_format($data->data_returned, 2, ',', '.') }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Kekurangan : </label>
                                    <input type="text" class="form-control" name="minus" id="minus" value="Rp. {{ number_format($data->data_minus, 2, ',', '.') }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive pt-2">
                        <table id="tb_data_cicilan" class="table table-hover table-striped table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nominal Cicilan</th>
                                    <th>Deskripsi Cicilan</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Status</th>
                                    <th>Note Admin</th>
                                    <th>Tanggal Approval</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add-cicilan-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-bold" id="header-modal"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST" id="form-add-cicilan" enctype="multipart/form-data">
                        @csrf
                        <input class="form-control" name="pinjam_id" id="pinjam_id" type="hidden">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Nominal : </label>
                                    <input type="text" class="form-control" name="nominal" id="nominal" placeholder="Masukkan nominal" required>
                                    <div id="nominal-validation" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Note : </label>
                                    <input type="text" class="form-control" name="note" id="note" placeholder="Masukkan note" required>
                                    <div id="note-validation" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="bukti_cicil" class="col-form-label">Bukti Cicil :</label>
                                    <input class="form-control" type="file" name="bukti_cicil" id="bukti_cicil">
                                    <div id="bukti_cicil-validation" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                {{-- <img src="{{ asset() }}" alt=""> --}}
                            </div>
                            <div id="is-valid" class="text-success text-bold">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" id="submit-btn" class="btn btn-success submit"></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="detail-cicilan-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-bold" id="header-modal-cicilan"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nominal_cicilan" class="col-form-label">Nominal : </label>
                                    <input type="text" class="form-control" name="nominal_cicilan" id="nominal_cicilan" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="created" class="col-form-label">Diajukan pada : </label>
                                    <input type="text" class="form-control" name="created" id="created" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="note_internal" class="col-form-label">Keterangan : </label>
                                    <input type="text" class="form-control" name="note_internal" id="note_internal" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="note_admin" class="col-form-label">Note admin : </label>
                                    <input type="text" class="form-control" name="note_admin" id="note_admin" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="approved" class="col-form-label">Approval pada : </label>
                                    <input type="text" class="form-control" name="approved" id="approved" disabled>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="status_cicilan" class="col-form-label">Status :</label>
                                    <input type="text" class="form-control" name="status_cicilan" id="status_cicilan" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="bukti_cicilan" class="col-form-label">Bukti Cicil :</label>
                                    <img class="img-thumbnail" id="bukti_cicilan" alt="" style="max-width: 200px; min-width: 150px; height: auto;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
    <script type="text/JavaScript" src=" https://MomentJS.com/downloads/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tambah skrip dibawah ini untuk polyfill -->
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=Intl.~locale.id"></script>

    <script>
        var status_pinjam = {!! json_encode($data->status) !!};
        var btn_bayar_cicil = document.getElementById('btn_bayar_cicil');

        if (status_pinjam != 'accepted') {
            btn_bayar_cicil.classList.add('disabled');
        } else {
            btn_bayar_cicil.classList.remove('disabled');
        }
    </script>

    <script>
        var nominal = document.getElementById("nominal");
            nominal.addEventListener("keyup", function(e) {
                nominal.value = 'Rp. ' + formatRupiah(this.value);
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }
    </script>

    {{-- datatable approval anggota --}}
    <script>
        var id = {!! json_encode($data->id) !!}
        const table_anggota = $('#tb_approval_anggota').DataTable({
            aaSorting: [
                [1, "desc"]
            ],
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ URL::to('anggota/list-detail-approval-anggota') }}" + "/" + id,
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    render: function(data, type, row, meta) {
                        return moment(row.accepted_at).format('ddd, D MMM YYYY HH:MM');
                    },
                },
                {
                    render: function(data, type, row) {
                        if (row.status == 'reject') {
                            return '<span class="badge badge-danger badge-pill">Reject</span>';
                        } else if (row.status == 'accepted') {
                            return '<span class="badge badge-success badge-pill">Accepted</span>';
                        } else {
                            return '<span class="badge badge-secondary badge-pill">Draft</span>';
                        }
                    }
                },
                {
                    data: 'note',
                    name: 'note'
                }
            ],
        });
    </script>

    {{-- datatable approval pendamping --}}
    <script>
        var id = {!! json_encode($data->id) !!}
        const table_pendamping = $('#tb_approval_pendamping').DataTable({
            aaSorting: [
                [1, "desc"]
            ],
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ URL::to('anggota/list-detail-approval-pendamping') }}" + "/" + id,
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    render: function(data, type, row, meta) {
                        return moment(row.accepted_at).format('ddd, D MMM YYYY HH:MM');
                    },
                },
                {
                    render: function(data, type, row) {
                        if (row.status == 'reject') {
                            return '<span class="badge badge-danger badge-pill">Reject</span>';
                        } else if (row.status == 'accepted') {
                            return '<span class="badge badge-success badge-pill">Accepted</span>';
                        } else {
                            return '<span class="badge badge-secondary badge-pill">Draft</span>';
                        }
                    }
                },
                {
                    data: 'note',
                    name: 'note'
                }
            ],
        });
    </script>

    {{-- datatable approval nazhir --}}
    <script>
        var id = {!! json_encode($data->id) !!}
        const table_nazhir = $('#tb_approval_nazhir').DataTable({
            aaSorting: [
                [1, "desc"]
            ],
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ URL::to('anggota/list-detail-approval-nazhir') }}" + "/" + id,
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    render: function(data, type, row, meta) {
                        return moment(row.accepted_at).format('ddd, D MMM YYYY HH:MM');
                    },
                },
                {
                    render: function(data, type, row) {
                        if (row.status == 'reject') {
                            return '<span class="badge badge-danger badge-pill">Reject</span>';
                        } else if (row.status == 'accepted') {
                            return '<span class="badge badge-success badge-pill">Accepted</span>';
                        } else {
                            return '<span class="badge badge-secondary badge-pill">Draft</span>';
                        }
                    }
                },
                {
                    data: 'note',
                    name: 'note'
                }
            ],
        });
    </script>

    {{-- datatable approval admin --}}
    <script>
        var id = {!! json_encode($data->id) !!}
        const table_admin = $('#tb_approval_admin').DataTable({
            aaSorting: [
                [1, "desc"]
            ],
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ URL::to('anggota/list-detail-approval-admin') }}" + "/" + id,
            columns: [{
                    "data": null,
                    render: function(data, type, row, meta) {
                        if (row.nominal_accepted) {
                            return 'Rp. ' + row.nominal_accepted.toLocaleString('id-ID')
                        } else {
                            return 'Rp. -'
                        }
                    },
                },
                {
                    render: function(data, type, row, meta) {
                        if (row.accepted_at) {
                            return moment(row.accepted_at).format('ddd, D MMM YYYY HH:MM');
                        } else {
                            return '-';
                        }
                    },
                },
                {
                    render: function(data, type, row) {
                        if (row.status == 'reject') {
                            return '<span class="badge badge-danger badge-pill">Reject</span>';
                        } else if (row.status == 'accepted') {
                            return '<span class="badge badge-success badge-pill">Accepted</span>';
                        } else {
                            return '<span class="badge badge-secondary badge-pill">Request</span>';
                        }
                    }
                }
            ],
        });
    </script>

    {{-- datatable data list cicilan --}}
    <script>
        var id = {!! json_encode($data->id) !!}
        const table_cicilan = $('#tb_data_cicilan').DataTable({
            aaSorting: [
                [2, "desc"]
            ],
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ URL::to('anggota/data-list-cicilan') }}" + "/" + id,
            columns: [
                {
                    "data": null,
                    render: function(data, type, row, meta) {
                        return 'Rp. ' + row.nominal.toLocaleString('id-ID')
                    },
                },
                {
                    name: 'desc_cicilan',
                    data: 'desc_cicilan'
                },
                {
                    render: function(data, type, row, meta) {
                        return moment(row.created_at).format('ddd, D MMM YYYY HH:MM');
                    },
                },
                {
                    render: function(data, type, row) {
                        if (row.status == 0) {
                            return '<span class="badge badge-danger badge-pill">Invalid</span>';
                        } else if (row.status == 1) {
                            return '<span class="badge badge-success badge-pill">Valid</span>';
                        } else {
                            return '<span class="badge badge-secondary badge-pill">Request</span>';
                        }
                    }
                },
                {
                    name: 'note_admin',
                    data: 'note_admin'
                },
                {
                    render: function(data, type, row, meta) {
                        return moment(row.approval_at).format('ddd, D MMM YYYY HH:MM');
                    },
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    autowidth: false
                }
            ],
        });
    </script>

    <script>
        var id = {!! json_encode($data->id) !!}
        $(document).on('click', '.add-cicil', function(e) {
            e.preventDefault();
            // let $this = $(this);
            // var id = $(this).data('id');
            $('#pinjam_id').val(id);
            $('#form-add-cicilan').trigger('reset');
            $('#header-modal').text('Add New Cicilan');
            $('#submit-btn').text('Add');
            $('#nominal-validation').html('')
            $('#note-validation').html('')
            $('#bukti_cicil-validation').html('')
            $('#is-valid').html('');
            $('#add-cicilan-modal').modal('show');
        });
    </script>

    <script>
        $(document).on('click', '.detail-cicilan', function(e) {
            e.preventDefault();
            let $this = $(this);
            var id = $(this).data('id');
            // console.log(id);
            $('#detail-cicilan-modal').modal('show');
            $.ajax({
                type: "get",
                url: "{{ URL::to('anggota/detail-cicilan') }}" + "/" + id,
                success: function(response) {

                    if (response.status != 200) {
                        $('#header-modal-cicilan').addClass('text-danger');
                        $('#header-modal-cicilan').text('Data Not Found ' + response.status + ' !');
                    } else {
                        var status = 'Request';
                        if (response.data.status == 0) {
                            status = 'Invalid';
                        } else if (response.data.status == 1) {
                            status = 'Valid';
                        };
                        $('#header-modal-cicilan').text('Detail Cicilan');
                        $('#nominal_cicilan').val('Rp. ' + response.data.nominal.toLocaleString('id-ID'));
                        $('#created').val(response.data.created_at.toLocaleString('id-ID'));
                        $('#note_internal').val(response.data.note_internal);
                        $('#note_admin').val(response.data.note_admin);
                        $('#approved').val(response.data.approval_at);
                        $('#status_cicilan').val(status);

                        var img_id = $('#bukti_cicilan');
                        var img_url = "{{ asset('img/bukti-cicilan/not-found.png') }}";
                        if (response.data.file) {
                            img_url = "{{ asset('img/bukti-cicilan') }}" + '/' + response.data.file;
                            img_id.attr('src', img_url);
                        } else {
                            img_id.attr('src', img_url);
                        }
                    }
                }
            });
        });
    </script>

    <script>
        $('#submit-btn').click(function(e) {
                e.preventDefault();
                $('#submit-btn').html('<i class="fa fa-spinner fa-spin"></i> Loading..');
                // $(this).text('');

                var form_data = new FormData($('#form-add-cicilan')[0]);
                form_data.append('bukti_cicil', $('#bukti_cicil')[0].files[0]);

                $.ajax({
                    data: form_data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: "{{ URL::to('anggota/create-cicilan') }}",
                    type: "POST",
                    dataType: 'json',
                    enctype: 'multipart/form-data',
                    success: function(response) {
                        console.log(response);
                        $('#nominal-validation').html('');
                        $('#note-validation').html('');
                        $('#bukti_cicil-validation').html('');
                        if (response.status == 400) {
                            console.log('Error:', response);
                            $('#nominal-validation').html(response.errors.nominal)
                            $('#note-validation').html(response.errors.note)
                            $('#bukti_cicil-validation').html(response.errors.bukti_cicil)
                            $('#submit-btn').text('Save');
                        } else {
                            $('#is-valid').html(response.message);
                            $('#form-add-cicilan').trigger('reset');

                            window.setTimeout(function() {
                                $('#add-cicilan-modal').modal('hide');
                                table_cicilan.draw();
                            }, 500);
                        }
                    }
                });
            });
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
@endsection
