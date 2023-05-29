@extends('adminlte::page')

@section('title', 'Ajuan Anggota Lain')

@section('content_header_title','Ajuan Anggota Lain')
@section('content_header_prev_link','/anggota/dashboard')
@section('content_header_prev_text','Dashboard')

@section('content_header')

@section('css-tracking')
    <style>
        .hh-grayBox {
            background-color: #F8F8F8;
            margin-bottom: 20px;
            padding: 35px;
            margin-top: 20px;
        }

        .pt45 {
            padding-top: 45px;
        }

        .order-tracking {
            text-align: center;
            width: 16.66%;
            position: relative;
            display: block;
        }

        .order-tracking .is-complete {
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

        .order-tracking.completed .is-complete {
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

        .order-tracking.completed:before {
            background-color: #FFAF26;
        }

        .order-tracking .is-incomplete {
            display: block;
            position: relative;
            border-radius: 50%;
            height: 30px;
            width: 30px;
            border: 0px solid #b11a21;
            background-color: #b11a21;
            margin: 0 auto;
            transition: background 0.25s linear;
            -webkit-transition: background 0.25s linear;
            z-index: 2;
        }

        .order-tracking .is-incomplete:after {
            display: block;
            position: absolute;
            content: '';
            height: 14px;
            width: 7px;
            top: -2px;
            bottom: 0;
            left: 5px;
            margin: auto 0;
            border: 0px solid #b11a21;
            border-width: 0px 2px 2px 0;
            transform: rotate(30deg);
            opacity: 0;
        }

        .order-tracking.incompleted .is-incomplete {
            border-color: #b11a21;
            border-width: 0px;
            background-color: #b11a21;
        }

        .order-tracking.incompleted .is-incomplete:after {
            border-color: #fff;
            border-width: 0px 3px 3px 0;
            width: 7px;
            left: 11px;
            opacity: 1;
        }

        .order-tracking.incompleted:before {
            background-color: #b11a21;
        }

        .order-tracking p {
            color: #A4A4A4;
            font-size: 14px;
            margin-top: 8px;
            margin-bottom: 0;
            line-height: 20px;
        }

        .order-tracking p span {
            font-size: 12px;
        }

        .order-tracking.completed p {
            color: #000;
        }

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

        .order-tracking:first-child:before {
            display: none;
        }

    </style>
@endsection

<h4 class="m-0 text-dark">Ajuan Anggota Lain</h4>
@stop

@section('content')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
<script type="text/JavaScript" src=" https://MomentJS.com/downloads/moment.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>

{{-- parsing data with foreach --}}
{{-- <div class="row">
  <div class="col">
    <table id="myTable" class="table table-hover" width='100%'>
      <thead class="thead-light">
        <tr>
          <th>Nama Peminjam</th>
          <th>Nominal Ajuan Pinjam</th>
          <th>Keterangan</th>
          <th>Cicilan</th>
          <th>Tanggal</th>
          <th>Action</th>
        </tr>
        @foreach($data as $k)
        <tr>
          <td>{{$k->duta_name}}</td>
          <td>
            <?php echo '<i class="fa fa-clock text-danger"></i>&nbsp&nbsp' ?>{{"Rp". number_format($k->nominal_request)}}</br>
            <?php echo '<i class="fa fa-check-circle text-success"></i>&nbsp&nbsp&nbsp' ?>{{"Rp". number_format($k->nominal_accepted)}}
          </td>

          <td>
            <?php
            if ($k->status == 'request') {
              echo '<span class="badge badge-secondary badge-pill">Request</span></br>';
            } else if ($k->status == 'accepted') {
              echo '<span class="badge badge-success badge-pill">Accepted</span></br>';
            } else if ($k->status == 'cancel') {
              echo '<span class="badge badge-secondary badge-pill">Cancel</span></br>';
            } else {
              echo '<span class="badge badge-danger badge-pill">Reject</span></br>';
            }
            ?> {{$k->tenor}} <?php echo 'Bulan' ?>
          </td>
          <td>
            <?php echo "Total&nbsp;:&nbsp;" ?>{{"Rp". number_format($k->cicilan_perbulan)}}</br>
            <?php echo "Pokok&nbsp;:&nbsp;" ?>{{"Rp". number_format($k->cicilan_pokok)}}</br>
            <?php echo "Mudharabah&nbsp;:&nbsp;" ?>{{"Rp". number_format($k->cicilan_modharabah)}}
          </td>

          <td>
            <?php echo "Mengajukan&nbsp;:&nbsp;" ?>{{Carbon\Carbon::parse($k->created_at)->format('Y-m-d H:m')." WIB"}}</br>
            <?php echo "Disetujui&nbsp;:&nbsp;" ?>{{Carbon\Carbon::parse($k->accepted_hji_at)->format('Y-m-d H:m')." WIB"}}</br>
            <?php echo "Dana Cair&nbsp;:&nbsp;" ?>
          </td>
          <td>
            <a type="button" data-id="<?= $k->id; ?>" title="Ubah Perijinan" class="edit_approve btn-success btn-sm"> <i class='fas fa-check'></i></a>
            <a role="button" class="btn-info btn-sm" title="Detail" title='Lihat Status' href='/anggota/detailaprove/{{$k->id}}' data-content="Popover body content is set in this attribute.">
              <i class='fas fa-eye'></i></a>
          </td>
        </tr>
        @endforeach
      </thead>
    </table>
  </div>
</div> --}}

{{-- parsing data with datatable --}}
<div class="card-header">
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table id="table-ajuan-anggota-lain" class="table table-hover table-striped table-bordered">
                  <thead class="thead-light">
                    <tr>
                      <th>Nama Peminjam</th>
                      <th>Nominal Ajuan Pinjam</th>
                      <th>Keterangan</th>
                      <th>Cicilan</th>
                      <th>Tanggal</th>
                      <th>Approval</th>
                    </tr>
                  </thead>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="add-edit-pinjam-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title text-bold" id="header-perijinan"></h3>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                    <label for="duta_name" class="col-form-label">Nama Peminjam : </label>
                    <input type="text" class="form-control" name="duta_name" id="duta_name" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                    <label for="nominal_ajuan" class="col-form-label">Nominal Ajuan : </label>
                    <input type="text" class="form-control" name="nominal_ajuan" id="nominal_ajuan" disabled>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                    <label for="date_ajuan" class="col-form-label">Tanggal Mengajukan : </label>
                    <input type="text" class="form-control" name="date_ajuan" id="date_ajuan" disabled>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="tenor" class="col-form-label">Tenor : </label>
                        <input type="text" class="form-control" name="tenor" id="tenor" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                    <label for="desc" class="col-form-label">Keterangan : </label>
                    <input type="text" class="form-control" name="desc" id="desc" disabled>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="cicilan_perbulan" class="col-form-label">Cicilan Perbulan : </label>
                        <input type="text" class="form-control" name="cicilan_perbulan"
                            id="cicilan_perbulan" disabled>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="cicilan_pokok" class="col-form-label">Cicilan Pokok : </label>
                        <input type="text" class="form-control" name="cicilan_pokok"
                            id="cicilan_pokok" disabled>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="cicilan_modharabah" class="col-form-label">Cicilan Mudharabah :
                        </label>
                        <input type="text" class="form-control" name="cicilan_modharabah"
                            id="cicilan_modharabah" disabled>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="total_mudharabah" class="col-form-label">Total Mudharabah : </label>
                        <input type="text" class="form-control" name="total_mudharabah"
                            id="total_mudharabah" disabled>
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
                    <h5 class="text-bold">Perijinan Anda : </h5>
                </div>
            </div>

            <form action="javascript:void(0)" method="POST" enctype="multipart/form-data" name="form-perijinan" id="form-perijinan">
            @csrf
            <input class="form-control" name="pinjam_id" id="pinjam_id" type="hidden">
            <input class="form-control" name="group_anggota_id" id="group_anggota_id" type="hidden">
            <div class="row">
                <div id="fill-table" class="col-lg-12">
                </div>
            </div>
            <div class="row">
                <div id="fill-status" class="col-lg-3">
                </div>
                <div id="fill-note" class="col-lg-8">
                </div>
                <div id="btn-simpan-perijinan" class="col-lg-1">
                </div>
            </div>
            <div id="is-valid" class="text-success text-bold">
            </div>
            <div id="is-invalid" class="text-danger text-bold">
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<script>
    const table = $('#table-ajuan-anggota-lain').DataTable({
        initComplete: function() {
            this.api()
            var that = this;
            $('input').on('keyup change clear', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        },
        aaSorting: [[ 4, "desc" ]],
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('anggota.data-ajuan-anggota-lain') }}",
        columns: [
            {
                data: 'duta_name',
                name: 'duta_name'
            },
            {
                render: function(data, type, row) {
                    if (row.nominal_accepted == null) {
                        row.nominal_accepted = '-';
                    }
                    return '<i class="fa fa-clock text-danger"></i>&nbsp&nbsp&nbsp' + 'Rp&nbsp' + row.nominal_request.toLocaleString('id-ID') + '</br>' +
                    '<i class="fa fa-check-circle text-success"></i>&nbsp&nbsp&nbsp' + 'Rp&nbsp' + row.nominal_accepted.toLocaleString('id-ID');
                },
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
                        'Pokok&nbsp' + ":&nbsp" + "Rp&nbsp" + row.cicilan_pokok.toLocaleString('id-ID') + '</br> ' +
                        'Modharabah&nbsp' + ":&nbsp" + "Rp&nbsp" + row.cicilan_modharabah.toLocaleString('id-ID');
                },
            },
            {
                render: function(data, type, row, meta) {
                    return 'Mengajukan&nbsp' + ":&nbsp" + moment(row.created_at).format('lll');
                },
            },
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: false,
                autowidth: false
            },
        ],
    });
