@extends('admin.layout.main')

@section('title', 'Pendamping')

@section('css-tracking')
    <style>
        .hh-grayBox {
            background-color: #F8F8F8;
            margin-bottom: 20px;
            padding: 35px;
            margin-top: 20px;
        }

        .pt45 {
            padding-top: 45px;
        }

        .order-tracking {
            text-align: center;
            width: 16.66%;
            position: relative;
            display: block;
        }

        .order-tracking .is-complete {
            display: block;
            position: relative;
            border-radius: 50%;
            height: 30px;
            width: 30px;
            border: 0px solid #AFAFAF;
            background-color: #A9A9A9;
            margin: 0 auto;
            transition: background 0.25s linear;
            -webkit-transition: background 0.25s linear;
            z-index: 2;
        }

        .order-tracking .is-complete:after {
            display: block;
            position: absolute;
            content: '';
            height: 14px;
            width: 7px;
            top: -2px;
            bottom: 0;
            left: 5px;
            margin: auto 0;
            border: 0px solid #AFAFAF;
            border-width: 0px 2px 2px 0;
            transform: rotate(45deg);
            opacity: 0;
        }

        .order-tracking.completed .is-complete {
            border-color: #FFAF26;
            border-width: 0px;
            background-color: #FFAF26;
        }

        .order-tracking.completed .is-complete:after {
            border-color: #fff;
            border-width: 0px 3px 3px 0;
            width: 7px;
            left: 11px;
            opacity: 1;
        }

        .order-tracking p {
            color: #A4A4A4;
            font-size: 14px;
            margin-top: 8px;
            margin-bottom: 0;
            line-height: 20px;
        }

        .order-tracking p span {
            font-size: 12px;
        }

        .order-tracking.completed p {
            color: #000;
        }

        .order-tracking::before {
            content: '';
            display: block;
            height: 3px;
            width: calc(100% - 40px);
            background-color: #A9A9A9;
            top: 13px;
            position: absolute;
            left: calc(-50% + 20px);
            z-index: 0;
        }

        .order-tracking:first-child:before {
            display: none;
        }

        .order-tracking.completed:before {
            background-color: #FFAF26;
        }
    </style>
@endsection

