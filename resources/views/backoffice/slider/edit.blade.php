@extends('adminlte::page')

@section('title', 'Sunting Slide')

@section('content_header_title','Sunting Slide')
@section('content_header_prev_link','/backoffice/slider')
@section('content_header_prev_text','Semua Slider')

@section('content')
<form class="card" action="{{ route('backoffice.slider.update', $slide->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="card-header d-flex align-items-center">
            <h3 class="card-title">Slider: Ubah Slider</h3>
        </div>

        <div class="card-body">
            <div class="form-group row">
                <label for="input-title" class="col-sm-2 col-form-label">Judul{!! printRequired() !!}</label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="input-title" placeholder="Judul" value="{{ $slide->title }}" required>
                    @error('title')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-desc" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="desc" placeholder="Deskripsi" rows="4" >{{ $slide->desc ?? '-' }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="input-title" class="col-sm-2 col-form-label">Link</label>
                <div class="col-sm-10">
                    <input type="text" name="link" class="form-control @error('title') is-invalid @enderror" id="input-title" placeholder="URL" value="{{ $slide->link }}" required>
                </div>
            </div>
            <div class="form-group row" id="form-image">
                <label for="lfm" class="col-sm-2 col-form-label">Gambar{!! printRequired() !!}</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                <i class="fas fa-folder-open"></i>
                            </a>
                        </span>
                        <input id="thumbnail" type="text" name="image" value="{{ $slide->image }}" class="form-control @error('image') is-invalid @enderror" readonly>
                    </div>
                    @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <img id="holder" style="margin-top:15px;max-height:100px;">
                    <span class="input-group-btn">
                        <input type="hidden" name="is_show" value="0">
                        <input type="checkbox" name="is_show" data-plugin="switchery" data-color="#1bb99a" {{ $slide->is_show ? 'checked' : ''}} >
                    </span>
                    <label>Tampilkan Slide</label>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="btn-group float-right">
                <button type="submit" class="btn btn-sm btn-primary">Tambahkan</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- /.card-footer-->
    </form>
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
                }
            });

            // End of Summernote

        });
    </script>

@stop