</script>

<script>
    // init element perijinan status type radio will fill in html
    var form_perijinan_status = document.createElement('div');
    form_perijinan_status.innerHTML =
    '<div class="form-group"><label for="status" class="col-form-label">Status : </label><select name="status" id="status" class="form-control"><option selected disabled value="">Pilih</option><option value="accepted">Accepted</option><option value="cancel">Cancel</option><option value="reject">Reject</option></select></div>';

    // init element note type textarea will fill in html
    var form_perijinan_note = document.createElement('div');
    form_perijinan_note.innerHTML =
    '<div class="form-group"><label for="note" class="col-form-label">Note : </label><input type="text" class="form-control" name="note" id="note"></div>';

    // init element button type submit will fill in html
    var btn_submit_perijinan = document.createElement('div');
    btn_submit_perijinan.innerHTML = '<label for="submit-btn" class="col-form-label d-sm-none d-sm-block">Action </label><button type="submit" class="btn btn-info" id="submit-btn" style="color:white;" title="Add Approval"><i class="fas fa-plus"></i></button>'

    // init element table will fill in html
    var table_perijinan = document.createElement('table');
    table_perijinan.setAttribute('id', 'tb-perijinan');
    table_perijinan.setAttribute('class', 'table table-hover table-striped table-bordered');
    table_perijinan.innerHTML = '<thead class="thead-light"><tr><th>Waktu Approval</th><th>Status</th><th>Note</th><th>Action</th></tr></thead>';

    $(document).on('click', '.detail-request-pinjam', function(e) {
    e.preventDefault();
    let $this = $(this);
    var id = $(this).data('id');
    $('#add-edit-pinjam-modal').modal('show');
    $.ajax({
      type: "GET",
      url: "{{URL::to('anggota/detail-request-pinjam')}}" + "/" + id,
      success: function(response) {
        // console.log(response.data.data_pinjam);
        // console.log(response.data.data_pinjam_approval_by_anggotas);
        if (response.status != 200) {
            $('#header-perijinan').addClass('text-danger');
            $('#header-perijinan').text('Data Not Found ' + response.status + ' !');
        } else {
            $('#header-perijinan').text('Perijinan Anggota');
            $('#pinjam_id').val(response.data.data_pinjam.id);
            // $('#group_anggota_id').val(response.data.data_pinjam.group_anggota_id);
            $('#duta_name').val(response.data.data_pinjam.duta_name);
            $('#nominal_ajuan').val('Rp. ' + response.data.data_pinjam.nominal_request.toLocaleString('id-ID'));
            $('#tenor').val(response.data.data_pinjam.tenor + ' bulan');
            $('#desc').val(response.data.data_pinjam.desc_request);
            $('#cicilan_perbulan').val('Rp. ' + response.data.data_pinjam.cicilan_perbulan.toLocaleString('id-ID'));
            $('#cicilan_pokok').val('Rp. ' + response.data.data_pinjam.cicilan_pokok.toLocaleString('id-ID'));
            $('#cicilan_modharabah').val('Rp. ' + response.data.data_pinjam.cicilan_modharabah.toLocaleString('id-ID'));
            $('#total_mudharabah').val('Rp. ' + response.data.data_pinjam.total_mudharabah.toLocaleString('id-ID'));
            $('#date_ajuan').val(response.data.data_pinjam.created_at.toLocaleString('id-ID'));

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

            $('#is-invalid').html('');
            $('#is-valid').html('');
            $('#submit-btn').text('Add');

            // id selector depend form html
            var tag_status = document.getElementById('fill-status');
            var tag_table = document.getElementById('fill-table');
            var tag_note = document.getElementById('fill-note');
            var tag_btn_simpan_perijinan = document.getElementById('btn-simpan-perijinan');

            // !! checking if user has give approval or not yet !!
            if (response.data.data_pinjam_approval_by_anggotas == null) {

                if (tag_status.hasChildNodes()) {
                    tag_status.removeChild(tag_status.firstChild);
                } if (tag_table.hasChildNodes()) {
                    tag_table.removeChild(tag_table.firstChild);
                } if (tag_note.hasChildNodes()){
                    tag_note.removeChild(tag_note.firstChild);
                } if (tag_btn_simpan_perijinan.hasChildNodes()) {
                    tag_btn_simpan_perijinan.removeChild(tag_btn_simpan_perijinan.firstChild);
                }

                tag_status.appendChild(form_perijinan_status);
                tag_note.appendChild(form_perijinan_note);
                tag_btn_simpan_perijinan.appendChild(btn_submit_perijinan);

            } else {

                // status approval
                var status = '<span class="badge badge-secondary badge-pill">Draft</span>'; //default(draft)
                if (response.data.data_pinjam_approval_by_anggotas.status == 'accepted') {
                    status = '<span class="badge badge-success badge-pill">Accepted</span>';
                } else if (response.data.data_pinjam_approval_by_anggotas.status == 'reject') {
                    status = '<span class="badge badge-danger badge-pill">Reject</span>';
                }

                // selector table content
                table_perijinan_content = document.createElement('tr');
                table_perijinan_content.innerHTML = '<td>' + response.data.data_pinjam_approval_by_anggotas.accepted_at.toLocaleString('id-ID') + '</td><td>' + status + '</td><td>' + response.data.data_pinjam_approval_by_anggotas.note + '</td><td><a role="button" id="btn-edit-approval" class="btn-warning btn-sm" title="Edit" data-content="Popover body content is set in this attribute." data-id=' + response.data.data_pinjam_approval_by_anggotas.approval_id + '><i class="fas fa-pen-fancy text-white text-md"></i></a></td>';

                if (tag_status.hasChildNodes()) {
                    tag_status.removeChild(tag_status.firstChild);
                } if (tag_table.hasChildNodes()) {
                    tag_table.removeChild(tag_table.firstChild);
                } if (tag_note.hasChildNodes()){
                    tag_note.removeChild(tag_note.firstChild);
                } if (tag_btn_simpan_perijinan.hasChildNodes()) {
                    tag_btn_simpan_perijinan.removeChild(tag_btn_simpan_perijinan.firstChild);
                }

                if (table_perijinan.children.length > 1) {
                    table_perijinan.removeChild(table_perijinan.lastChild);
                }

                tag_table.appendChild(table_perijinan);
                table_perijinan.appendChild(table_perijinan_content);
            }
        }
      }
    });
  });

