@extends('adminlte::page')

@section('title', 'Sunting Saran')

@section('content_header_title','Sunting Saran')
@section('content_header_prev_link','/backoffice/advice')
@section('content_header_prev_text','Semua Saran')

@section('plugins.Summernote', true)

@section('content')
    <form class="main-form" action="{{ route('backoffice.advice.update',$saran->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Subjek</label>
                            <input name="title" placeholder="Subjek" type="text" class="form-control"
                                   id="titleArticle"
                                   aria-describedby="helperTitle" value="{{$saran->subject}}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input name="name" placeholder="Nama Lengkap" type="text" class="form-control"
                                   id="nama_penyaran"
                                   aria-describedby="helperTitle" value="{{$saran->name}}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input name="phonenumber" placeholder="Nomor Telepon" type="text" class="form-control"
                                   id="notelp"
                                   aria-describedby="helperTitle" value="{{$saran->telp}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="mainStatus">Bobot Saran</label>
                            <select class="form-control select2" id="mainStatus" name="status">
                                <option value="draft" {{ $saran->status==="draft" ? 'selected' : '' }}>Biasa</option>
                                <option value="read" {{ $saran->status==="read" ? 'selected' : '' }}>Bagus</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Isi Pesan </label>
                            <textarea class="form-control" rows="4" name="main_content" disabled >{!! $saran->text !!}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-cloud-upload-alt"></i>&nbsp;&nbsp;&nbsp;Perbarui
                            </button>
                            <!-- <p>
                                <button class="btn btn-link btn-block text-danger" type="button" data-toggle="collapse"
                                        data-target="#deleteItem" aria-expanded="false" aria-controls="deleteItem">
                                    Hapus
                                </button>
                            </p>
                            <div class="collapse" id="deleteItem">
                                <button data-id="{{$saran->id}}" type="button" class="btn btn-danger btn-sm btn-block"
                                        onclick="document.getElementById('delete-form').submit();">Ya Lanjutkan Hapus!
                                </button>
                            </div> -->
                        </div>
                    </div>
                </div>
                
    </form>
    <form id="delete-form" action="{{route('backoffice.advice.destroy',$saran->id)}}" method="POST"
          style="display: none;">
        @method('DELETE')
        <input type="hidden" value="{{$saran->id}}" name="id">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
            // var titleArticle = $('#titleArticle');
            //
            // titleArticle.change(function () {
            //     var makeSlug = titleArticle.val();
            //     $('#slugURL').val(makeSlug.slugify('-'));
            // });

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
                placeholder: 'Deskripsi Saran',
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