@section('body')
    <div class="content">
        <div class="pl-2 pt-2">
            <h4 class="p-2">Data Pengajuan Pinjam <span class="text-muted">(Pendamping Section)</span></h4>
        </div>
        <div class="card demo-icons" style="margin-top:20px;">
            <div class="card-body">
                <div class="table-responsive">

                    <table id="myTable2" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nominal Ajuan</th>
                                <th>Keterangan</th>
                                <th>Cicilan</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    {{-- detail modal include form input(if doesn't exist) or table approval(if exist), button edit, button delete --}}
    <div class="modal fade" id="add-edit-pinjam-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-bold" id="header-detail-request"></h3>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name_requester" class="col-form-label">Nama Peminjam : </label>
                                    <input type="text" class="form-control" name="name_requester" id="name_requester"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="group_anggota" class="col-form-label">Kelompok : </label>
                                    <input type="text" class="form-control" name="group_anggota" id="group_anggota"
                                        disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nominal_request" class="col-form-label">Nominal Pengajuan : </label>
                                    <input type="text" class="form-control" name="nominal_request"
                                        id="nominal_request" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="tenor" class="col-form-label">Tenor : </label>
                                    <input type="text" class="form-control" name="tenor" id="tenor" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="status_now" class="col-form-label">Status saat ini : </label>
                                    <input type="text" class="form-control" name="status_now" id="status_now"
                                        disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="desc_request" class="col-form-label">Keterangan : </label>
                                    <input type="text" class="form-control" name="desc_request" id="desc_request"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="date_request" class="col-form-label">Diajukan Pada : </label>
                                    <input type="text" class="form-control" name="date_request" id="date_request"
                                        disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="cicilan_perbulan" class="col-form-label">Cicilan Perbulan : </label>
                                    <input type="text" class="form-control" name="cicilan_perbulan"
                                        id="cicilan_perbulan" disabled>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="cicilan_pokok" class="col-form-label">Cicilan Pokok : </label>
                                    <input type="text" class="form-control" name="cicilan_pokok"
                                        id="cicilan_pokok" disabled>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="cicilan_modharabah" class="col-form-label">Cicilan Mudharabah :
                                    </label>
                                    <input type="text" class="form-control" name="cicilan_modharabah"
                                        id="cicilan_modharabah" disabled>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="total_mudharabah" class="col-form-label">Total Mudharabah : </label>
                                    <input type="text" class="form-control" name="total_mudharabah"
                                        id="total_mudharabah" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row py-1">
                            <div class="col-lg-12 hh-grayBox pt45 pb20">
                                <h5 class="text-bold text-center pb-4">Tracking Pinjaman</h5>
                                <div class="row justify-content-between">
                                    <div id="mark-request-start" class="order-tracking">
                                        <span class="is-complete"></span>
                                        <p>Request Pinjaman<br>
                                            <span id="time-request-start"></span>
                                        </p>
                                    </div>
                                    <div id="mark-app-anggota" class="order-tracking">
                                        <span class="is-complete"></span>
                                        <p>Approval Anggota<br>
                                            <span id="time-app-anggota"></span>
                                        </p>
                                    </div>
                                    <div id="mark-app-pendamping" class="order-tracking">
                                        <span class="is-complete"></span>
                                        <p>Approval Pendamping<br>
                                            <span id="time-app-pendamping"></span>
                                        </p>
                                    </div>
                                    <div id="mark-app-nazhir" class="order-tracking">
                                        <span class="is-complete"></span>
                                        <p>Approval Nazhir<br>
                                            <span id="time-app-nazhir"></span>
                                        </p>
                                    </div>
                                    <div id="mark-app-admin" class="order-tracking">
                                        <span class="is-complete"></span>
                                        <p>Approval Admin<br>
                                            <span id="time-app-admin"></span>
                                        </p>
                                    </div>
                                    <div id="mark-request-complete" class="order-tracking">
                                        <span class="is-complete"></span>
                                        <p>Pinjaman Siap<br>
                                            <span id="time-request-complete"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <hr>
                            </div>
                        </div>

                        <form action="#" method="POST" enctype="multipart/form-data" name="form-add-edit-approval" id="form-add-edit-approval">
                        @csrf
                        <input class="form-control" name="pinjam_id" id="pinjam_id" type="hidden">
                        <div class="row">
                            <div class="col-lg-10">
                                <h5 class="text-bold">Perijinan Anda <span
                                        class="text-muted text-small">(Pendamping)</span> :</h5>
                            </div>
                        </div>

                        <div class="row" id="fill-table-status">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="pendamping_id" class="col-form-label">Approved By</label>
                                    <select name="pendamping_id" id="pendamping_id" class="form-control" required>
                                        <option value="" selected disabled>Pilih</option>
                                    </select>
                                    <div id="pendamping-validation" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="status_next" class="col-form-label">Update Status</label>
                                    <select name="status_next" id="status_next" class="form-control">
                                        <option selected disabled value="">Pilih</option>
                                        <option value="accepted">Accepted</option>
                                        <option value="cancel">Cancel</option>
                                        <option value="reject">Reject</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="note" class="col-form-label">Note</label>
                                    <input type="text" class="form-control" name="note" id="note">
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <label for="submit-btn" class="col-form-label d-sm-none d-sm-block">Action </label>
                                    <button type="submit" class="btn btn-info" id="submit-btn" style="color:white;" title='Add Approval'>
                                        <i class='fas fa-plus'></i>
                                    </button>
                                </div>
                            </div>
                            <div id="is-valid" class="text-success text-bold">
                            </div>
                            <div id="is-invalid" class="text-danger text-bold">
                            </div>
                        </div>
                        </form>
                        <div class="row">
                            <div class="col-lg-12" id="table-data-approval">
                                <div class="pl-2 pt-2">
                                    <h6>Data Approval<span class="text-muted"> By Pendamping</span></h6>
                                </div>
                                <div class="card demo-icons" style="margin-top:20px;">
                                    <div class="card-body">
                                        <table id="table-data-approval" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Status</th>
                                                    <th>Note</th>
                                                    <th>Waktu Approval</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="content-data-approval">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" id="submit-btnm" class="btn btn-primary edit-approval">Submit</button> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- edit approval pinjam --}}
    <div class="modal fade" id="EditApprovalModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-bold" id="header-modal"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="form-add-edit-approval">
                    @csrf
                    <input class="form-control" name="id" id="id" type="hidden">
                        <div class="form-group">
                            <label for="pendamping_id" class="col-form-label">Approved By</label>
                            <select name="pendamping_id" id="pendamping_id" class="form-control" required>
                                <option>Pilih</option>
                            </select>
                            <div id="pendamping-validation" class="text-danger"></div>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Status : </label>
                            <select name="status_next" id="status_next" class="form-control">
                                <option selected disabled value="">Pilih</option>
                                <option value="accepted">Accept</option>
                                <option value="reject">Reject</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Note : </label>
                            <input type="text" class="form-control" name="note" id="note" placeholder="Masukkan note" required>
                            <div id="note-validation" class="text-danger"></div>
                        </div>
                        <div id="is-valid" class="text-success">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" id="submit-btmn" class="btn btn-primary submit">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/JavaScript" src=" https://MomentJS.com/downloads/moment.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

@section('js_plugins')
<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-sorting/datetime-moment.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.js') }}"></script>
@endsection

<script>
const table = $('#myTable2').DataTable({
    initComplete: function() {
        this.api()
        var that = this;
        $('input').on('keyup change clear', function() {
            if (that.search() !== this.value) {
                that.search(this.value).draw();
            }
        });
    },
    aaSorting: [
        [4, "desc"]
    ],
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: {
        url: "{{ route('admin.approval-pendamping.data-approve') }}",
        type: "GET"
    },
    columns: [{
            render: function(data, type, row, meta) {
                return row.duta_name + '</br>' + 'Group : ' + row.name;
            },
            name: 'duta_name',
            orderable: true,
            searchable: true
        },
        {
            render: function(data, type, row) {
                if (row.nominal_accepted == null) {
                    row.nominal_accepted = '-';
                }
                return '<i class="fa fa-clock text-danger"></i>&nbsp&nbsp&nbsp' + 'Rp&nbsp' + row
                    .nominal_request.toLocaleString('id-ID') + '</br>' +
                    '<i class="fa fa-check-circle text-success"></i>&nbsp&nbsp&nbsp' + 'Rp&nbsp' +
                    row.nominal_accepted.toLocaleString('id-ID');
            },
            name: 'nominal_request',
            orderable: true,
            searchable: false
        },
        {
            render: function(data, type, row) {
                if (row.status == 'request') {
                    return '<span class="badge badge-secondary badge-pill">Request</span>' +
                        '</br>' + row.tenor + ' ' + 'Bulan';
                } else if (row.status == 'accepted') {
                    return '<span class="badge badge-success badge-pill">Accepted</span>' +
                        '</br>' + row.tenor + ' ' + 'Bulan';
                } else if (row.status == 'cancel') {
                    return '<span class="badge badge-warning badge-pill">Cancel</span>' + '</br>' +
                        row.tenor + ' ' + 'Bulan';
                } else if (row.status == 'reject') {
                    return '<span class="badge badge-danger badge-pill">Reject</span>' + '</br>' +
                        row.tenor + ' ' + 'Bulan';
                }
            },
            name: 'status',
            orderable: true,
            searchable: true
        },
        {
            "data": null,
            render: function(data, type, row, meta) {
                return 'Total&nbsp' + ":&nbsp" + "Rp&nbsp" + row.cicilan_perbulan.toLocaleString(
                        'id-ID') + '</br>' +
                    'Pokok&nbsp' + ":&nbsp" + "Rp&nbsp" + row.cicilan_pokok.toLocaleString(
                    'id-ID') + '</br> ' + 'Modharabah&nbsp' + ":&nbsp" + "Rp&nbsp" + row
                    .cicilan_modharabah.toLocaleString('id-ID');
            },
            orderable: true,
            searchable: true
        },
        {
            render: function(data, type, row, meta) {
                return 'Mengajukan&nbsp' + ":&nbsp" + moment(row.created_at).format('DD-MM-YYYY');
            },
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
            //width : '100%',
            //autowidth: false
        },
    ],
});
</script>

<script>
    $(document).ready(function(){
        $('#pendamping_id').select2({
            theme: 'bootstrap4',
            placeholder: "--Pilih Pendamping--",
            allowClear: true,
            ajax: {
                url: "{{ route('admin.approval-pendamping.select2-pendamping') }}",
                delay: 100,
                data: function (params) {
                    var query = {
                        search: params.term,
                        page: params.page || 1
                    }
                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function (data, params) {
                    var items = $.map(data.data, function(obj){
                        obj.id   = obj.id;
                        obj.text = obj.name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                            return letter.toUpperCase();
                        });
                        return obj;
                    });
                    params.page = params.page || 1;

                    // console.log(items);
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: items,
                        pagination: {
                            more: params.page < data.last_page
                        }
                    };
                },
            }
        });
    });
</script>

<script>
$(document).on('click', '.hapus', function() {
    let id = $(this).attr('data-id')
    Swal.fire({
        title: 'Anda Yakin?',
        // text: "You won't be able to revert this!",
        icon: 'question',
        cancelButtonText: 'Tidak',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: "{{ URL::to('admin/hapuspengajuanpinjam') }}" + "/" + id,
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res, status) {
                    // console.log(res);
                    if (status = '200') {
                        setTimeout(() => {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Berhasil',
                                showConfirmButton: false,
                                timer: 1000
                            }).then((res) => {
                                table.ajax.reload(function(json) {
                                    $('#myTable').val(json
                                        .lastInput);
                                });
                            })
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                }
            })
        }
    })
})
</script>

