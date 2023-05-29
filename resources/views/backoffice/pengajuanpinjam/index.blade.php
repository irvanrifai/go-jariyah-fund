@extends('adminlte::page')

@section('title', 'Pengajuan Peminjaman')

@section('content_header_title','Pengajuan Peminjaman')
@section('content_header_prev_link','/backoffice/posts')


@section('plugins.Summernote', true)

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

<form action="{{ url('anggota/tambahpinjam') }}" method="POST" enctype="multipart/form-data" name="formpengajuan">
    @csrf
    <div class="container-fluid p-1">
        <div class="row">
        <div class="col-lg-8">
            <div class="card p-4">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input name="id" class="form-control input-sm text-left amount" value="{{ auth()->user()->id }}" type="hidden" id="id" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nominal_request">Nominal Pinjam <span class="text-muted">min. Rp. {{ number_format($min_pinjam, 2, ',', '.') }}</span></label>
                            <input onkeyup="myChangeFunction(this)" name="nominal_request" class="form-control input-sm text-left amount num_request" type="text" id="nominal_request" placeholder="0" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="maksimal_pinjam">Maksimal Pinjam</label>
                            <div class="input-group">
                                <input class="form-control" name="maksimal_pinjam" id="maksimal_pinjam" type="text" value="Rp. {{ number_format($max_pinjam, 2, ',', '.') }}" disabled>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row ">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tenor">Tenor (berapa tahun) <span class="text-muted">max. {{ $max_tenor }}</span></label>
                            <div class="input-group">
                                <input class="form-control num_max_tenor" type="number" min="0" max="{{ $max_tenor }}" id="tenor" name="tenor" placeholder="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="lfm">Cicilan Perbulan</label>
                            <div class="input-group">
                                <input value="0" name="cicilan_perbulan" class="form-control" id="cicilan_perbulan" disabled>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="desc_request">Keterangan Pengajuan Pinjam</label>
                            <textarea class="form-control" id="textAreaExample3" rows="2" name="desc_request" placeholder="Berikan Keterangan Pengajuan Pinjam" required></textarea>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-cloud-upload-alt">
                                </i>&nbsp;&nbsp;&nbsp;Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-4">
                <h4 class="card-header pt-0">Rangkuman</h4>
                <div class="row pt-2">
                    <h6 class="text-muted">Total Penghimpunan Pribadi <br>
                    <span class="text-dark">Rp. {{ number_format($resume['total_penghimpunan'], 2, ',', '.') }}</span></h6>
                </div>
                <div class="row">
                    <h6 class="text-muted">Total Pinjam <br>
                    <span class="text-dark">Rp. {{ number_format($resume['total_pinjam'], 2, ',', '.') }}</span></h6>
                </div>
                <div class="row">
                    <h6 class="text-muted">Total Dikembalikan <br>
                    <span class="text-dark">Rp. {{ number_format($resume['total_dikembalikan'], 2, ',', '.') }}</span></h6>
                </div>
                <div class="row pb-2">
                    <h6 class="text-muted">Dana Sisa <br>
                    <span class="text-dark">Rp. {{ number_format($resume['dana_sisa'], 2, ',', '.') }}</span></h6>
                </div>
                <h5 class="card-header">Riwayat Pinjam Terakhir</h5>
                <div class="row pt-2">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-striped table-bordered">
                            <thead>
                                <th>Keterangan Pinjaman</th>
                                <th>Nominal</th>
                            </thead>
                            @foreach ($history as $h)
                            <tbody>
                                <td>{{ $h->desc_request }}</td>
                                <td>Rp. {{ number_format($h->nominal_accepted, 2, ',', '.') }}</td>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</form>
@stop


