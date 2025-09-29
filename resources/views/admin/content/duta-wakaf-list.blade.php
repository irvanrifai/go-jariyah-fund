@extends('admin.layout.main')

@section('title', 'Duta Wakaf')

@section('body')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <h4 class="p-2">Data Duta Wakaf</h4>
            <div class="card demo-icons" style="margin-top:20px;">
                <div class="card-header">
                    {{-- <a href="{{ url('admin/add-duta') }}" class="btn btn-primary" style="margin-bottom:10px;" role="button"><i class="nav-icon fas fa-plus"></i>&nbsp;Tambah Data</a> --}}
                    <div class="table-responsive">
                        <table id="myTable" class="table table-hover table-striped table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama</th>
                                    <th>Kode Referral</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No.HP</th>
                                    <th>E-Mail</th>
                                    <th>Status Approval</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>

            <script>
                const table = $('#myTable').DataTable({
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
                    ajax: "{{ route('admin.data-dutawakaf') }}",
                    columns: [
                        //{data:'group_anggota_id', name : 'group_anggota_id'},
                        {
                            data: 'duta_name',
                            name: 'duta_name',
                            orderable: true,
                            searchable: true,
                        },
                        {
                            data: 'duta_refcode',
                            name: 'duta_refcode',
                            orderable: false,
                            searchable: true,
                        },
                        {
                            // data: 'duta_gender',
                            // name: 'duta_gender',
                            render: function(data, type, row) {
                                if (row.duta_gender == 'L') {
                                    return 'Laki-laki';
                                } else if (row.duta_gender == 'P') {
                                    return 'Perempuan';
                                } else {
                                    return '-'
                                }
                            },
                            orderable: true,
                            searchable: false,
                        },
                        {
                            data: 'duta_phone',
                            name: 'duta_phone',
                            orderable: false,
                            searchable: true,
                        },
                        {
                            data: 'duta_email',
                            name: 'duta_email',
                            orderable: false,
                            searchable: true,
                        },
                        { //data:'is_approved', name:'is_approved'
                            render: function(data, type, row) {
                                if (row.is_approved == 1) {
                                    return '<span class="badge badge-success badge-pill">Approved</span>';
                                } else if (row.is_approved == 0) {
                                    return '<span class="badge badge-secondary badge-pill">Iddle</span>';
                                }
                            },
                            orderable: true,
                            searchable: true,
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            autowidth: true
                        },
                    ],
                });
            </script>

            {{-- <script>
                $(document).ready(function() {
                    $('#myTable thead tr')
                        .clone(true)
                        .addClass('filters')
                        .appendTo('#myTable thead');

                })
            </script> --}}

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

                /*.filters {
                        float: left;
                        width: auto;
                    }*/
            </style>
            @endsection