<script>
$(document).on('click', '.edit-approval', function(e) {
    e.preventDefault();
    let $this = $(this);
    // var id = $(this).data('id');
    // console.log(id);
    $('#EditApprovalModal').modal('show');
    $.ajax({
            type: "GET",
            url: "{{ URL::to('admin/edit-pengajuanpinjam') }}" + "/" + id,
            success: function(response) {
                // console.log(response);
                if (response.status == 404) {
                    $('#success_message').html("");
                    $('#success_message').addClass('alert alert-danger');
                    $('#success_message').text(response.message);
                } else {
                    $('#id').val(response.data[0].id);
                    $('#nominal_request').val(response.data[0].nominal_request);
                    $('#nominal_accepted').val(response.data[0].nominal_accepted);
                    $('#desc_request').val(response.data[0].desc_request);
                    $('#status').val(response.data[0].status);
                    $('#tenor').val(response.data[0].tenor / 12);
                    $('#group_anggota_id').val(response.data[0].group_anggota_id);
                }
            }
        })
});
</script>

<script>
$(document).on('click', '.detail-ajuan', function(e) {
    e.preventDefault();
    let $this = $(this);
    var id = $(this).data('id');
    // console.log(id);
    $('#add-edit-pinjam-modal').modal('show');
    $.ajax({
        type: "get",
        url: "{{ URL::to('admin/approval-pendamping/detail-request-pinjam-anggota') }}" + "/" + id,
        success: function(response) {
            // console.log(response.data.data_pinjam);
            // console.log(response.data.data_pinjam_approval);
            if (response.status != 200) {
                $('#header-detail-request').addClass('text-danger');
                $('#header-detail-request').text('Data Not Found ' + response.status + ' !');
            } else {
                $('#pinjam_id').val(id);
                $('#header-detail-request').text('Detail Request Pinjam');
                $('#name_requester').val(response.data.data_pinjam.name_requester);
                $('#group_anggota').val(response.data.data_pinjam.group_anggota_id);
                $('#nominal_request').val('Rp. ' + response.data.data_pinjam.nominal_request.toLocaleString('id-ID'));
                $('#tenor').val(response.data.data_pinjam.tenor + ' bulan');
                $('#status_now').val(response.data.data_pinjam.status);
                $('#desc_request').val(response.data.data_pinjam.desc_request);
                $('#date_request').val(response.data.data_pinjam.created_at.toLocaleString('id-ID'));
                $('#cicilan_perbulan').val('Rp. ' + response.data.data_pinjam.cicilan_perbulan.toLocaleString('id-ID'));
                $('#cicilan_pokok').val('Rp. ' + response.data.data_pinjam.cicilan_pokok.toLocaleString('id-ID'));
                $('#cicilan_modharabah').val('Rp. ' + response.data.data_pinjam.cicilan_modharabah.toLocaleString('id-ID'));
                $('#total_mudharabah').val('Rp. ' + response.data.data_pinjam.total_mudharabah.toLocaleString('id-ID'));

                // tracking
                if (response.data.data_tracking_pinjam) {
                    if (response.data.data_tracking_pinjam.step_1_complete_at) {
                        $('#time-request-start').html(response.data.data_tracking_pinjam.step_1_complete_at);
                        $('#mark-request-start').addClass('completed')
                    }
                    if (response.data.data_tracking_pinjam.step_2_complete_at) {
                        $('#time-app-anggota').html(response.data.data_tracking_pinjam.step_2_complete_at);
                        $('#mark-app-anggota').addClass('completed')
                    }
                    if (response.data.data_tracking_pinjam.step_3_complete_at) {
                        $('#time-app-pendamping').html(response.data.data_tracking_pinjam.step_3_complete_at);
                        $('#mark-app-pendamping').addClass('completed')
                    }
                    if (response.data.data_tracking_pinjam.step_4_complete_at) {
                        $('#time-app-nazhir').html(response.data.data_tracking_pinjam.step_4_complete_at);
                        $('#mark-app-nazhir').addClass('completed')
                    }
                    if (response.data.data_tracking_pinjam.step_5_complete_at) {
                        $('#time-app-admin').html(response.data.data_tracking_pinjam.step_5_complete_at);
                        $('#mark-app-admin').addClass('completed')
                    }
                    if (response.data.data_tracking_pinjam.step_6_complete_at) {
                        $('#time-request-complete').html(response.data.data_tracking_pinjam.step_6_complete_at);
                        $('#mark-request-complete').addClass('completed')
                    }
                } else {
                    if ($('#mark-request-start').hasClass('completed')){
                        $('#mark-request-start').removeClass('completed')
                    }
                    if ($('#mark-app-anggota').hasClass('completed')){
                        $('#mark-app-anggota').removeClass('completed')
                    }
                    if ($('#mark-app-pendamping').hasClass('completed')){
                        $('#mark-app-pendamping').removeClass('completed')
                    }
                    if ($('#mark-app-nazhir').hasClass('completed')){
                        $('#mark-app-nazhir').removeClass('completed')
                    }
                    if ($('#mark-app-admin').hasClass('completed')){
                        $('#mark-app-admin').removeClass('completed')
                    }
                    if ($('#mark-request-complete').hasClass('completed')){
                        $('#mark-request-complete').removeClass('completed')
                    }

                    $('#time-request-start').html('-');
                    $('#time-app-anggota').html('-');
                    $('#time-app-pendamping').html('-');
                    $('#time-app-nazhir').html('-');
                    $('#time-app-admin').html('-');
                    $('#time-request-complete').html('-');
                }

                // $('#status_next').val(response.data.data_pinjam.status);
                $('#is-invalid').html('')
                $('#is-valid').html('');
                $('#submit-btn').html('<i class="fas fa-plus"></i>');
                $('#pendamping_id').empty().trigger('change');
                $('#status_next').val('');
                $('#note').val('');
                $('#content-data-approval').html('');

                // parsing to table data approval
                var contentTable = '';
                $.each(response.data.data_pinjam_approval_pendamping, function (i, item) {
                    contentTable += '<tr><td>' + item.name +
                                    '</td><td>' + (item.status == 'reject' ? '<span class="badge badge-danger badge-pill">Reject</span>' : (item.status == 'accepted' ? '<span class="badge badge-success badge-pill">Accepted</span>' : (item.status == 'cancel' ? '<span class="badge badge-warning badge-pill">Cancel</span>' : '<span class="badge badge-secondary badge-pill">Draft</span>'))) +
                                    '</td><td>' + item.note +
                                    '</td><td>' + item.accepted_at +
                                    '</td><td>' + '<a role="button" class="btn-sm btn-warning edit-setting" style="color:white;" title="Edit" data-id="$key->id"><i class="fas fa-pen-fancy"></i></a>' +
                                    '</td></tr>';
                });
                $('#content-data-approval').append(contentTable);
            }
        }
    });
});

