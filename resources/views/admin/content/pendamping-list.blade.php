@extends('admin.layout.main')

@section('title', 'Pendamping')

@section('body')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <h4 class="p-2">Data Pendamping</h4>
                <div class="card demo-icons">
                    <div class="card-header">
                        <a href="javascript:void(0)" class="btn btn-primary active add-pendamping" role="button"><i class="nav-icon fas fa-plus"></i>&nbsp;Tambah Data</a>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-hover table-striped table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>No. Hp</th>
                                        <th>Email</th>
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
    </div>

    <div class="modal fade" id="add-edit-pendamping-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-bold" id="header-modal"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{URL::to('admin/add-pendamping')}}" method="POST" id="form-add-edit-pendamping">
                    @csrf
                    <input class="form-control" name="id" id="id" type="hidden">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name : </label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama" required>
                            <div id="name-validation" class="text-danger"></div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-form-label">Username : </label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" required>
                            <div id="username-validation" class="text-danger"></div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email : </label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Masukkan Email" required>
                            <div id="email-validation" class="text-danger"></div>
                        </div>
                        <div class="form-group">
                            <label for="no_hp" class="col-form-label">No. HP : </label>
                            <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="Masukkan No. HP" required>
                            <div id="no_hp-validation" class="text-danger"></div>
                        </div>
                        <div id="is-valid" class="text-success text-bold">
                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const table = $('#myTable').DataTable({
            initComplete: function() {
                this.api()
                var that = this;
                $('input').on('keyup change clear', function() {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
                    }
                });
            },
            aaSorting: [[ 0, "desc" ]],
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('admin.data-pendamping') }}",
            columns: [
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'no_hp',
                    name: 'no_hp'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    render: function(data, type, row) {
                        if (row.is_active == 1) {
                            return '<span class="badge badge-success badge-pill">Active</span>';
                        } else if (row.is_active == 0) {
                            return '<span class="badge badge-danger badge-pill">Deactivated</span>';
                        } else if (row.is_active == 2) {
                            return '<span class="badge badge-info badge-pill">Freeze</span>';
                        } else {
                            return '<span class="badge badge-secondary badge-pill">Unknown</span>';
                        }
                    },
                    name: 'is_active',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    autowidth: false
                },
            ],
        });
    </script>

    <script>
        $(document).on('click', '.add-pendamping', function(e) {
            e.preventDefault();
            let $this = $(this);
            var id = $(this).data('id');
            $('#id').val('');
            $('#form-add-edit-pendamping').trigger('reset');
            $('#header-modal').text('Add New Pendamping');
            $('#submit-btn').text('Add');
            $('#name-validation').html('')
            $('#username-validation').html('')
            $('#email-validation').html('')
            $('#no_hp-validation').html('')
            $('#is-valid').html('');
            $('#add-edit-pendamping-modal').modal('show');
        });
        </script>

<script>
    $(document).on('click', '.edit-pendamping', function(e) {
        e.preventDefault();
        let $this = $(this);
        var id = $(this).data('id');
        // console.log(id);
        $('#name-validation').html('')
        $('#username-validation').html('')
        $('#email-validation').html('')
        $('#no_hp-validation').html('')
        $('#is-valid').html('');
            $('#add-edit-pendamping-modal').modal('show');
            $.ajax({
                type: "GET",
                url: "{{URL::to('admin/edit-pendamping')}}" + "/" + id,
                success: function(response) {
                    // console.log(response);
                    if (response.status != 200) {
                        $('#header-modal').text(response.message + ' ' + response.status + ' !');
                        $('#header-modal').addClass('text-danger');
                        $('#submit-btn').addClass('disabled');
                        $('#submit-btn').text('Not found!');
                    } else {
                        $('#header-modal').text('Edit Pendamping');
                        $('#submit-btn').text('Update');
                        $('#id').val(id);
                        $('#name').val(response.data.name);
                        $('#username').val(response.data.username);
                        $('#email').val(response.data.email);
                        $('#no_hp').val(response.data.no_hp);
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
                    data: $('#form-add-edit-pendamping').serialize(),
                    url: "{{ URL::to('admin/create-update-pendamping') }}",
                    type: "POST",
                    dataType: 'json',
                    enctype: 'multipart/form-data',
                    success: function(response) {
                        if (response.status == 400) {
                            console.log('Error:', response);
                            $('#name-validation').html(response.errors.name)
                            $('#username-validation').html(response.errors.username)
                            $('#email-validation').html(response.errors.email)
                            $('#no_hp-validation').html(response.errors.no_hp)
                            $('#submit-btn').text('Save');
                        } else {
                            $('#is-valid').html(response.message);
                            $('#form-add-edit-pendamping').trigger('reset');

                            window.setTimeout(function() {
                                $('#add-edit-pendamping-modal').modal('hide');
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
                        url: "{{ URL::to('admin/hapus-pendamping') }}" + "/" + id,
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
