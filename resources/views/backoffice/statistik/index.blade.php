@extends('adminlte::page')

@section('title', 'Chart Dana Bersama')

@section('css-new-dashboard')

<!-- Vendor CSS Files -->
<link href="{{ asset('asset-new-dashboard/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('asset-new-dashboard/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('asset-new-dashboard/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('asset-new-dashboard/vendor/quill/quill.snow.css') }}" rel="stylesheet">
<link href="{{ asset('asset-new-dashboard/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
<link href="{{ asset('asset-new-dashboard/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
<link href="{{ asset('asset-new-dashboard/vendor/simple-datatables/style.css') }}" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{ asset('asset-new-dashboard/css/style.css') }}" rel="stylesheet">
@endsection

@section('content_header_title','Statistik')
@section('content_header_prev_link','/backoffice/posts')

@section('content')
<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Pinjaman Aktif <span>| All</span></h5>

                    <!-- Bar Chart -->
                    <canvas id="barBarChart" style="max-height: 400px;"></canvas>
                    <script>

                        fetch("{{ route('anggota.chart-pinjaman-aktif-all') }}")
                            .then((response) => {
                                return response.json();
                            })
                            .then((data) => {
                                data_labels3 = data.data_labels
                                datas3 = data.datas
                            })
                            .catch(function(error) {
                                console.log(error);
                            });

                        data_labels3 = [];
                        datas3 = [];

                        document.addEventListener("DOMContentLoaded", () => {
                            new Chart(document.querySelector('#barBarChart'), {
                            type: 'bar',
                            data: {
                                labels: data_labels3,
                                datasets: [{
                                label: 'show / hide',
                                data: datas3,
                                backgroundColor: [
                                    'rgba(30, 130, 76, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(255, 205, 86, 0.2)',
                                    // 'rgba(54, 162, 235, 0.2)',
                                    // 'rgba(153, 102, 255, 0.2)',
                                    // 'rgba(201, 203, 207, 0.2)'
                                ],
                                borderColor: [
                                    'rgb(0, 230, 64)',
                                    'rgb(75, 192, 192)',
                                    'rgb(255, 205, 86)',
                                    // 'rgb(54, 162, 235)',
                                    // 'rgb(153, 102, 255)',
                                    // 'rgb(201, 203, 207)'
                                ],
                                borderWidth: 2
                                }]
                            },
                            options: {
                                scales: {
                                y: {
                                    beginAtZero: true
                                }
                                }
                            }
                            });
                        });
                    </script>
                    <!-- End Bar CHart -->

                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Akumulasi <span>| All</span></h5>

                    <!-- Bar Chart -->
                    <canvas id="barChart" style="max-height: 400px;"></canvas>
                    <script>

                        fetch("{{ route('anggota.chart-akumulasi-all') }}")
                            .then((response) => {
                                return response.json();
                            })
                            .then((data) => {
                                data_labels4 = data.data_labels
                                datas4 = data.datas
                            })
                            .catch(function(error) {
                                console.log(error);
                            });

                        data_labels4 = [];
                        datas4 = [];

                        document.addEventListener("DOMContentLoaded", () => {
                            new Chart(document.querySelector('#barChart'), {
                            type: 'bar',
                            data: {
                                labels: data_labels4,
                                datasets: [{
                                label: 'show / hide',
                                data: datas4,
                                backgroundColor: [
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(201, 203, 207, 0.2)'
                                ],
                                borderColor: [
                                    'rgb(54, 162, 235)',
                                    'rgb(153, 102, 255)',
                                    'rgb(201, 203, 207)'
                                ],
                                borderWidth: 2
                                }]
                            },
                            options: {
                                scales: {
                                y: {
                                    beginAtZero: true
                                }
                                }
                            }
                            });
                        });
                    </script>
                    <!-- End Bar CHart -->

                  </div>
                </div>
              </div>
        </div>
    </section>
</main>
@endsection

@section('plugins.Summernote', true)

@section('js-new-dashboard')
    <!-- Vendor JS Files -->
    <script src="{{ asset('asset-new-dashboard/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('asset-new-dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset-new-dashboard/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('asset-new-dashboard/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('asset-new-dashboard/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('asset-new-dashboard/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('asset-new-dashboard/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('asset-new-dashboard/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('asset-new-dashboard/js/main.js') }}"></script>
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