// datatable in modal (selected one)
    // const table = $('#table-data-approval').DataTable({
    //     initComplete: function() {
    //         this.api()
    //         var that = this;
    //         $('input').on('keyup change clear', function() {
    //             if (that.search() !== this.value) {
    //                 that.search(this.value).draw();
    //             }
    //         });
    //     },
    //     aaSorting: [
    //         [0, "desc"]
    //     ],
    //     processing: true,
    //     serverSide: true,
    //     responsive: true,
    //     ajax: {
    //         url: "{{ URL::to('admin/approval-pendamping/data-approval-selected') }}" + "/" + this.id,
    //         type: "GET"
    //     },
    //     columns: [
    //         {
    //             name: 'name',
    //             data: 'name',
    //             orderable: true,
    //             searchable: true
    //         },
    //         {
    //             render: function(data, type, row) {
    //                 if (row.status == 'request') {
    //                     return '<span class="badge badge-secondary badge-pill">Request</span>';
    //                 } else if (row.status == 'accepted') {
    //                     return '<span class="badge badge-success badge-pill">Accepted</span>';
    //                 } else if (row.status == 'cancel') {
    //                     return '<span class="badge badge-warning badge-pill">Cancel</span>';
    //                 } else if (row.status == 'reject') {
    //                     return '<span class="badge badge-danger badge-pill">Reject</span>';
    //                 }
    //             },
    //             name: 'status',
    //             orderable: true,
    //             searchable: true
    //         },
    //         {
    //             name:'note',
    //             data:'note',
    //         },
    //         {
    //             render: function(data, type, row, meta) {
    //                 return 'Disetujui pada' + moment(row.accepted_at).format('DD-MM-YYYY')
    //             },
    //             orderable: true,
    //             searchable: true
    //         },
    //         {
    //             data: 'action',
    //             name: 'action',
    //             orderable: false,
    //             searchable: false,
    //             //width : '100%',
    //             //autowidth: false
    //         },
    //     ],
    // });
