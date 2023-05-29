@extends('admin.layout.main')

@section('title', 'Admin')

@section('css-tracking')
<style>
.hh-grayBox {
	background-color: #F8F8F8;
	margin-bottom: 20px;
	padding: 35px;
  margin-top: 20px;
}
.pt45{padding-top:45px;}
.order-tracking{
	text-align: center;
	width: 16.66%;
	position: relative;
	display: block;
}
.order-tracking .is-complete{
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
.order-tracking.completed .is-complete{
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
.order-tracking p span{font-size: 12px;}
.order-tracking.completed p{color: #000;}
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
.order-tracking:first-child:before{display: none;}
.order-tracking.completed:before{background-color: #FFAF26;}

</style>
@endsection

@section('body')
<div class="content">
    <div class="pl-2 pt-2">
        <h4 class="p-2">Data Pengajuan Pinjam <span class="text-muted">(Admin Section)</span></h4>
        <form action="{{ url('admin/filterajuan/filterajuan') }}">
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Peminjam</label>
                        </div>
                        <select class="custom-select" id="select_peminjam" name="peminjam">
                            <option selected>Choose...</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Kelompok</label>
                        </div>
                        <select class="custom-select" id="select_kelompok" name="kelompok">
                            <option selected>Choose...</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Status</label>
                        </div>
                        <select class="custom-select" id="status" name="status">
                            <option selected>Choose...</option>
                            <option> Request </option>
                            <option> Accepted </option>
                            <option> Cancel </option>
                            <option> Reject </option>
                        </select>
                    </div>
                </div>
                <div>
                    <button id="filter" type="submit" class="btn btn-md btn-outline-info">Filter</button>
                </div>
            </div>
        </form>
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


    <script type="text/JavaScript" src=" https://MomentJS.com/downloads/moment.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>

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
            // orderCellsTop: true,
            // fixedHeader: true,
            // initComplete: function() {
            //     var api = this.api();

            //     // For each column
            //     api
            //         .columns()
            //         .eq(0)
            //         .each(function(colIdx) {
            //             // Set the header cell to contain the input element
            //             var cell = $('.filters th').eq(
            //                 $(api.column(colIdx).header()).index()
            //             );
            //             var title = $(cell).text();
            //             $(cell).html('<input type="text" placeholder="Cari ' + title + '" />');

            //             // On every keypress in this input
            //             $(
            //                     'input',
            //                     $('.filters th').eq($(api.column(colIdx).header()).index())
            //                 )
            //                 .off('keyup change')
            //                 .on('change', function(e) {
            //                     // Get the search value
            //                     $(this).attr('title', $(this).val());
            //                     var regexr = '({search})'; //$(this).parents('th').find('select').val();

            //                     var cursorPosition = this.selectionStart;
            //                     // Search the column for that value
            //                     api
            //                         .column(colIdx)
            //                         .search(
            //                             this.value != '' ?
            //                             regexr.replace('{search}', '(((' + this.value + ')))') :
            //                             '',
            //                             this.value != '',
            //                             this.value == ''
            //                         )
            //                         .draw();
            //                 })
            //                 .on('keyup', function(e) {
            //                     e.stopPropagation();

            //                     $(this).trigger('change');
            //                     $(this)
            //                         .focus()[0]
            //                         .setSelectionRange(cursorPosition, cursorPosition);
            //                 });
            //         });
            // },
            initComplete: function() {
                this.api()
                    // .columns()
                    // .every(function() {
                        var that = this;

                        $('input').on('keyup change clear', function() {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        });
                    // });
            },
            aaSorting: [[ 4, "desc" ]],
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url : "{{ route('admin.pengajuanpinjam.pengajuanpinjam') }}",
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
                        return '<i class="fa fa-clock text-danger"></i>&nbsp&nbsp&nbsp' + 'Rp&nbsp' + row.nominal_request.toLocaleString('id-ID') + '</br>' + '<i class="fa fa-check-circle text-success"></i>&nbsp&nbsp&nbsp' + 'Rp&nbsp' + row.nominal_accepted.toLocaleString('id-ID');
                    },
                    name: 'nominal_request',
                    orderable: true,
                    searchable: false
                },
                {
                    render: function(data, type, row) {
                        if (row.status == 'request') {
                            return '<span class="badge badge-secondary badge-pill">Request</span>' + '</br>' + row.tenor + ' ' + 'Bulan';
                        } else if (row.status == 'accepted') {
                            return '<span class="badge badge-success badge-pill">Accepted</span>' + '</br>' + row.tenor + ' ' + 'Bulan';
                        } else if (row.status == 'cancel') {
                            return '<span class="badge badge-warning badge-pill">Cancel</span>' + '</br>' + row.tenor + ' ' + 'Bulan';
                        } else if (row.status == 'reject') {
                            return '<span class="badge badge-danger badge-pill">Reject</span>' + '</br>' + row.tenor + ' ' + 'Bulan';
                        }
                    },
                    name: 'status',
                    orderable: true,
                    searchable: true
                },
                {
                    "data": null,
                    render: function(data, type, row, meta) {
                        return 'Total&nbsp' + ":&nbsp" + "Rp&nbsp" + row.cicilan_perbulan.toLocaleString('id-ID') + '</br>' +
                            'Pokok&nbsp' + ":&nbsp" + "Rp&nbsp" + row.cicilan_pokok.toLocaleString('id-ID') + '</br> ' + 'Modharabah&nbsp' + ":&nbsp" + "Rp&nbsp" + row.cicilan_modharabah.toLocaleString('id-ID');
                    },
                    orderable: true,
                    searchable: true
                },
                {
                    render: function(data, type, row, meta) {
                        return 'Mengajukan&nbsp' + ":&nbsp" + moment(row.created_at).format('DD-MM-YYYY');
                    },
                    orderable: true,
                    searchable: true
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

    {{-- <script>
        $(document).ready(function() {
            $('#myTable2 thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#myTable2 thead');
        })
    </script> --}}

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
                        url: "{{URL::to('admin/hapuspengajuanpinjam')}}" + "/" + id,
                        data: {
                            id: id,
                            _token: "{{csrf_token()}}"
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
                                            $('#myTable').val(json.lastInput);
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
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            let $this = $(this);
            var id = $(this).data('id');
            console.log(id);
            $('#AddAproveModal').modal('show');
            $.ajax({
                    type: "get",
                    url: "{{URL::to('admin/edit-pengajuanpinjam')}}" + "/" + id,
                    success: function(response) {
                        console.log(response);
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
                ('#submit').click(function(e) {
                    e.preventDefault();
                    var form = $(this).serialize();
                    var url = $(this).attr('action');
                    console.log(url);
                    $.POST(url, form, function(data) {
                        $('#AddAproveModal').modal('show');
                        showMember();
                    })
                });
        });
    </script>

    <script>
        function fetch_res() {
            $.ajax({
                url: "{{URL::to('admin/filter-std-peminjam')}}",
                type: "get",
                //dataType: "json",
                success: function(data) {
                    //console.log(data);
                    data.data.forEach((data) => {
                        let sentence = ` ${data.duta_name}`;
                        //console.log(sentence);
                        stdBody = `<option value="${data.duta_name}">${data.duta_name}</option>`;
                    });
                    $('#select_peminjam').append(stdBody);
                }
            })
        };
        fetch_res();

        function fetch_std() {
            $.ajax({
                url: "{{URL::to('admin/filterlistanggota')}}",
                type: "get",
                //dataType: "json",
                success: function(data) {
                    console.log(data);
                    data.data.forEach((data) => {
                        let sentence = ` ${data.name}`;
                        //console.log(sentence);
                        stdBody = `<option value="${data.name}">${data.name}</option>`;
                    });
                    $('#select_kelompok').append(stdBody);
                }
            })
        };
        fetch_std();
    </script>

    <script>
        $(document).on('click', '.detail-ajuan', function(e) {
            e.preventDefault();
            let $this = $(this);
            var id = $(this).data('id');
            console.log(id);
            $('#add-pinjam-modal').modal('show');
            $.ajax({
                    type: "get",
                    url: "{{URL::to('admin/detail-request-pinjam-anggota')}}" + "/" + id,
                    success: function(response) {
                        console.log(response.data.data_pinjam);
                        console.log(response.data.data_pinjam_approval);
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

                            if (response.data.data_pinjam.nominal_accepted != null) {
                                $('#nominal_accepted').val('Rp. ' + response.data.data_pinjam.nominal_accepted.toLocaleString('id-ID'));
                            } else {
                                $('#nominal_accepted').val('Rp. 0');
                            }
                            $('#status_next').val(response.data.data_pinjam.status);

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

                            $('#is-valid').html('');
                            $('#is-invalid').html('');
                        }
                    }
            });
        });
    </script>

    <div class="modal fade" id="add-pinjam-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                            <input type="text" class="form-control" name="name_requester" id="name_requester" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="group_anggota" class="col-form-label">Kelompok : </label>
                            <input type="text" class="form-control" name="group_anggota" id="group_anggota" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                            <label for="nominal_request" class="col-form-label">Nominal Pengajuan : </label>
                            <input type="text" class="form-control" name="nominal_request" id="nominal_request" disabled>
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
                            <input type="text" class="form-control" name="status_now" id="status_now" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="desc_request" class="col-form-label">Keterangan : </label>
                                <input type="text" class="form-control" name="desc_request" id="desc_request" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="date_request" class="col-form-label">Diajukan Pada : </label>
                                <input type="text" class="form-control" name="date_request" id="date_request" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="cicilan_perbulan" class="col-form-label">Cicilan Perbulan : </label>
                                <input type="text" class="form-control" name="cicilan_perbulan" id="cicilan_perbulan" disabled>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label for="cicilan_pokok" class="col-form-label">Cicilan Pokok : </label>
                            <input type="text" class="form-control" name="cicilan_pokok" id="cicilan_pokok" disabled>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label for="cicilan_modharabah" class="col-form-label">Cicilan Mudharabah : </label>
                            <input type="text" class="form-control" name="cicilan_modharabah" id="cicilan_modharabah" disabled>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label for="total_mudharabah" class="col-form-label">Total Mudharabah : </label>
                            <input type="text" class="form-control" name="total_mudharabah" id="total_mudharabah" disabled>
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

                    <div class="row">
                        <div class="col-lg-10">
                            <h5 class="text-bold">Perijinan Anda <span class="text-muted text-small">(Admin)</span> :</h5>
                        </div>
                    </div>

                    <form action="javascript:void(0)" method="POST" enctype="multipart/form-data" name="form-add-approval" id="form-add-approval">
                    @csrf
                    <input class="form-control" name="pinjam_id" id="pinjam_id" type="hidden">

                    <div class="row" id="fill-table-status">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nominal_accepted" class="col-form-label">Nominal Disetujui : </label>
                                <input type="text" class="form-control" name="nominal_accepted" id="nominal_accepted" required>
                                {{-- <div id="nominal_accepted-validation" class="text-danger"></div> --}}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Update Status</label>
                                <select name="status_next" id="status_next" class="form-control" required>
                                    <option selected disabled>Pilih</option>
                                    <option value="request">Request</option>
                                    <option value="accepted">Accepted</option>
                                    <option value="cancel">Cancel</option>
                                    <option value="reject">Reject</option>
                                </select>
                                {{-- <div id="status-validation" class="text-danger"></div> --}}
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
                    </form>
                        {{-- <div class="col-lg-4">
                            <div class="form-group">
                                <label for="desc" class="col-form-label">Tanggal Disetujui : </label>
                                <input type="text" class="form-control" name="desc" id="desc">
                            </div>
                        </div> --}}
                    </div>
                    <div id="fill-note">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <div id="btn-simpan-perijinan">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="AddAproveModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Ajuan Pinjam</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{URL::to('admin/update-pengajuanpinjam')}}" id="editform">
                        @csrf
                        <input class="form-control" name="id" id="id" type="hidden"></input>
                        <input class="form-control" name="group_anggota_id" id="group_anggota_id" type="hidden"></input>
                        <div class="form-group">
                            <label>Nominal Ajuan</label>
                            <input class="form-control" name="nominal_request" id="nominal_request"></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Nominal Disetujui</label>
                            <input class="form-control" name="nominal_accepted" id="nominal_accepted" required></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Tenor</label>
                            <input class="form-control" name="tenor" id="tenor"></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Keterangan</label>
                            <input class="form-control" name="desc_request" id="desc_request"></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="request">Request</option>
                                <option value="accepted">Accepted</option>
                                <option value="cancel">Cancel</option>
                                <option value="reject">Reject</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Tanggal Disetujui</label>
                            <input class="form-control" name="accepted_hji_at" id="accepted_hji_at" type="date"></input>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="submit" class="btn btn-primary submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    var nominal_request = document.getElementById("nominal_accepted");
        nominal_request.addEventListener("keyup", function(e) {
            nominal_request.value = 'Rp. ' + formatRupiah(this.value);
            // console.log(Number(nominal_request.value.replace(/[^0-9\.]+/g,'').replace(/[.,]/g, '').replace('Rp. ', '')));
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

<script>
    $('#submit-btn').click(function(e) {
        e.preventDefault();
        $('#submit-btn').html('<i class="fa fa-spinner fa-spin"></i>');

        $.ajax({
            data: $('#form-add-approval').serialize(),
            url: "{{ URL::to('admin/update-approval-pinjam') }}",
            type: "POST",
            dataType: 'json',
            enctype: 'multipart/form-data',
            success: function(response) {
                console.log(response);
                if (response.status == 400) {
                    console.log('Error:', response);
                    $('#is-valid').html('');
                    $('#is-invalid').html(response.message);
                    $('#submit-btn').text('Save');
                } else {
                    $('#is-invalid').html('')
                    $('#is-valid').html(response.message);
                    $('#form-add-edit-approval').trigger('reset');
                    $('#submit-btn').text('Ok !');

                    window.setTimeout(function() {
                        $('#add-pinjam-modal').modal('hide');
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
