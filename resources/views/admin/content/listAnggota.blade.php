@extends('admin.index')

@section('content_judul')
<h4 class="m-0 text-dark">Data List Anggota</h4>
@stop

@section('body')
<div class="row">
    <div class="col-md-12">
        <h4 class="p-2">Data List Anggota</h4>
        {{-- <form action="{{ url('admin/filterlistanggota/filterlistanggota') }}">
            <div class="col">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Nama Group</label>
                        </div>
                        <select class="custom-select" id="select_kelompok" name="kelompok">
                            <option selected>Choose...</option>
                        </select>
                    </div>
                </div>
                <div>
                    <button id="filter" type="submit" class="btn btn-sm btn-outline-info">Filter</button>
                </div>
            </div>
        </form> --}}
        <div class="card demo-icons" style="margin-top:20px;">
            <div class="card-header">
                <a href="{{ url('admin/add-list-anggota') }}" class="btn btn-primary active" id="add" style="margin-bottom:10px;" role="button"><i class="nav-icon fas fa-plus"></i>&nbsp;Tambah Data</a>
                <div class="table-responsive">
                    <table id="anggotaTable" class="table table-hover table-striped table-bordered" style='width:100%'>
                        <thead class="thead-light">
                            <tr>
                                <th>Nama</th>
                                <th>Group</th>
                                <th>Desa</th>
                                <th>Kecamatan</th>
                                <th>Tanggal Bergabung</th>
                                <th>Status</th>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script>
            const table = $('#anggotaTable').DataTable({
                aaSorting: [[ 0, "desc" ]],
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('admin.data-list-anggota') }}",
                columns: [
                    {
                        data: 'duta_name',
                        name: 'duta_name'
                    },
                    {
                        data: 'nameGroup',
                        name: 'nameGroup'
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
                        render: function(data, type, row, meta) {
                            return moment(row.created_at).format('lll');
                        },
                    },
                    {
                        render: function(data, type, row) {
                            if (row.status == 0) {
                                return '<span class="badge badge-danger badge-pill">TIDAK AKTIF</span>';
                            } else if (row.status == 1) {
                                return '<span class="badge badge-success badge-pill">AKTIF</span>';
                            } else if (row.status == 2) {
                                return '<span class="badge badge-info badge-pill">FREEZE</span>';
                            } else {
                                return '<span class="badge badge-secondary badge-pill">PENDING</span>';
                            }
                        }
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
        {{-- <script>
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
        </script> --}}

        <script>
            $(document).on('click', '#add', function(e) {
                e.preventDefault();
                let $this = $(this);
                var id = $(this).data('id');
                console.log(id);
                $('#addListAnggota').modal('show');
                $.ajax({
                    type: "GET",
                    url: "{{URL::to('admin/tambah-list-anggota')}}" + "/" + id,
                    success: function(response) {
                        console.log(response);
                        if (response.status == 404) {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                        } else {
                            //$('#pinjam_id').val(response.aprove.id);
                            //$('#group_anggota_id').val(response.aprove.group_anggota_id);

                        }
                    }
                })
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
                            url: "{{URL::to('admin/hapus-list-anggota')}}" + "/" + id,
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
                                                $('#anggotaTable').val(json.lastInput);
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
            $(document).on('click', '.edit_approve', function(e) {
                e.preventDefault();
                let $this = $(this);
                var id = $(this).data('id');
                console.log(id);
                $('#AddAproveModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "{{URL::to('anggota/editaprove')}}" + "/" + id,
                    success: function(response) {
                        console.log(response);
                        if (response.status == 404) {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                        } else {
                            $('#pinjam_id').val(response.aprove.id);
                            $('#group_anggota_id').val(response.aprove.group_anggota_id);

                        }
                    }
                })
            });
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
                    url: "{{URL::to('admin/edit-list-anggota')}}" + "/" + id,
                    success: function(response) {
                        console.log(response);
                        if (response.status == 404) {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                        } else {
                            $('#id').val(response.data[0].id);
                            $('#name').val(response.data[0].name);
                            $('#group').val(response.data[0].nameGroup);
                            //$('#project').val(response.data[0].project_name);
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
            $(document).ready(function() {
                $('#input-duta_wakaf').select2({
                    theme: 'bootstrap4',
                    placeholder: "--Pilih Nama Anggota--",
                    allowClear: true,
                    ajax: {
                        url: "{{ route('admin.select2-duta') }}",
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
                                obj.text = obj.duta_name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                                    return letter.toUpperCase();
                                });

                                return obj;
                            });
                            params.page = params.page || 1;

                            console.log(items);
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
                $('#addinput-duta_wakaf').select2({
                    theme: 'bootstrap4',
                    placeholder: "--Pilih Nama Anggota--",
                    allowClear: true,
                    ajax: {
                        url: "{{ route('admin.select2-duta') }}",
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
                                obj.text = obj.duta_name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                                    return letter.toUpperCase();
                                });

                                return obj;
                            });
                            params.page = params.page || 1;

                            console.log(items);
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
                $('#group').select2({
                    theme: 'bootstrap4',
                    placeholder: "--Pilih Group --",
                    allowClear: true,
                    ajax: {
                        url: "{{ route('admin.select2-group') }}",
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
                                obj.text = obj.nameGroup.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                                    return letter.toUpperCase();
                                });

                                return obj;
                            });
                            params.page = params.page || 1;

                            console.log(items);
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
                $('#addgroup').select2({
                    theme: 'bootstrap4',
                    placeholder: "--Pilih Group --",
                    allowClear: true,
                    ajax: {
                        url: "{{ route('admin.select2-group') }}",
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
                                obj.text = obj.nameGroup.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                                    return letter.toUpperCase();
                                });

                                return obj;
                            });
                            params.page = params.page || 1;

                            console.log(items);
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

        {{-- Modal Edit Anggota --}}
        <div class="modal fade" id="AddAproveModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit List Anggota</h5>
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="submit" class="btn btn-primary submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Add New Anggota --}}
    <div class="modal fade" id="addListAnggota" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah List Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{URL::to('admin/add-anggota-to-group')}}" id="editform">
                        @csrf
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Nama Anggota</label>
                            <select name="duta_name" id="addinput-duta_wakaf" class="form-control" required>
                                <option value="{{old('duta_name')}}">{{old('duta_name')}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Group</label>
                            <select name="group_id" id="addgroup" class="form-control" required>
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
