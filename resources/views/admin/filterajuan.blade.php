@extends('admin.index')

@section('body')
<div class="content">
    <h4 style="margin-left:15px"> Data Pengajuan Pinjam</h4></br>
    <div class="row">
        <div class="col-md-12">

            <div class="card demo-icons" style="margin-top:20px;">
                <div class="card-header">
                    <table id="myTable1" class="table table-hover table-striped table-bordered table-bordered" style="margin-top:10px;width:100%;">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama</th>
                                <th>Nominal Ajuan</th>
                                <th>Keterangan</th>
                                <th>Cicilan</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($data as $key)
                            <tr>
                                <td>
                                    {{$key->duta_name}}</br>
                                    Kel:&nbsp;{{$key->name}}
                                </td>
                                <td>
                                    <?php echo '<i class="fa fa-clock text-danger"></i>&nbsp&nbsp' ?>{{"Rp". number_format($key->nominal_request)}}</br>
                                    <?php echo '<i class="fa fa-check-circle text-success"></i>&nbsp&nbsp&nbsp' ?>{{"Rp". number_format($key->nominal_accepted)}}
                                </td>
                                <td>
                                    <?php
                                    if ($key->status == 'request') {
                                        echo '<span class="badge badge-secondary badge-pill">Request</span></br>';
                                    } else if ($key->status == 'accepted') {
                                        echo '<span class="badge badge-success badge-pill">Accepted</span></br>';
                                    } else if ($key->status == 'cancel') {
                                        echo '<span class="badge badge-secondary badge-pill">Cancel</span></br>';
                                    } else {
                                        echo '<span class="badge badge-danger badge-pill">Reject</span></br>';
                                    }
                                    ?> {{$key->tenor}} <?php echo 'Bulan' ?>
                                </td>
                                <td>
                                    <?php echo "Total&nbsp;:&nbsp;" ?>{{"Rp". number_format($key->cicilan_perbulan)}}</br>
                                    <?php echo "Pokok&nbsp;:&nbsp;" ?>{{"Rp". number_format($key->cicilan_pokok)}}</br>
                                    <?php echo "Mudharabah&nbsp;:&nbsp;" ?>{{"Rp". number_format($key->cicilan_modharabah)}}
                                </td>
                                <td>
                                    <?php echo "Mengajukan&nbsp;:&nbsp;" ?>{{Carbon\Carbon::parse($key->created_at)->format('Y-m-d H:m')." WIB"}}</br>
                                    <?php echo "Disetujui&nbsp;:&nbsp;" ?>{{Carbon\Carbon::parse($key->accepted_hji_at)->format('Y-m-d H:m')." WIB"}}</br>
                                    <?php echo "Dana Cair&nbsp;:&nbsp;" ?>
                                </td>
                                <td>
                                    <a href="/backoffice/editajuanpinjam/{{$key->id}}" class='fa fa-edit text-warning'></a>
                                    <a href="/backoffice/hapusajuanpinjam/{{$key->id}}" class='fa fa-trash text-danger'></a>
                                </td>
                            </tr>
                            @endforeach
                        </thead>
                    </table>
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
                $(document).ready(function() {
                    $.noConflict();
                    var table = $('#myTable1').DataTable();
                });
            </script>

            <!--<script>
                const table = $('#myTable1').DataTable({
                    orderCellsTop: true,
                    fixedHeader: true,
                    initComplete: function() {
                        var api = this.api();

                        // For each column
                        api
                            .columns()
                            .eq(0)
                            .each(function(colIdx) {
                                // Set the header cell to contain the input element
                                var cell = $('.filters th').eq(
                                    $(api.column(colIdx).header()).index()
                                );
                                var title = $(cell).text();
                                $(cell).html('<input type="text" placeholder="Cari ' + title + '" />');

                                // On every keypress in this input
                                $(
                                        'input',
                                        $('.filters th').eq($(api.column(colIdx).header()).index())
                                    )
                                    .off('keyup change')
                                    .on('change', function(e) {
                                        // Get the search value
                                        $(this).attr('title', $(this).val());
                                        var regexr = '({search})'; //$(this).parents('th').find('select').val();

                                        var cursorPosition = this.selectionStart;
                                        // Search the column for that value
                                        api
                                            .column(colIdx)
                                            .search(
                                                this.value != '' ?
                                                regexr.replace('{search}', '(((' + this.value + ')))') :
                                                '',
                                                this.value != '',
                                                this.value == ''
                                            )
                                            .draw();
                                    })
                                    .on('keyup', function(e) {
                                        e.stopPropagation();

                                        $(this).trigger('change');
                                        $(this)
                                            .focus()[0]
                                            .setSelectionRange(cursorPosition, cursorPosition);
                                    });
                            });
                    },
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    // "sPaginationType": "full_numbers",
                    ajax: "{{URL::to('admin/filterdata/filterdata')}}",
                    columns: [{
                            data: 'duta_name',
                            name: 'duta_name'
                        },
                        {
                            data: 'desc_request',
                            name: 'desc_request'
                        },
                        {
                            data: 'nominal',
                            name: 'nominal',
                            render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                        },
                        {
                            render: function(data, type, row) {
                                if (row.is_valid == 0) {
                                    return '<span class="badge badge-danger badge-pill">Tidak Valid</span>';
                                } else {
                                    return '<span class="badge badge-success badge-pill">Valid</span>';
                                }
                            }
                        },
                        // {data:'note_internal', name:'note_internal'},
                        {
                            render: function(data, type, row, meta) {
                                return moment(row.created_at).format('DD-MM-YYYY');
                            },
                        },
                        //{data:'updated_at', name:'updated_at'},
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            //autowidth: false
                        },
                    ],
                });
            </script>-->

            <script type="text/javascript">
                $(document).ready(function() {
                    $('.data').load("{{URL::to('admin/filterdatatable')}}"); //ini
                    $("#search").click(function() {
                        var peminjam = $("#peminjam").val();
                        var nominal = $("#nominal").val();
                        $.ajax({
                            type: 'GET',
                            url: "{{URL::to('admin/filterdatatable')}}", //ini
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
                                url: "{{URL::to('admin/hapuscicil/')}}" + "/" + id,
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

            <script>
                $(document).on('click', '.edit', function(e) {
                    e.preventDefault();
                    let $this = $(this);
                    var id = $(this).data('id');
                    console.log(id);
                    $('#AddAproveModal').modal('show');
                    $.ajax({
                            type: "get",
                            url: "{{URL::to('admin/editcicilan')}}" + "/" + id,
                            success: function(response) {
                                console.log(response);
                                if (response.status == 404) {
                                    $('#success_message').html("");
                                    $('#success_message').addClass('alert alert-danger');
                                    $('#success_message').text(response.message);
                                } else {
                                    $('#id').val(response.data.id);
                                    $('#nominal').val(response.data.nominal);
                                    $('#status').val(response.data.is_valid);
                                    $('#note').val(response.data.note_internal);
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
                function fetch_std() {
                    $.ajax({
                        url: "{{URL::to('admin/filter-std')}}",
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
                        url: "{{URL::to('admin/filter-result')}}",
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
                        url: "{{URL::to('admin/fetch/fetch')}}",
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


            <div class="modal fade" id="AddAproveModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Cicilan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{URL::to('admin/updatecicilan')}}" id="editform">
                                @csrf
                                <input class="form-control" name="id" id="id" type="hidden"></input>
                                <div class="form-group">
                                    <label>Nominal</label>
                                    <input class="form-control" name="nominal" id="nominal"></input>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="0">Tidak Valid</option>
                                        <option value="1">Valid</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Note</label>
                                    <input class="form-control" name="note" id="note"></input>
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
