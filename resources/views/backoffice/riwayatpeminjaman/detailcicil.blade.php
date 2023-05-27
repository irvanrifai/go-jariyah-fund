@extends('adminlte::page')

@section('title', 'Detail Cicilan')

@section('content_header_title','Detail Cicilan')
@section('content_header_prev_link','/backoffice/')
@section('content_header_prev_text','Detail Cicilan')

@section('content_header')
<h1 class="m-0 text-dark">Detail Cicilan</h1>
@stop

@section('content')
<div class="card" style="padding:20px;">
<div class="row" >
        <div class="col">
        <table id="detail-1" class="table table-hover table-striped table-bordered" >
            <thead class="thead-light" >
                <tr>
                    <th>Nominal Cicilan</th>
                    <th>Status Cicilan</th>
                    <th>Tanggal Bayar</th>
                </tr>

                      <tr>
                          <td>
                            {{"Rp". number_format($data->nominal)}}
                          </td>
                          <td>{{$data->is_valid}}</td>
                          <td>{{$data->created_at}}</td>
                       </tr>
              </thead>
            </table>
</div></div></div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>

@endsection