</script>

<script>
    $('#submit-btn').click(function(e) {
        e.preventDefault();
        $('#submit-btn').html('<i class="fa fa-spinner fa-spin"></i>');

        $.ajax({
            data: $('#form-add-edit-approval').serialize(),
            url: "{{ URL::to('admin/approval-pendamping/create-update-approval-pinjam') }}",
            type: "POST",
            dataType: 'json',
            enctype: 'multipart/form-data',
            success: function(response) {
                console.log(response);
                if (response.status == 400) {
                    console.log('Error:', response);
                    $('#is-valid').html('');
                    $('#pendamping-validation').html(response.errors);
                    $('#is-invalid').html(response.message);
                    $('#submit-btn').text('Save');
                } else {
                    $('#is-invalid').html('')
                    $('#is-valid').html(response.message);
                    $('#pendamping_id').empty().trigger('change');
                    $('#form-add-edit-approval').trigger('reset');
                    $('#submit-btn').text('Ok !');

                    window.setTimeout(function() {
                        $('#add-edit-pinjam-modal').modal('hide');
                        table.draw();
                    }, 500);
                }
            }
        });
    });
</script>

<style>
    .dataTables_filter {
        text-align: right;
        margin-right: 15px;
        margin-top: 0px;
    }

    .demo-icons ul li {
        width: auto;
    }

    .dataTables_wrapper .dataTables_paginate {
        float: right;
        text-align: right;
    }
</style>
@endsection