</script>
<script>
    $(document).on('click', '#submit-btn', function(e) {
        e.preventDefault();
        $('#submit-btn').html('<i class="fa fa-spinner fa-spin"></i>');

        $.ajax({
            data: $('#form-perijinan').serialize(),
            url: "{{ URL::to('anggota/create-update-approval-pinjam') }}",
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
                    $('#is-invalid').html('');
                    $('#is-valid').html(response.message);
                    $('#form-perijinan').trigger('reset');
                    $('#submit-btn').text('Ok !');

                    window.setTimeout(function() {
                        $('#add-edit-pinjam-modal').modal('hide');
                        table.draw();
                    }, 500);
                }
            }
        });
    });

    $(document).on('click', '#btn-delete-approval', function() {
            let id = $(this).attr('data-id');
            // console.log(id);
            Swal.fire({
                title: 'Anda Yakin?',
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
                        url: "{{URL::to('anggota/delete-approval-pinjam')}}" + "/" + id,
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
                                        // table.ajax.reload(function(json) {
                                        //     $('#table-ajuan-anggota-lain').val(json.lastInput);
                                        // });
                                        $('#add-edit-pinjam-modal').modal('hide');
                                        // $('#add-edit-pinjam-modal .modal-body').load(function(){
                                        //     $('#add-edit-pinjam-modal').modal('show');
                                        // })
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
        });
</script>
@stop