@section('adminlte_css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" integrity="sha512-KbfxGgOkkFXdpDCVkrlTYYNXbF2TwlCecJjq1gK5B+BYwVk7DGbpYi4d4+Vulz9h+1wgzJMWqnyHQ+RDAlp8Dw==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" integrity="sha512-pDpLmYKym2pnF0DNYDKxRnOk1wkM9fISpSOjt8kWFKQeDmBTjSnBZhTd41tXwh8+bRMoSaFsRnznZUiH9i3pxA==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@stop

@section('adminlte_js')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js" integrity="sha512-kZv5Zq4Cj/9aTpjyYFrt7CmyTUlvBday8NGjD9MxJyOY/f2UfRYluKsFzek26XWQaiAp7SZ0ekE7ooL9IYMM2A==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js" integrity="sha512-+cXPhsJzyjNGFm5zE+KPEX4Vr/1AbqCUuzAS8Cy5AfLEWm9+UI9OySleqLiSQOQ5Oa2UrzaeAOijhvV/M4apyQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/lang/summernote-id-ID.min.js" integrity="sha512-bdViARy+nltxu4VnqeBPWGfBN3yvL3hyo+Pi1lnQqXRkYqOwSVOl4QMU0upsfH/LO/kak7t9a7q7YsdUso+kig==" crossorigin="anonymous"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/fc-3.3.2/fh-3.1.8/kt-2.6.1/r-2.2.7/rg-1.1.2/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script>
    src = "http://code.jquery.com/jquery-1.12.4.js"
</script>

<script>
    var nominal_request = document.getElementById("nominal_request");
        nominal_request.addEventListener("keyup", function(e) {
            nominal_request.value = 'Rp. ' + formatRupiah(this.value);
            // console.log(Number(nominal_request.value.replace(/[^0-9\.]+/g,'').replace(/[.,]/g, '').replace('Rp. ', '')));
    });
</script>

<script type="text/javascript">
    $(function() {
        //$('#nominal_request').mask('#,###.##', {reverse : true});
        $(document).ready(function() {
            $("#nominal_request,#tenor").keyup(function() {
                var cicilan_perbulan = 0;
                // var x = Number($("#nominal_request").val());
                var x = Number($("#nominal_request").val().replace(/[^0-9\.]+/g,'').replace(/[.,]/g, '').replace('Rp. ', ''))
                var y = Number($("#tenor").val());
                var tot = ((x / (y * 12)) * 5 / 100) + (x / (y * 12));

                $('#cicilan_perbulan').val("Rp. " + tot.toLocaleString('id-ID'));

                // $('#nominal_request').val(formatRupiah(x))
            });
        });
    });
</script>


<script>
    var rupiah = document.getElementById("");
    rupiah.addEventListener("keyup", function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value);
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }
</script>

{{-- <script>
    const table = $('#daftar-artikel-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('anggota.posts.datatable') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                width: "5%",
                orderable: false,
                searchable: false
            },
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'category_title',
                name: 'category_title',
                orderable: false,
                searchable: true
            },
            // { data: 'status', name: 'status', width: "5%", orderable: false, searchable: false },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: "15%"
            },
        ],
    });
</script> --}}

<script>
    $(document).ready(function() {

        // Select2
        $('.select2').select2({
            theme: 'bootstrap4',
        });

        // Slug URL
        var titleArticle = $('#titleArticle');

        titleArticle.change(function() {
            var makeSlug = titleArticle.val();
            $('#slugURL').val(makeSlug.slugify('-'));
        });

        // Start of Summernote
        // Define function to open filemanager window
        var lfm = function(options, cb) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/backoffice/file-manager';
            window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
            window.SetUrl = cb;
        };

        // Define LFM summernote button
        var LFMButton = function(context) {
            var ui = $.summernote.ui;
            var button = ui.button({
                contents: '<i class="note-icon-picture"></i> ',
                tooltip: 'Masukkan Gambar',
                click: function() {

                    lfm({
                        type: 'image',
                        prefix: '/backoffice/file-manager'
                    }, function(lfmItems, path) {
                        lfmItems.forEach(function(lfmItem) {
                            context.invoke('insertImage', lfmItem.url);
                        });
                    });

                }
            });
            return button.render();
        };

        // Filemanager Standalone Button
        var route_prefix = '/anggota/file-manager';
        $('#lfm').filemanager('image', {
            prefix: route_prefix
        });


        // Initialize summernote with LFM button in the popover button group
        // Please note that you can add this button to any other button group you'd like

        $('#masterContent').summernote({
            lang: 'id-ID',
            placeholder: 'Tulis artikel anda disini :)',
            height: 299,
            toolbar: [
                ['popovers', ['lfm']],
                ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize', 'height']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph', 'table', 'link']],
                ['codeview', ['codeview']],
                ['fullscreen', ['fullscreen']]
            ],
            buttons: {
                lfm: LFMButton
            },
            fontName: 'Poppins'
        });

        // End of Summernote

    });
