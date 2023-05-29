@extends('admin.layout.main')

@section('title', 'Cicilan')

@section('body')
    <div class="content">
        <div class="pl-2 pt-2">
            <h4> Data Pengajuan Pinjam</h4>
            <form action="{{ url('admin/filterdata/filterdata') }}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Peminjam</label>
                            </div>
                            <select class="custom-select" id="select_std" name="duta_name">
                                <option selected>Choose...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Nominal</label>
                            </div>
                            <select class="custom-select" id="select_res" name="nominal">
                                <option selected>Choose...</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <button id="filter" type="submit" class="btn btn-md btn-outline-info">Filter</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card demo-icons" style="margin-top:20px;">
                    <div class="card-header">
                        <div class="table-responsive">
                            <table id="myTable1" class="table table-hover table-striped table-bordered table-hover"
                                style="margin-top:10px;width:auto;">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Peminjam</th>
                                        <th>Nominal Pinjaman</th>
                                        <th>Keterangan Cicilan</th>
                                        <th>Nominal Cicilan</th>
                                        <th>Status</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="AddAproveModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-bold" id="header-detail"></h3>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h5 class="text-bold">Data Pinjaman</h5>
                                </div>
                            </div>
                            <form action="javascript:void(0)" id="form-approve-cicilan">
                                @csrf
                                <input class="form-control" name="id" id="id" type="hidden">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Nama Peminjam : </label>
                                        <input class="form-control" name="name" id="name" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="request_date" class="col-form-label">Tanggal Mengajukan : </label>
                                        <input class="form-control" name="request_date" id="request_date" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="nominal_accepted" class="col-form-label">Nominal Ajuan Disetujui : </label>
                                        <input class="form-control" name="nominal_accepted" id="nominal_accepted" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="cicilan_perbulan" class="col-form-label">Nominal Cicilan Perbulan : </label>
                                        <input class="form-control" name="cicilan_perbulan" id="cicilan_perbulan" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="tenor" class="col-form-label">Tenor : </label>
                                        <input class="form-control" name="tenor" id="tenor" disabled>
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
                                    <h5 class="text-bold">Data Cicilan</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="nominal_cicilan" class="col-form-label">Nominal Cicilan : </label>
                                        <input class="form-control" name="nominal_cicilan" id="nominal_cicilan" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="payment_date" class="col-form-label">Tanggal Bayar : </label>
                                        <input class="form-control" name="payment_date" id="payment_date" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="note" class="col-form-label">Note : </label>
                                        <input class="form-control" name="note" id="note" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-lg-8">
                                    <label for="bukti_cicilan" class="col-form-label">Bukti Cicilan : </label>
                                    <img class="img-fluid" id="bukti_cicilan" alt="" style="max-width: 200px; min-width: 150px; height: auto;">
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="status" class="col-form-label">Status : </label>
                                            <select name="status" id="status" class="form-control">
                                                <option selected disabled value="">Pilih</option>
                                                <option value="1">Approve</option>
                                                <option value="0">Invalid</option>
                                                <option value="2" disabled>Request</option>
                                            </select>
                                            <div id="status-validation" class="text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="note_admin" class="col-form-label">Note : </label>
                                            <input class="form-control" name="note_admin" id="note_admin">
                                            <div id="note_admin-validation" class="text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="is-valid" class="text-success text-bold">
                            </div>
                            <div id="is-invalid" class="text-danger text-bold">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="submit-btn" class="btn btn-primary submit">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>

    <script type="text/JavaScript" src=" https://MomentJS.com/downloads/moment.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>

    <script>
        const table = $('#myTable1').DataTable({
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
                [0, "desc"]
            ],
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('admin.data-cicilan') }}",
            columns: [{
                    data: 'duta_name',
                    name: 'duta_name'
                },
                {
                    data: 'nominal_accepted',
                    name: 'nominal_accepted',
                    render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                },
                {
                    data: 'note_internal',
                    name: 'note_internal'
                },
                {
                    data: 'nominal',
                    name: 'nominal',
                    render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                },
                {
                    render: function(data, type, row) {
                        if (row.is_valid == 0) {
                            return '<span class="badge badge-danger badge-pill">Invalid</span>';
                        } else if (row.is_valid == 1) {
                            return '<span class="badge badge-success badge-pill">Approved</span>';
                        } else {
                            return '<span class="badge badge-secondary badge-pill">Need Approval</span>';
                        }
                    }
                },
                // {data:'note_internal', name:'note_internal'},
                {
                    render: function(data, type, row, meta) {
                        return moment(row.created_at).format('ddd, D MMM YYYY HH:MM');
                    },
                },
                //{data:'updated_at', name:'updated_at'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    // autowidth: true
                },
            ],
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.data').load("{{ URL::to('admin/filterdatatable') }}"); //ini
            $("#search").click(function() {
                var peminjam = $("#peminjam").val();
                var nominal = $("#nominal").val();
                $.ajax({
                    type: 'GET',
                    url: "{{ URL::to('admin/filterdatatable') }}", //ini
                    data: {
                        peminjam: peminjam,
                        nominal: nominal
                    },
                    success: function(hasil) {
                        $('.data').html(hasil);
                    }
                });
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
                        url: "{{ URL::to('admin/hapuscicil/') }}" + "/" + id,
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
                                        timer: 1500
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
        $(document).on('click', '.detail-cicilan', function(e) {
            e.preventDefault();
            let $this = $(this);
            var id = $(this).data('id');
            // console.log(id);
            $('#AddAproveModal').modal('show');
            $.ajax({
                    type: "get",
                    url: "{{ URL::to('admin/detail-cicilan') }}" + "/" + id,
                    success: function(response) {
                        console.log(response);
                        if (response.status != 200) {
                            $('#header-detail').addClass('text-danger');
                            $('#header-detail').text('Data Not Found ' + response.status + ' !');
                        } else {
                            $('#header-detail').text('Detail Cicilan');
                            $('#id').val(response.data.id);
                            $('#name').val(response.data.duta_name);
                            $('#nominal_accepted').val('Rp. ' + response.data.nominal_accepted.toLocaleString('id-ID'));
                            $('#cicilan_perbulan').val('Rp. ' + response.data.cicilan_perbulan.toLocaleString('id-ID'));
                            $('#tenor').val(response.data.tenor + ' bulan');
                            $('#request_date').val(response.data.request_date);
                            $('#payment_date').val(response.data.payment_date.toLocaleString('id-ID'));
                            $('#nominal_cicilan').val('Rp. ' + response.data.nominal_cicilan.toLocaleString('id-ID'));
                            $('#note').val(response.data.note_internal);
                            $('#status').val(response.data.is_valid);

                            $('#status-validation').html('');
                            $('#note_admin-validation').html('');
                            $('#is-valid').html('');
                            $('#is-invalid').html('');

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
                })
        });
    </script>

    <script>
        $('#submit-btn').click(function(e) {
            e.preventDefault();
            $('#submit-btn').html('<i class="fa fa-spinner fa-spin"></i> Loading..');

            $.ajax({
                data: $('#form-approve-cicilan').serialize(),
                url: "{{ URL::to('admin/updatecicilan') }}",
                type: "POST",
                dataType: 'json',
                enctype: 'multipart/form-data',
                success: function(response) {
                    console.log(response);
                    if (response.status == 400) {
                        console.log('Error:', response);
                        $('#status-validation').html(response.errors.status);
                        $('#note_admin-validation').html(response.errors.note_admin);
                        $('#is-valid').html('');
                        $('#is-invalid').html(response.message);
                        $('#submit-btn').text('Save');
                    } else {
                        $('#is-invalid').html('')
                        $('#is-valid').html(response.message);
                        $('#form-approve-cicilan').trigger('reset');
                        $('#submit-btn').text('Ok !');

                        window.setTimeout(function() {
                            $('#AddAproveModal').modal('hide');
                            table.draw();
                            $('#submit-btn').text('Simpan');
                        }, 500);
                    }
                }
            });
        });
    </script>

    <script>
        function fetch_std() {
            $.ajax({
                url: "{{ URL::to('admin/filter-std') }}",
                type: "get",
                //dataType: "json",
                success: function(data) {
                    //console.log(data);
                    data.data.forEach((data) => {
                        let sentence = ` ${data.duta_name}`;
                        //console.log(sentence);
                        stdBody = `<option value="${data.duta_name}">${data.duta_name}</option>`;
                    });
                    $('#select_std').append(stdBody);
                }
            })
        };
        fetch_std();

        function fetch_res() {
            $.ajax({
                url: "{{ URL::to('admin/filter-result') }}",
                type: "get",
                //dataType: "json",
                success: function(data) {
                    //console.log(data);
                    var resBody = '';
                    data.data.forEach((data) => {
                        let sentence = ` ${data.nominal}`;
                        //console.log(sentence);
                        resBody += `<option value="${data.nominal}">${data.nominal}</option>`;
                    });
                    $('#select_res').append(resBody);
                }
            });
        }
        fetch_res();

        function fetch(res, std) {
            $.ajax({
                url: "{{ URL::to('admin/fetch/fetch') }}",
                type: "get",
                //dataType: "json",
                data: {
                    std: std,
                    res: res
                },
                success: function(data) {
                    //console.log(data);
                }
            });
        }
        fetch()

        $(document).on("click", "#", function(e) {
            e.preventDefault();
            var std = $("#select_std").val();
            //console.log(std);
            var res = $("#select_res").val();
            //console.log(res);

            if (std != "" && res != "") {
                console.log(std);
                console.log(res);
                $('#myTable1').DataTable().destroy();
                fetch(std, res);
            } else if (std != "" && res == "") {
                $('#myTable1').DataTable().destroy();
                fetch(std, "");
            } else if (std == "" && res != "") {
                $('#myTable1').DataTable().destroy();
                fetch('', res);
            } else {
                $('#myTable1').DataTable().destroy();
                fetch();
            }
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
