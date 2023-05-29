@extends('adminlte::page')

@section('title', 'Riwayat Peminjaman')

@section('content_header_title','Riwayat Peminjaman')
@section('content_header_prev_link','/anggota/dashboard')
@section('content_header_prev_text','Dashboard')

@section('content_header')
<h1 class="m-0 text-dark">Riwayat Peminjaman</h1>
@stop

@section('content')
<div class="card-header">
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table id="myTable" class="table table-hover table-striped table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Nominal Ajuan</th>
                            <th>Deskripsi Ajuan</th>
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
</div>

<div class="modal fade" id="edit-pinjaman-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-bold" id="header-modal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" method="POST" id="form-edit-pinjaman">
                @csrf
                <input class="form-control" name="id" id="id" type="hidden">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="form-group">
                            <label for="nominal_request" class="col-form-label">Nominal (min. <span class="text-muted" id="min_pinjam"></span>) : </label>
                            <input type="text" class="form-control num_request" name="nominal_request" id="nominal_request" required>
                            <div id="nominal_request-validation" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="tenor" class="col-form-label">Tenor (tahun) max. <span class="text-muted" id="max_tenor"></span> : </label>
                            <input type="text" class="form-control num_max_tenor" name="tenor" id="tenor" required>
                            <div id="tenor-validation" class="text-danger"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="max_pinjam" class="col-form-label">Max Pinjam : </label>
                            <input type="text" class="form-control" name="max_pinjam" id="max_pinjam" disabled>
                            {{-- <div id="max_pinjam-validation" class="text-danger"></div> --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="cicilan_perbulan" class="col-form-label">Cicilan Perbulan : </label>
                            <input type="text" value="0" class="form-control" name="cicilan_perbulan" id="cicilan_perbulan" disabled>
                            {{-- <div id="cicilan_perbulan-validation" class="text-danger"></div> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="desc_request" class="col-form-label">Keterangan : </label>
                            <input type="text" class="form-control" name="desc_request" id="desc_request" required>
                            <div id="desc_request-validation" class="text-danger"></div>
                        </div>
                    </div>
                </div>
                <div id="is-valid" class="text-success text-bold"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" id="submit-btn" class="btn btn-primary submit"></button>
            </div>
            </form>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
    <script type="text/JavaScript" src=" https://MomentJS.com/downloads/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const table = $('#myTable').DataTable({
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
            ajax: "{{ route('anggota.datapengajuanpinjam.ajuan') }}",
            columns: [{
                    render: function(data, type, row) {
                        if (row.nominal_accepted == null) {
                            row.nominal_accepted = '-';
                        }
                        return '<i class="fa fa-clock text-danger"></i>&nbsp&nbsp&nbsp' + 'Rp&nbsp' + row.nominal_request.toLocaleString('id-ID') + '</br>' + '<i class="fa fa-check-circle text-success"></i>&nbsp&nbsp&nbsp' + 'Rp&nbsp' + row.nominal_accepted.toLocaleString('id-ID');
                    },
                },
                {
                    data: 'desc_request',
                    name: 'desc_request'
                },
                {
                    render: function(data, type, row) {
                        if (row.status == 'request') {
                            return '<span class="badge badge-secondary badge-pill">Request</span>' + '</br>' + row.tenor + ' ' + 'Bulan';
                        } else if (row.status == 'accepted') {
                            return '<span class="badge badge-success badge-pill">Accepted</span>' + '</br>' + row.tenor + ' ' + 'Bulan';
                        } else if (row.status == 'cancel') {
                            return '<span class="badge badge-secondary badge-pill">Cancel</span>' + '</br>' + row.tenor + ' ' + 'Bulan';
                        } else {
                            return '<span class="badge badge-danger badge-pill">Reject</span>' + '</br>' + row.tenor + ' ' + 'Bulan';
                        }
                    },
                },
                {
                    "data": null,
                    render: function(data, type, row, meta) {
                        return 'Total&nbsp' + ":&nbsp" + "Rp&nbsp" + row.cicilan_perbulan.toLocaleString('id-ID') + '</br>' +
                            'Pokok&nbsp' + ":&nbsp" + "Rp&nbsp" + row.cicilan_pokok.toLocaleString('id-ID') + '</br> ' + 'Modharabah&nbsp' + ":&nbsp" + "Rp&nbsp" + row.cicilan_modharabah.toLocaleString('id-ID');
                    },
                },
                {
                    render: function(data, type, row, meta) {
                        return 'Mengajukan&nbsp' + ":&nbsp" + moment(row.created_at).format('ddd, D MMM YYYY HH:MM');
                    },

                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    //width : '100%',
                    autowidth: false
                },
            ],
        });
    </script>

    <script>
        var nominal_request = document.getElementById("nominal_request");
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

    <script type="text/javascript">
        $(function() {
            $(document).ready(function() {
                $("#nominal_request,#tenor").keyup(function() {
                    var cicilan_perbulan = 0;
                    var x = Number($("#nominal_request").val().replace(/[^0-9\.]+/g,'').replace(/[.,]/g, '').replace('Rp. ', ''))
                    var y = Number($("#tenor").val());
                    var tot = ((x / (y * 12)) * 5 / 100) + (x / (y * 12));

                    $('#cicilan_perbulan').val("Rp. " + tot.toLocaleString('id-ID'));
                });
            });
        });
    </script>

    <script>
        $(document).on('click', '.edit-pinjaman', function(e) {
            e.preventDefault();
            let $this = $(this);
            var id = $(this).data('id');
            // console.log(id);
            $('#nominal_request-validation').html('');
            $('#tenor-validation').html('');
            $('#desc_request-validation').html('');
            $('#is-valid').html('');
            $('#edit-pinjaman-modal').modal('show');
            $.ajax({
                type: "GET",
                url: "{{URL::to('anggota/edit-pinjaman')}}" + "/" + id,
                success: function(response) {
                    // console.log(response);

                    if (response.status == 404) {
                        $('#header-modal').text(response.message + ' ' + response.status + ' !');
                        $('#header-modal').addClass('text-danger');
                        $('#submit-btn').prop('disabled', true);
                        $('#submit-btn').text('Not found!');
                        $('#form-edit-pinjaman').trigger('reset');

                    } else if (response.status == 406) {
                        $('#header-modal').text(response.message + ' ' + response.status + ' !');
                        $('#header-modal').addClass('text-danger');
                        $('#submit-btn').prop('disabled', true);
                        $('#submit-btn').text('Access Resctricted!');
                        $('#form-edit-pinjaman').trigger('reset');

                    } else {
                        if ($('#submit-btn').prop('disabled', true)) {
                            $('#submit-btn').prop('disabled', false);
                        }
                        if ($('#header-modal').hasClass('text-danger')) {
                            $('#header-modal').removeClass('text-danger')
                        }

                        var max_pinjam = 'Rp. ' + response.data.max_pinjam.toLocaleString('id-ID');
                        var min_pinjam = 'Rp. ' + response.data.min_pinjam.toLocaleString('id-ID');
                        const max_tenor = response.data.max_tenor;
                        // static
                        $('#header-modal').text('Edit pinjaman');
                        $('#submit-btn').text('Update');
                        $('#min_pinjam').text(min_pinjam);
                        $('#max_tenor').text(max_tenor);

                        // dynamic
                        $('#id').val(id);
                        $('#nominal_request').val('Rp. ' + response.data.nominal_request.toLocaleString('id-ID'));
                        $('#max_pinjam').val(max_pinjam);
                        $('#tenor').val(response.data.tenor / 12);
                        $('#desc_request').val(response.data.desc_request);

                        // computed max tenor
                        document.getElementsByClassName('num_max_tenor')[0].addEventListener("keyup", function(e) {
                            if (e.target.value > 15) {
                                this.value = 15;
                            } else if (e.target.value.length && e.target.value <= 0) {
                                this.value = 1;
                            }
                        });

                        // computed max pinjam
                        var nom_request = Number($("#nominal_request").val().replace(/[^0-9\.]+/g,'').replace(/[.,]/g, '').replace('Rp. ', ''));
                        document.getElementsByClassName('num_request')[0].addEventListener("keyup", function(e) {
                            if (e.target.value.replace(/[^0-9\.]+/g,'').replace(/[.,]/g, '').replace('Rp. ', '') >= response.data.max_pinjam) {
                                this.value = 'Rp. ' + response.data.max_pinjam.toLocaleString('id-ID');
                            }
                            // else if (e.target.value.replace(/[^0-9\.]+/g,'').replace(/[.,]/g, '').replace('Rp. ', '') <= response.data.min_pinjam) {
                            //     this.value = 'Rp. ' + response.data.min_pinjam.toLocaleString('id-ID');
                            // }
                        });

                        // computed cicilan perbulan
                        var cicilan_perbulan = 0;
                        var x = Number($("#nominal_request").val().replace(/[^0-9\.]+/g,'').replace(/[.,]/g, '').replace('Rp. ', ''))
                        var y = Number($("#tenor").val());
                        var tot = ((x / (y * 12)) * 5 / 100) + (x / (y * 12));
                        $('#cicilan_perbulan').val("Rp. " + tot.toLocaleString('id-ID'));
                    }
                }
            })
        });
    </script>

    <script>
        $('#submit-btn').click(function(e) {
                e.preventDefault();
                $('#submit-btn').html('<i class="fa fa-spinner fa-spin"></i> Loading..');
                // $(this).text('');

                $.ajax({
                    data: $('#form-edit-pinjaman').serialize(),
                    url: "{{ URL::to('anggota/update-pinjaman') }}",
                    type: "POST",
                    dataType: 'json',
                    enctype: 'multipart/form-data',
                    success: function(response) {
                        console.log(response);
                        if (response.status == 400) {
                            console.log('Error:', response);
                            $('#nominal_request-validation').html(response.errors.nominal_request)
                            $('#tenor-validation').html(response.errors.tenor)
                            $('#desc_request-validation').html(response.errors.desc_request)
                            $('#submit-btn').text('Save');
                        } else {
                            $('#is-valid').html(response.message);
                            $('#form-edit-pinjaman').trigger('reset');

                            window.setTimeout(function() {
                                $('#edit-pinjaman-modal').modal('hide');
                                table.draw();
                            }, 500);
                        }
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
                        // url: "{{URL::to('anggota/hapusajuanpinjam')}}" + "/" + id,
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
                                        timer: 1500
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
    @endsection

