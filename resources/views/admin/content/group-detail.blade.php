@extends('admin.layout.main')

@section('title', 'Group Detail')

@section('body')
<div class="content">
    <div class="container">
        <div class="row pt-4">
            <div class="col-lg-6">
                <div class="card demo-icons">
                    <div class="card-header">
                        <h5>Detail Group</h5>
                        <hr>
                        <div class="row pt-3">
                            <div class="col-lg-12">
                                <h5 class="text-bold">Nama Group : {{ $group->group_name }}</h5>
                                <h5 class="text-bold">Project : {{ $group->project_name }}</h5>
                                <h6 class="pb-4">Lokasi : Kecamatan {{ $group->district_name }} Desa {{ $group->village_name }}</h6>
                                <small>Jumlah Anggota : <span id="amount_anggota"></span></small><br>
                                <small>Dibuat pada {{ $group->created_at }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card demo-icons">
                    <div class="card-header">
                        <h5>Tambah Anggota</h5>
                        <hr>
                        <form action="#" id="form-add-anggota-to-group">
                            @csrf
                            <input type="hidden" name="group_id" id="group_id" value="{{ $group->id }}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Nama</label>
                                        <select name="name" id="name" class="form-control" required>
                                        </select>
                                        <div id="name-validation" class="text-danger"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <label for="status" class="col-form-label">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option selected disabled value="">Pilih</option>
                                            <option value="1">Aktif</option>
                                            <option value="2">Freeze</option>
                                            <option value="3">Pending</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                        <div id="status-validation" class="text-danger"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label for="submit-btn" class="col-form-label">Action </label>
                                    <button type="submit" id="submit-btn" class="btn btn-primary"><i class='fas fa-plus'></i>  Tambah</button>
                                </div>
                                <div id="is-valid" class="text-success text-bold"></div>
                                <div id="is-invalid" class="text-danger text-bold"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card demo-icons">
                    <div class="card-header">
                        <h5>Daftar Anggota</h5>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-hover table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Bergabung Pada</th>
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
</div>

<div class="modal fade" id="edit-anggota-in-group-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-bold" id="header-modal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" method="POST" id="form-edit-anggota-in-group">
                @csrf
                <input class="form-control" name="id" id="id" type="hidden">
                    <div class="form-group">
                        <label for="name_anggota" class="col-form-label">Nama : </label>
                        <input type="text" class="form-control" name="name_anggota" id="name_anggota" disabled>
                    </div>
                    <div class="form-group">
                        <label for="join_date" class="col-form-label">Bergabung : </label>
                        <input type="text" class="form-control" name="join_date" id="join_date" disabled>
                    </div>
                    <div class="form-group">
                        <label for="status_anggota" class="col-form-label">Status : </label>
                        <select name="status_anggota" id="status_anggota" class="form-control" required>
                            <option value="1">Aktif</option>
                            <option value="2">Freeze</option>
                            <option value="3">Pending</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    <div id="is-valid1" class="text-success text-bold">
                    </div>
                    <div id="is-invalid1" class="text-danger text-bold">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" id="submit-button" class="btn btn-primary submit"></button>
            </div>
            </form>
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
    var id = $('#group_id').val();
    var myCallBack = function(settings, json){
            var info = this.api().page.info();
            $('#amount_anggota').text(info.recordsTotal);
        };
    const table = $('#myTable').DataTable({
        initComplete: myCallBack,
        aaSorting: [
            [1, "desc"]
        ],
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ URL::to('admin/data-anggota-in-group') }}" + "/" + id,
        columns: [
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                render: function(data, type, row) {
                    if (row.status == 0) {
                        return '<span class="badge badge-danger badge-pill">Tidak Aktif</span>';
                    } else if (row.status == 1) {
                        return '<span class="badge badge-success badge-pill">Aktif</span>';
                    } else if (row.status == 2) {
                        return '<span class="badge badge-info badge-pill">Freeze</span>';
                    } else if (row.status == 3) {
                        return '<span class="badge badge-warning badge-pill">Pending</span>';
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
        $('#name').select2({
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
    $('#submit-btn').click(function(e) {
        e.preventDefault();
        $('#submit-btn').html('<i class="fa fa-spinner fa-spin"></i> Loading');

        $.ajax({
            data: $('#form-add-anggota-to-group').serialize(),
            url: "{{ URL::to('admin/add-anggota-to-group') }}",
            type: "POST",
            dataType: 'json',
            enctype: 'multipart/form-data',
            success: function(response) {
                console.log(response)
                if (response.status == 400) {
                    console.log('Error:', response);
                    $('#is-valid').html('');
                    $('#is-invalid').html(response.message);
                    $('#name-validation').html(response.errors.name);
                    $('#status-validation').html(response.errors.status);
                    $('#submit-btn').text('Save');
                } else if (response.status == 406) {
                    $('#is-valid').html('');
                    $('#is-invalid').html(response.message);
                    $('#submit-btn').text('Save');
                } else {
                    $('#is-valid').html(response.message);
                    $('#is-invalid').html('');
                    $('#name').empty().trigger('change');
                    $('#form-add-anggota-to-group').trigger('reset');
                    $('#submit-btn').text('Ok !');

                    window.setTimeout(function() {
                        $('#submit-btn').html('<i class="fas fa-plus"></i> Tambah');
                        $('#is-valid').html('');
                        table.draw();
                    }, 600);
                    // table.draw();
                }
            }
        });
    });
</script>

<script>
    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        let $this = $(this);
        var id = $(this).data('id');
        // console.log(id);
        $('#is-valid').html('');
        $('#edit-anggota-in-group-modal').modal('show');
        $.ajax({
            type: "GET",
            url: "{{URL::to('admin/edit-anggota-in-group')}}" + "/" + id,
            success: function(response) {
                // console.log(response);
                if (response.status != 200) {
                    $('#header-modal').text(response.message + ' ' + response.status + ' !');
                    $('#header-modal').addClass('text-danger');
                    $('#submit-button').addClass('disabled');
                    $('#submit-button').text('Not found!');
                } else {
                    $('#header-modal').text('Update Anggota in Group');
                    $('#is-valid1').html('');
                    $('#is-invalid1').html('');
                    $('#submit-button').text('Update');
                    $('#id').val(id);
                    $('#name_anggota').val(response.data.name);
                    $('#join_date').val(response.data.join_date);
                    $('#status_anggota').val(response.data.status);
                }
            }
        })
    });
</script>

<script>
    $('#submit-button').click(function(e) {
        e.preventDefault();
        $('#submit-button').html('<i class="fa fa-spinner fa-spin"></i> Loading');

        $.ajax({
            data: $('#form-edit-anggota-in-group').serialize(),
            url: "{{ URL::to('admin/update-anggota-in-group') }}",
            type: "POST",
            dataType: 'json',
            enctype: 'multipart/form-data',
            success: function(response) {
                // console.log(response)
                if (response.status == 400) {
                    console.log('Error:', response);
                    $('#is-valid1').html('');
                    $('#is-invalid1').html(response.message);
                    $('#submit-button').text('Save');
                } else {
                    $('#is-valid1').html(response.message);
                    $('#is-invalid1').html('');
                    $('#edit-anggota-in-group-modal').modal('hide');
                    table.draw();
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
                    type: "POST",
                    url: "{{ URL::to('admin/remove-anggota-from-group') }}" + "/" + id,
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
