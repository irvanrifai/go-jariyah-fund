@extends('adminlte::page')

@section('title', 'Simulasi Peminjaman')

@section('content_header_title','Simulasi Peminjaman')

@section('plugins.Summernote', true)

@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center">
        <h3 class="card-title">Simulasi Peminjaman</h3>
    </div>
    <div class="card-body">
        <div id="accordion">
            <h3>Akses Halaman</h3>
            <div class="card">
                <div class="card-header">
                    <a class="card-link" data-toggle="collapse" href="#login">
                        Login
                    </a>
                </div>
                <div id="login" class="collapse show" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <p>1. Akses halaman Deputi Bidang Kewirausahaan <a href="{{ env('APP_URL') }}/backoffice" target="_blank" class="text-decoration-none">disini</a>.</p>
                            </div>
                            <div class="col-6">
                                <p class="text-justify">2. Masukkan alamat e-mail dan password yang telah terdaftar dan tekan tombol masuk.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <img src="\img\static\user-guide\akses-laman.PNG" width="350" height="400" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}">
                            </div>
                            <div class="col-6">
                                <img src="\img\static\user-guide\insert-data.PNG" width="350" height="400" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="Masukkan alamat e-mail dan password">
                            </div>
                        </div>
                    </div>
                    <hr class="bord-no pad-all">
                </div>

                <div class="card-header">
                    <a class="collapsed card-link" data-toggle="collapse" href="#register">
                        Registrasi
                    </a>
                </div>
                <div id="register" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <p>1. Akses halaman Deputi Bidang Kewirausahaan <a href="{{ env('APP_URL') }}/backoffice" target="_blank" class="text-decoration-none">disini</a> dan tekan tombol "Daftar sebagai anggota baru".</p>
                            </div>
                            <div class="col-6">
                                <p class="text-justify">2. Masukkan nama lengkap, e-mail dan kata sandi baru. Tekan tombol daftar dan Anda akan diarahkan ke halaman dashboard backoffice Deputi Bidang Kewirausahaan.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <img src="\img\static\user-guide\akses-laman.PNG" width="350" height="400" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}">
                            </div>
                            <div class="col-6">
                                <img src="\img\static\user-guide\form-register.PNG" width="350" height="400" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="Masukkan alamat e-mail dan password">
                            </div>
                        </div>
                    </div>
                    <hr class="bord-no pad-all">
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection


@section('adminlte_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css"
          integrity="sha512-KbfxGgOkkFXdpDCVkrlTYYNXbF2TwlCecJjq1gK5B+BYwVk7DGbpYi4d4+Vulz9h+1wgzJMWqnyHQ+RDAlp8Dw=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css"
          integrity="sha512-pDpLmYKym2pnF0DNYDKxRnOk1wkM9fISpSOjt8kWFKQeDmBTjSnBZhTd41tXwh8+bRMoSaFsRnznZUiH9i3pxA=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
          integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
          crossorigin="anonymous"/>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@stop

@section('adminlte_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
            integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"
            integrity="sha512-kZv5Zq4Cj/9aTpjyYFrt7CmyTUlvBday8NGjD9MxJyOY/f2UfRYluKsFzek26XWQaiAp7SZ0ekE7ooL9IYMM2A=="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"
            integrity="sha512-+cXPhsJzyjNGFm5zE+KPEX4Vr/1AbqCUuzAS8Cy5AfLEWm9+UI9OySleqLiSQOQ5Oa2UrzaeAOijhvV/M4apyQ=="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/lang/summernote-id-ID.min.js"
            integrity="sha512-bdViARy+nltxu4VnqeBPWGfBN3yvL3hyo+Pi1lnQqXRkYqOwSVOl4QMU0upsfH/LO/kak7t9a7q7YsdUso+kig=="
            crossorigin="anonymous"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $(document).ready(function () {

            // Select2
            $('.select2').select2({
                theme: 'bootstrap4',
            });

            // Slug URL
            var titleArticle = $('#titleArticle');

            titleArticle.change(function () {
                var makeSlug = titleArticle.val();
                $('#slugURL').val(makeSlug.slugify('-'));
            });

            // Start of Summernote
            // Define function to open filemanager window
            var lfm = function (options, cb) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/backoffice/file-manager';
                window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
                window.SetUrl = cb;
            };

            // Define LFM summernote button
            var LFMButton = function (context) {
                var ui = $.summernote.ui;
                var button = ui.button({
                    contents: '<i class="note-icon-picture"></i> ',
                    tooltip: 'Masukkan Gambar',
                    click: function () {

                        lfm({type: 'image', prefix: '/backoffice/file-manager'}, function (lfmItems, path) {
                            lfmItems.forEach(function (lfmItem) {
                                context.invoke('insertImage', lfmItem.url);
                            });
                        });

                    }
                });
                return button.render();
            };

            // Filemanager Standalone Button
            var route_prefix = '/backoffice/file-manager';
            $('#lfm').filemanager('image', {prefix: route_prefix});


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

@stop
