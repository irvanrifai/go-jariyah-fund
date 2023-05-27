@extends('admin.index')

@section('body')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <h4 class="p-2">Data Group</h4>
                <div class="card demo-icons" style="margin-top:20px;">
                    <div class="card-header">
                        <a href="javascript:void(0)" id="add-group-btn" class="btn btn-primary active pb-2"
                            role="button"> <i class="nav-icon fas fa-plus"></i>&nbsp;Tambah Data</a>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-hover table-striped table-bordered" style="width:100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nama Group</th>
                                        <th>Desa</th>
                                        <th>Kecamatan</th>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add-group-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-bold" id="header-modal"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form-add-group">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="village" class="col-form-label">Desa</label>
                                        <select name="village" id="village" class="form-control" required>
                                        </select>
                                        <div id="village-validation" class="text-danger"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="kec" class="col-form-label">Kecamatan</label>
                                        <select name="kec" id="kec" class="form-control" required>
                                        </select>
                                        <div id="kec-validation" class="text-danger"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="project" class="col-form-label">Project</label>
                                        <select name="project" id="project" class="form-control" required>
                                        </select>
                                        <div id="project-validation" class="text-danger"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Nama Group</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama Group" required>
                                        <div id="name-validation" class="text-danger"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="status" class="col-form-label">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option selected disabled>Pilih</option>
                                            <option value="1">Aktif</option>
                                            <option value="2">Freeze</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                        <div id="status-validation" class="text-danger"></div>
                                    </div>
                                </div>
                                <div id="is-valid" class="text-success text-bold"></div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="submit-btn" class="btn btn-primary">Save</button>
                            </div>
                        </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const table = $('#myTable').DataTable({
            aaSorting: [
                [0, "desc"]
            ],
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('admin.data-group') }}",
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'namaDesa',
                    name: 'namaDesa'
                },
                {
                    data: 'namaKecamatan',
                    name: 'namaKecamatan'
                },
                {
                    data: 'project_name',
                    name: 'project_name'
                },
                {
                    render: function(data, type, row) {
                        if (row.status == 0) {
                            return '<span class="badge badge-danger badge-pill">TIDAK AKTIF</span>';
                        } else if (row.status == 1) {
                            return '<span class="badge badge-success badge-pill">AKTIF</span>';
                        } else {
                            return '<span class="badge badge-warning badge-pill">FREEZE</span>';
                        }
                    }
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
        $(document).ready(function() {
            $('#village').select2({
                theme: 'bootstrap4',
                placeholder: "--Pilih Desa--",
                allowClear: true,
                ajax: {
                    url: "{{ route('admin.select2-village') }}",
                    delay: 100,
                    data: function(params) {
                        var query = {
                            search: params.term,
                            page: params.page || 1
                        }
                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    processResults: function(data, params) {
                        var items = $.map(data.data, function(obj) {
                            obj.id = obj.id;
                            obj.text = obj.name.toLowerCase().replace(/\b[a-z]/g, function(
                                letter) {
                                return letter.toUpperCase();
                            });

                            return obj;
                        });
                        params.page = params.page || 1;

                        // console.log(items);
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            // if ($('#village').find(:selected)){
                            //     console.log('tstttt')
                            // }
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
        $(document).ready(function() {
            $('#kec').select2({
                theme: 'bootstrap4',
                placeholder: "--Pilih Kecamatan--",
                allowClear: true,
                ajax: {
                    url: "{{ route('admin.select2-kec') }}",
                    delay: 100,
                    data: function(params) {
                        var query = {
                            search: params.term,
                            page: params.page || 1
                        }
                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    processResults: function(data, params) {
                        var items = $.map(data.data, function(obj) {
                            obj.id = obj.id;
                            obj.text = obj.name.toLowerCase().replace(/\b[a-z]/g, function(
                                letter) {
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
        $(document).ready(function() {
            $('#project').select2({
                theme: 'bootstrap4',
                placeholder: "--Pilih Project--",
                allowClear: true,
                ajax: {
                    url: "{{ route('admin.select2-project') }}",
                    delay: 100,
                    data: function(params) {
                        var query = {
                            search: params.term,
                            page: params.page || 1
                        }
                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    processResults: function(data, params) {
                        var items = $.map(data.data, function(obj) {
                            obj.id = obj.id;
                            obj.text = obj.project_name.toLowerCase().replace(/\b[a-z]/g,
                                function(letter) {
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
        $(document).on('click', '#add-group-btn', function(e) {
            $('#header-modal').text('Add New Group');
            $('#is-valid').html('');
            $('#village-validation').html('');
            $('#kec-validation').html('');
            $('#project-validation').html('');
            $('#name-validation').html('');
            $('#status-validation').html('');
            $('#add-group-modal').modal('show');
        });
    </script>

    <script>
        $(document).on('click', '#submit-btn', function(e) {
        e.preventDefault();
        $('#submit-btn').html('<i class="fa fa-spinner fa-spin"></i>');

        $.ajax({
            data: $('#form-add-group').serialize(),
            url: "{{ URL::to('admin/create-group') }}",
            type: "POST",
            dataType: 'json',
            enctype: 'multipart/form-data',
            success: function(response) {
                console.log(response);
                if (response.status == 400) {
                    console.log('Error:', response);
                    $('#is-valid').html('');
                    $('#village-validation').html(response.errors.village);
                    $('#kec-validation').html(response.errors.kec);
                    $('#project-validation').html(response.errors.project);
                    $('#name-validation').html(response.errors.name);
                    $('#status-validation').html(response.errors.status);
                    $('#submit-btn').text('Save');
                } else {
                    $('#is-valid').html(response.message);
                    $('#village').empty().trigger('change');
                    $('#kec').empty().trigger('change');
                    $('#project').empty().trigger('change');
                    $('#form-add-group').trigger('reset');
                    $('#submit-btn').text('Ok !');

                    window.setTimeout(function() {
                        $('#add-group-modal').modal('hide');
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
                        url: "{{ URL::to('admin/hapus-group') }}" + "/" + id,
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
                                text: 'Data Tidak Bisa Dihapus!',
                            })
                        }
                    })
                }
            })
        })
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
