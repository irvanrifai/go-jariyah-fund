@extends('adminlte::page')

@section('title', 'Tambahkan Halaman')

@section('content_header_title','Tambahkan Sebuah Halaman')
@section('content_header_prev_link','/backoffice/pages')
@section('content_header_prev_text','Semua Halaman')

@section('plugins.Summernote', true)

@section('content')
    <form class="main-form" action="{{ route('backoffice.pages.store') }}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="row main-content-editor">
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <input name="title" placeholder="Judul Halaman Anda" type="text" class="form-control" id="titleArticle"
                                   aria-describedby="helperTitle"><br>
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                          id="slug-url-desc">{{ env('APP_URL') }}/p/</span>
                                </div>
                                <input name="slug" type="text" class="form-control" id="slugURL" aria-describedby="slug-url-desc"
                                       placeholder="URL halaman akan digenerate judul halaman." readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea id="masterContent" name="main_content"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="mainStatus">Status</label>
                    <select class="form-control select2" id="mainStatus" name="status">
                        <option value="public">Publik</option>
                        <option value="private">Pribadi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="lfm">Gambar Cover</label>
                    <div class="input-group">
                       <span class="input-group-btn">
                         <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                           <i class="fas fa-folder-open"></i>
                         </a>
                       </span>
                        <input id="thumbnail" class="form-control" type="text" name="cover_image" readonly>
                    </div>
                    <img id="holder" style="margin-top:15px;max-height:100px;">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-cloud-upload-alt"></i>&nbsp;&nbsp;&nbsp;Terbitkan
                    </button>

                </div>
            </div>
        </div>
    </form>
@stop

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
                placeholder: 'Tulis halaman anda disini :)',
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

