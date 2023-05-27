@extends('adminlte::page')

@section('title', 'Detail Approval Ajuan Peminjaman')

@section('content_header_title','Detail Approval Ajuan')
@section('content_header_prev_link','anggota/dashboard')
@section('content_header_prev_text','Dashboard')

@section('content_header')
<h5 class="m-0 text-dark">Detail Approval Ajuan Peminjaman</h5>
@stop

@section('content')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
<script type = "text/JavaScript" src=" https://MomentJS.com/downloads/moment.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>

<div class="card" style="padding:20px;">
<div class="row">
        <div class="col">
        <table id="detail-1" class="table table-hover table-striped table-bordered" >
            <thead class="thead-light" >
                <tr>
                    <th>Diajukan Oleh</th>
                    <th>Nominal Ajuan</th>
                    <th>Deskripsi Peminjaman</th>
                    <th>Tenor</th>
                    <th>Nominal Cicilan</th>
                    <th>Tanggal</th>
                </tr>
                      <tr>
                          <td>{{ $data->name_requester }}</td>
                          <td>
                            <?php echo '<i class="fa fa-clock text-danger"></i>&nbsp&nbsp&nbsp'?>{{"Rp". number_format($data->nominal_request)}}</br>
                            <?php echo '<i class="fa fa-check-circle text-success"></i>&nbsp&nbsp&nbsp' ?>{{"Rp". number_format($data->nominal_accepted)}}</br>
                            <?php
                            if($data->status == 'request'){
                                echo '<span class="badge badge-secondary badge-pill">Request</span>';
                            }else if($data->status == 'accepted'){
                                echo '<span class="badge badge-success badge-pill">Accepted</span>';
                            }else if($data->status == 'cancel'){
                                echo '<span class="badge badge-secondary badge-pill">Cancel</span>';
                            }else{
                                echo '<span class="badge badge-danger badge-pill">Reject</span>';
                            }?>
                          </td>
                          <td>{{$data->desc_request}}</td>
                          <td>{{$data->tenor}} bulan</td>
                          <td>
                                <?php echo "Total&nbsp;:&nbsp;" ?>{{"Rp ". number_format($data->cicilan_perbulan)}}</br>
                                <?php echo "Pokok&nbsp;:&nbsp;" ?>{{"Rp ". number_format($data->cicilan_pokok)}}</br>
                                <?php echo "Mudharabah&nbsp;:&nbsp;" ?>{{"Rp ". number_format($data->cicilan_modharabah)}}
                          </td>
                          <td>
                                <?php echo "Mengajukan&nbsp;:&nbsp;" ?>{{ $data->created_at }}</br>
                                <?php echo "Disetujui&nbsp;:&nbsp;" ?>{{ $data->accepted_hji_at }}</br>
                          </td>
                       </tr>
              </thead>
            </table>
</div></div></div>

<div class="row" >
    <div class="col">
        <div class="card-header">
            <h4>Detail Approval</h4>
        </div>
        <div class="card"  style="padding:20px;">
        <table id="detail-3" class="table table-hover table-striped table-bordered">
            <thead class="thead-light" >
                <tr>
                    <th>Deskripsi Peminjaman</th>
                    <th>Tanggal Disetujui</th>
                    <th>Disetujui Oleh</th>
                    <th>Status</th>
                    <th>Note</th>
                    {{-- <th>Action</th> --}}
                </tr>
                @foreach ($aprove as $d)
                <tr>
                    <td>{{$d->de}}</td>
                    <td>{{ $d->dt }}</td>
                    <td>{{ $d->name_who_approved }}</td>
                    <td>
                    <?php
                       if($d->status == 'reject'){
                            echo '<span class="badge badge-danger badge-pill">Reject</span>';
                        }else if ($d->status == 'accepted') {
                            echo '<span class="badge badge-success badge-pill">Accepted</span>';
                        }else {
                            echo '<span class="badge badge-secondary badge-pill">Draft</span>';
                       }?>
                    </td>
                    <td>{{$d->note}}</td>
                    {{-- <td>
                    <a role="button" class="btn-info btn-sm" title='Lihat Status' href='/anggota/detailaprove-aprove/{{$d->id}}' data-content="Popover body content is set in this attribute.">
                    <i class='fas fa-eye'></i></a>

                    <a type="button" data-id="<?= $d->id; ?>" title="Edit Izin" class="btn-warning btn-sm edit_approve_approve"> <i class='fas fa-pen-fancy'></i></a></br></br>
                    </td> --}}
                </tr>
                @endforeach
            </thead>
        </table>
</div>
</div>
</div>
<div class="modal fade" id="AddAproveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Izin Anda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ url('anggota/updateaprove-aprove/'.$data->id) }}" method="POST" enctype="multipart/form-data" name="formcicil">
          @csrf
        <div class="form-group">
           <!-- <label for="message-text" class="col-form-label">Pinjam:</label>-->
            <input class="form-control" name="pinjam_id" id="pinjam_id">
          </div>
          <div class="form-group">
            <!--<label for="message-text" class="col-form-label">Group:</label>-->
            <input class="form-control" name="group_anggota_id" id="group_anggota_id" type="hidden">
          </div>
        <label for="message-text" class="col-form-label">Status:</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" value="accepted" name="radio" id="status"  <?php if("status=='accepted'"){echo'checked';} ?>>
            <label class="form-check-label" for="flexRadioDefault1">
                Setuju
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" value="reject" name="radio" id="status" <?php if("status=='reject'"){echo'checked';} ?>>
            <label class="form-check-label" for="flexRadioDefault2" >
                Tolak
            </label>
        </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Note:</label>
            <textarea class="form-control" name="note" id="note"></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>

      </div>
    </div>
  </div>
</div>

<script>
$(document).on('click', '.edit_approve_approve', function(e){
  e.preventDefault();
  let $this = $(this);
  var id = $(this).data('id');
  console.log(id);
  $('#AddAproveModal').modal('show');
  $.ajax({
    type:"GET",
    url: "{{URL::to('anggota/getaprove-aprove')}}"+"/" +id,
    success: function(response){
      console.log(response);
      if(response.status == 404){
        $('#success_message').html("");
        $('#success_message').addClass('alert alert-danger');
        $('#success_message').text(response.message);
      }else{
        $('#pinjam_id').val(response.aprove.id);
        $('#group_anggota_id').val(response.aprove.group_anggota_id);
        $('#status').val(response.aprove.status);
        $('#note').val(response.aprove.note);
      }
    }
  })
});
</script>
@endsection
