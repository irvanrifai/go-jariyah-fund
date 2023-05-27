@extends('admin.index')

@section('content_judul')

@stop

@section('body')
<div class="content">
    <h4 class="m-0 text-dark p-2">Tambah Group</h4>
    <div class="card demo-icons" style="margin-top:20px;">
            <div class="card-header" >
                <form action="{{ url('admin/create-group') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="village">Nama Desa</label>
                        <select name="village" id="village" class="form-control" required>
                        <option value="{{old('name')}}">{{old('name')}}</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="kec">Nama Kecamatan</label>
                        <select name="kec" id="kec" class="form-control" required>
                        <option value="{{old('name')}}">{{old('name')}}</option>
                        </select>
                      </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                        <label for="project">Project</label>
                        <select name="project" id="project" class="form-control" required>
                        <option value=""> Pilih Project</option>
                        <option value="{{old('project_name')}}">{{old('project_name')}}</option>
                        </select>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <label for="name">Nama Group</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama Group" required>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value=""> Pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="2">Freeze</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                    <button type="submit" class="btn btn-primary btn-round">Submit</button>
                    </div>
                </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>


      <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous"/>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <script>
    $(document).ready(function(){
        $('#village').select2({
            theme: 'bootstrap4',
            placeholder: "--Pilih Desa--",
            allowClear: true,
            ajax: {
                url: "{{ route('admin.select2-village') }}",
                delay: 100,
                data: function (params) {
                    var query = {
                        search: params.term,
                        page: params.page || 1
                    }
                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function (data, params) {
                    var items = $.map(data.data, function(obj){
                        obj.id   = obj.id;
                        obj.text = obj.name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
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
    $(document).ready(function(){
        $('#kec').select2({
            theme: 'bootstrap4',
            placeholder: "--Pilih Kecamatan--",
            allowClear: true,
            ajax: {
                url: "{{ route('admin.select2-kec') }}",
                delay: 100,
                data: function (params) {
                    var query = {
                        search: params.term,
                        page: params.page || 1
                    }
                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function (data, params) {
                    var items = $.map(data.data, function(obj){
                        obj.id   = obj.id;
                        obj.text = obj.name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
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
    $(document).ready(function(){
        $('#project').select2({
            theme: 'bootstrap4',
            placeholder: "--Pilih Project--",
            allowClear: true,
            ajax: {
                url: "{{ route('admin.select2-project') }}",
                delay: 100,
                data: function (params) {
                    var query = {
                        search: params.term,
                        page: params.page || 1
                    }
                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function (data, params) {
                    var items = $.map(data.data, function(obj){
                        obj.id   = obj.id;
                        obj.text = obj.project_name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
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
@endsection