</script>

<script type="text/javascript">
    var input2 = document.getElementById('cicilan_perbulan');
    var tenorinput = document.getElementById('tenor');
    var nom_request = document.getElementById('nominal_request').value;

    if (nom_request === '') {
        tenorinput.disabled = true;
    }

    function myChangeFunction(input1) {
        var input2 = document.getElementById('cicilan_perbulan');
        var tenorinput = document.getElementById('tenor');
        if (input1.value != '') {
            tenorinput.disabled = false;
        } else {
            tenorinput.disabled = true;
            input2.value = 0;
            tenorinput.value = 0;
        }
    }

    function myChangeFunction2() {
        //var tenorinput = document.getElementById('tenor').value;
        //console.log(tenorinput);
        //var tenor_bulan = tenorinput *12;
        //console.log(tenor_bulan);

        var nom_request = document.getElementById('nominal_request').value;
        var cicilan_perbulan = document.getElementById('cicilan_perbulan');
        console.log(nom_request);
        var cicilan_pokok = parseFloat(parseInt(nom_request) / parseInt(tenor_bulan)).toFixed(1);
        console.log(cicilan_pokok);
        var mudharabah = parseFloat(parseInt(nom_request) * 5) / 100;
        console.log(mudharabah);
        var cicilan_mudharabah = parseFloat(parseInt(mudharabah) / parseInt(tenor_bulan)).toFixed(2);
        console.log(cicilan_mudharabah);
        var result = parseFloat(parseInt(cicilan_pokok) + parseInt(cicilan_mudharabah)).toFixed(2);
        console.log(result);
        cicilan_perbulan.value = result.toString();
    }
</script>

<script>
    var max_tenor = {!! json_encode($max_tenor) !!}
    document.getElementsByClassName('num_max_tenor')[0].addEventListener("keyup", function(e) {
        if (e.target.value > 15) {
            this.value = 15;
        } else if (e.target.value.length && e.target.value <= 0) {
            this.value = 1;
        }
    });
</script>

<script>
    var max_pinjam = {!! json_encode($max_pinjam) !!};
    var min_pinjam = {!! json_encode($min_pinjam) !!};
    min_pinjam = parseFloat(min_pinjam);
    var nom_request = Number($("#nominal_request").val().replace(/[^0-9\.]+/g,'').replace(/[.,]/g, '').replace('Rp. ', ''));
    document.getElementsByClassName('num_request')[0].addEventListener("keyup", function(e) {
        if (e.target.value.replace(/[^0-9\.]+/g,'').replace(/[.,]/g, '').replace('Rp. ', '') >= max_pinjam) {
            this.value = 'Rp. ' + max_pinjam.toLocaleString('id-ID');
        }
        // else if (e.target.value.replace(/[^0-9\.]+/g,'').replace(/[.,]/g, '').replace('Rp. ', '') <= min_pinjam) {
        //     this.value = 'Rp. ' + min_pinjam.toLocaleString('id-ID');
        // }
    });
</script>

@stop
