@extends('admin.index')

@section('body')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <h4 class="p-2">Data Setting</h4>
                <div class="card demo-icons">
                    <div class="card-header">
                        <a href="javascript:void(0)" class="btn btn-primary active add-setting" role="button"><i class="nav-icon fas fa-plus"></i>&nbsp;Tambah Data</a>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-hover table-striped table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Pinjaman</th>
                                        <th>Value</th>
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

    <div class="modal fade" id="add-edit-setting-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-bold" id="header-modal"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{URL::to('admin/add-setting')}}" method="POST" id="form-add-edit-setting">
                    @csrf
                    <input class="form-control" name="id" id="id" type="hidden">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Key : </label>
                            <input type="text" class="form-control" name="key" id="key" placeholder="Masukkan Key" required>
                            <div id="key-validation" class="text-danger"></div>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Value : </label>
                            <input type="text" class="form-control" name="value" id="value" placeholder="Masukkan Value" required>
                            <div id="value-validation" class="text-danger"></div>
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

    {{-- <div class="modal fade" id="edit-setting-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="header-modal">Edit List Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{URL::to('admin/update-list-anggota')}}" id="editform">
                        @csrf
                        <input class="form-control" name="id" id="id" type="hidden">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Nama Anggota</label>
                            <select name="duta_name" id="input-duta_wakaf" class="form-control" required>
                                <option value="{{old('duta_name')}}">{{old('duta_name')}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Group</label>
                            <select name="group_id" id="group" class="form-control" required>
                                <option value="{{old('namaDesa')}}">{{old('namaDesa')}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1">Aktif</option>
                                <option value="2">Freeze</option>
                                <option value="3">Pending</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit" class="btn btn-primary submit">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div> --}}

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
            ajax: "{{ route('admin.data-setting') }}",
            columns: [{
                    data: 'key',
                    name: 'key'
                },
                {
                    data: 'value',
                    name: 'value'
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
        $(document).on('click', '.add-setting', function(e) {
            e.preventDefault();
            let $this = $(this);
            var id = $(this).data('id');
            $('#id').val('');
            $('#form-add-edit-setting').trigger('reset');
            $('#header-modal').text('Add New Setting');
            $('#submit-btn').text('Add');
            $('#key-validation').html('')
            $('#value-validation').html('')
            $('#is-valid').html('');
            $('#add-edit-setting-modal').modal('show');
        });
    </script>

    <script>
        $(document).on('click', '.edit-setting', function(e) {
            e.preventDefault();
            let $this = $(this);
            var id = $(this).data('id');
            // console.log(id);
            $('#key-validation').html('')
            $('#value-validation').html('')
            $('#is-valid').html('');
            $('#add-edit-setting-modal').modal('show');
            $.ajax({
                type: "GET",
                url: "{{URL::to('admin/edit-setting')}}" + "/" + id,
                success: function(response) {
                    // console.log(response);
                    if (response.status != 200) {
                        $('#header-modal').text(response.message + ' ' + response.status + ' !');
                        $('#header-modal').addClass('text-danger');
                        $('#submit-btn').addClass('disabled');
                        $('#submit-btn').text('Not found!');
                    } else {
                        $('#header-modal').text('Edit Setting');
                        $('#submit-btn').text('Update');
                        $('#id').val(id);
                        $('#key').val(response.data.key);
                        $('#value').val(response.data.value);
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
                    data: $('#form-add-edit-setting').serialize(),
                    url: "{{ URL::to('admin/create-update-setting') }}",
                    type: "POST",
                    dataType: 'json',
                    enctype: 'multipart/form-data',
                    success: function(response) {
                        if (response.status == 400) {
                            console.log('Error:', response);
                            $('#key-validation').html(response.errors.key)
                            $('#value-validation').html(response.errors.value)
                            $('#submit-btn').text('Save');
                        } else {
                            $('#is-valid').html(response.message);
                            $('#form-add-edit-setting').trigger('reset');

                            window.setTimeout(function() {
                                $('#add-edit-setting-modal').modal('hide');
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
                        url: "{{ URL::to('admin/hapus-setting') }}" + "/" + id,
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
