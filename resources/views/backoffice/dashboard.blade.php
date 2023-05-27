@extends('adminlte::page')

@section('title', 'Dashboard')

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

@section('content_header_title', 'Dashboard')
@section('content_header_prev_link', 'dashboard')

@section('plugins.Summernote', true)


@section('content')

<main id="main" class="main">

    <section class="section dashboard">
        <div class="row">

          <!-- Left side columns -->
          <div class="col-lg-12">
            <div class="row">

              <!-- Sales Card -->
              <div class="col-xxl-3 col-md-3">
                <div class="card info-card customers-card">

                  <div class="card-body">
                    <h5 class="card-title">Total Ajuan <span>| Anda</span></h5>

                    <div class="d-inline-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-person"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $user_ajuan }}</h6>
                        <span class="text-success small pt-1 fw-bold">0%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- End Sales Card -->

              <!-- Sales Card -->
              <div class="col-xxl-3 col-md-3">
                <div class="card info-card revenue-card">

                  <div class="card-body">
                    <h5 class="card-title">Total Approved <span>| Anda</span></h5>

                    <div class="d-inline-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-person"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $user_ajuan_acc }}</h6>
                        <span class="text-success small pt-1 fw-bold">0%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- End Sales Card -->

              <!-- Sales Card -->
              <div class="col-xxl-3 col-md-3">
                <div class="card info-card customers-card">

                  <div class="card-body">
                    <h5 class="card-title">Total Ajuan <span>| Members</span></h5>

                    <div class="d-inline-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $group_ajuan }}</h6>
                            <span class="text-success small pt-1 fw-bold">0%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                        </div>
                    </div>
                </div>

                </div>
              </div><!-- End Sales Card -->

              <!-- Sales Card -->
              <div class="col-xxl-3 col-md-3">
                <div class="card info-card revenue-card">

                  <div class="card-body">
                    <h5 class="card-title">Total Approved <span>| Members</span></h5>

                    <div class="d-inline-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $group_ajuan_acc }}</h6>
                        <span class="text-success small pt-1 fw-bold">0%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- End Sales Card -->

            </div>
          </div><!-- End Left side columns -->

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Pinjaman Aktif <span>| Anda</span></h5>

                <!-- Pie Chart -->
                <div id="piePieChart" style="min-height: 400px;" class="echart"></div>

                <script>
                fetch("{{ route('anggota.chart-pinjaman-aktif-anda') }}")
                        .then((response) => {
                            return response.json();
                        })
                        .then((data) => {
                            datas1 = data
                        })
                        .catch(function(error) {
                            console.log(error);
                        });

                datas1 = [];

                  document.addEventListener("DOMContentLoaded", () => {
                    echarts.init(document.querySelector("#piePieChart")).setOption({
                      tooltip: {
                        trigger: 'item'
                      },
                      legend: {
                        orient: 'vertical',
                        left: 'right',
                        bottom: '5%'
                      },
                      series: [{
                        name: 'Data From',
                        type: 'pie',
                        radius: ['20%', '50%'],
                        data: datas1,
                        emphasis: {
                          itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                          }
                        }
                      }]
                    });
                  });
                </script>
                <!-- End Pie Chart -->

              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Akumulasi <span>| Anda</span></h5>

                <!-- Donut Chart -->
                <div id="donutDonutChart" style="min-height: 400px;" class="echart py-3"></div>

                <script>

                fetch("{{ route('anggota.chart-akumulasi-anda') }}")
                        .then((response) => {
                            return response.json();
                        })
                        .then((data) => {
                            datas2 = data
                        })
                        .catch(function(error) {
                            console.log(error);
                        });

                datas2 = [];

                  document.addEventListener("DOMContentLoaded", () => {
                    echarts.init(document.querySelector("#donutDonutChart")).setOption({
                      tooltip: {
                        trigger: 'item'
                      },
                      legend: {
                        orient: 'vertical',
                        left: 'right',
                        bottom: '1%'
                      },
                      series: [{
                        name: 'Data From',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                          show: false,
                          position: 'center'
                        },
                        emphasis: {
                          label: {
                            show: true,
                            fontSize: '18',
                            fontWeight: 'bold'
                          }
                        },
                        labelLine: {
                          show: false
                        },
                        data: datas2
                      }]
                    });
                  });
                </script>
                <!-- End Donut Chart -->

              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Pengumpulan Dana Wakaf <span>| All</span></h5>

                <!-- Pie Chart -->
                <div id="pieChart" class="py-4"></div>

                <script>
                    fetch("{{ route('anggota.chart-pengumpulan-dana-wakaf-all') }}")
                        .then((response) => {
                            return response.json();
                        })
                        .then((data) => {
                            // temp used
                            let IDR = new Intl.NumberFormat('en-DE', {
                                style: 'currency',
                                currency: 'IDR'
                            });

                            data_series1 = data.data_series
                            data_labels1 = data.data_labels
                        })
                        .catch(function(error) {
                            console.log(error);
                        });

                    data_series1 = [];
                    data_labels1 = [];

                    document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#pieChart"), {
                        series: data_series1,
                        chart: {
                            height: 350,
                            type: 'pie',
                            toolbar: {
                            show: false
                            }
                        },noData: {
                            text: undefined,
                            align: 'center',
                            verticalAlign: 'middle',
                            offsetX: 0,
                            offsetY: 0,
                            style: {
                                color: undefined,
                                fontSize: '14px',
                                fontFamily: undefined
                            }
                        },
                        labels:data_labels1
                        }).render();
                    });

                </script>

              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Peminjaman Dana Wakaf <span>| All</span></h5>

                <!-- Donut Chart -->
                <div id="donutChart" class="py-4"></div>

                <script>

                    fetch("{{ route('anggota.chart-peminjaman-dana-wakaf-all') }}")
                        .then((response) => {
                            return response.json();
                        })
                        .then((data) => {
                            console.log(data)
                            data_series2 = data.data_series
                            data_labels2 = data.data_labels
                        })
                        .catch(function(error) {
                            console.log(error);
                        });

                    data_series2 = [];
                    data_labels2 = [];

                    document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#donutChart"), {
                        series: data_series2,
                        chart: {
                            height: 350,
                            type: 'donut',
                            toolbar: {
                            show: false
                            }
                        },
                        noData: {
                            text: undefined,
                            align: 'center',
                            verticalAlign: 'middle',
                            offsetX: 0,
                            offsetY: 0,
                            style: {
                                color: undefined,
                                fontSize: '14px',
                                fontFamily: undefined
                            }
                        },
                        labels: data_labels2,
                        }).render();
                    });
                </script>
                <!-- End Donut Chart -->

              </div>
            </div>
          </div>

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

    {{-- renew dashboard --}}
    {{-- <div class="row -p-2">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <b>
                        <h4>
                            {{ $data }}
                        </h4>
                    </b>
                    <p>Total Pengajuan Pribadi</p>
                </div>
                <div class="icon">
                    <i class="fas fa-copy"></i>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="anggota/riwayatpeminjaman" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <b>
                        <h4>
                            {{ $get }}
                        </h4>
                    </b>
                    <p>Total Pengajuan Pribadi Yang Disetujui </p>
                </div>
                <div class="icon">
                    <i class="fas fa-thumbs-up"></i>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="anggota/riwayatpeminjaman" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <b>
                        <h4>
                            {{ $group }}
                        </h4>
                    </b>
                    <p>Total Pengajuan Seluruh Anggota</p>
                </div>
                <div class="icon">
                    <i class="fas fa-copy"></i>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="anggota/riwayatpeminjaman" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <b>
                        <h4>
                            {{ $accgroup }}
                        </h4>
                    </b>
                    <p>Total Pengajuan Anggota Yang Disetujui</p>
                </div>
                <div class="icon">
                    <i class="fas fa-thumbs-up"></i>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="anggota/riwayatpeminjaman" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div> --}}

    {{-- <div class="row p-3">
        <div class="col-lg-6">
            <!-- small card -->

            <div class="card card-warning">
                <div class="card-header">
                    <h4 class="card-title">Data Pengumpulan Dana Wakaf</h4>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                </div> <!-- tutup card header -->

                <div class="inner" id="inner-view">
                    <center>
                        <div id="chart_wrap">
                            <div id="mychart"></div>
                        </div>
                    </center>
                </div>
            </div>
            <!--tutup card info-->
        </div>
        <!--tutup md-6-->

        <div class="col-lg-6">
            <!-- small card -->
            <div class="small-box">
                <div class="card card-info">
                    <div class="card-header">
                        <h4 class="card-title">Data Peminjaman Dana Wakaf</h4>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="inner" id="inner-view">
                        <center>
                            <div id="chart_wrap">
                                <div id="mychart2"></div>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="row p-3">
        <div class="col-lg-6">
            <!-- small card -->

            <div class="card card-success">
                <div class="card-header">
                    <h4 class="card-title">Grafik Aktif Peminjaman</h4>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                </div> <!-- tutup card header -->

                <div class="inner" id="inner-view">
                    <center>
                        <div id="chart_wrap">
                            <div id="mychart3"></div>
                        </div>
                    </center>
                </div>
            </div>
            <!--tutup card info-->
        </div>
        <!--tutup md-6-->

        <div class="col-lg-6">
            <!-- small card -->
            <div class="small-box">
                <div class="card card-danger">
                    <div class="card-header">
                        <h4 class="card-title">Grafik Akumulasi</h4>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="inner" id="inner-view">
                        <center>
                            <div id="chart_wrap">
                                <div id="mychart4"></div>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="row">
        <div class="col-lg-6">
            <!-- small card -->
            <div class="small-box bg-default">
                <div class="inner">
                    <center>
                        <h4>Saran Belum Dibaca</h4>
                    </center>
                    <div id="chart_wrap">
                        <div id="mychart5"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <!-- small card -->
            <div class="small-box bg-default">
                <div class="inner">
                    <center>
                        <h4>Saran Belum Dibaca</h4>
                    </center>
                    <div id="chart_wrap">
                        <div id="mychart6"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    </div>
    </div>
    </div>
    </div>
@stop

@section('adminlte_js')

    <?php

    ?>

    <!-- jQuery Knob -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


    {{-- <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        //javascript:alert(document.body.offsetWidth);
        //var textOut= "Height : " + element.offsetHeight + "px<br>";
        //textOut += "Width : " + element.offsetWidth + "px";

        function drawChart() {
            var element = document.getElementById("inner-view");
            var ukuran = element.offsetWidth;
            //javascripT:alert(element.offsetWidth);

            var data = google.visualization.arrayToDataTable([
                ['Nama', 'Kota'],
                <?php
                //use\App\Http\Controllers\ChartController;
                $result = DB::select(
                    DB::raw("select SUM(wakaf_base) as total, wakaf_base from pa_transaction
                            where transaction_status='complete' group by wakaf_base"),
                );
                //dd($result);
                $charData = '';
                foreach ($result as $list) {
                    $charData .= "['" . $list->wakaf_base . "', " . $list->total . '],';
                }

                $arr['charData'] = rtrim($charData, ',');
                echo $charData; ?>
            ]);

            var options = {
                'legend': 'top',
                'width': '100%',
                'height': 70 / 100 * ukuran,
                colors: ['#FFA500', '#FFD700', '#F0E68C', '#f3b49f', '#f6c7b6']
            };

            var chart = new google.visualization.PieChart(document.getElementById('myChart'));
            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);


        function drawChart() {
            var element = document.getElementById("inner-view");
            var ukuran = element.offsetWidth;

            var data = google.visualization.arrayToDataTable([
                ['Nama', 'Kota'],
                <?php

                //use\App\Http\Controllers\ChartController;
                //$result=DB::select(DB::raw("select count(wakaf_base) as jumlah, SUM(wakaf_base*wakaf_qty) as total, wakaf_base from pa_transaction where transaction_status='complete' group by wakaf_base"));
                $result = DB::select(DB::raw('select count(wakaf_base) as jumlah, SUM(wakaf_base) as total_pribadi from `pa_transaction` where ref_code IS NOT NULL'));
                //$result = DB::select(DB::raw("select count(wakaf_base) as jumlah, SUM(wakaf_base) AS total_project FROM `pa_transaction` where ref_code='3ko2U' group by wakaf_base"));
                $Data = '';
                foreach ($result as $list) {
                    $Data .= "['" . $list->jumlah . "', " . $list->total_pribadi . '],';
                }

                $arr['Data'] = rtrim($Data, ',');
                echo $Data; ?>
            ]);

            var options = {
                'legend': 'top',
                'width': '100%',
                'height': 70 / 100 * ukuran,
                colors: ['#00CED1', '#87cefa', '#f3b49f', '#f6c7b6']

            };

            var chart = new google.visualization.PieChart(document.getElementById('mychart2'));
            chart.draw(data, options);
        }
    </script>

    <!--DIPAKE-->
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Density", {
                    role: "style"
                }],
                ["Total Dipinjam",
                    5 * 5, "#b87333"
                ],
                ["Total Lunas", 10.49, "silver"],
                ["Kekurangan Bayar", 19.30, "gold"],
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);

            var options = {
                title: "Density of Precious Metals, in g/cm^3",
                width: 490,
                height: 300,
                bar: {
                    groupWidth: "40%"
                },
                legend: {
                    position: "none"
                },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("mychart3"));
            chart.draw(view, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Density", {
                    role: "style"
                }],
                ["Total Dipinjam", 8.94, "#b87333"],
                ["Total Lunas", 10.49, "silver"],
                ["Kekurangan Bayar", 19.30, "gold"],
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);

            var options = {
                title: "Density of Precious Metals, in g/cm^3",
                width: 490,
                height: 300,
                bar: {
                    groupWidth: "40%"
                },
                legend: {
                    position: "none"
                },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("mychart4"));
            chart.draw(view, options);
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows([
                ['Mushrooms', 3],
                ['Onions', 1],
                ['Olives', 1],
                ['Zucchini', 1],
                ['Pepperoni', 2]
            ]);

            var options = {
                'width': 420,
                'legend': 'top',
                'height': 300
            };

            var chart = new google.visualization.PieChart(document.getElementById('mychart5'));
            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows([
                ['Mushrooms', 3],
                ['Onions', 1],
                ['Olives', 1],
                ['Zucchini', 1],
                ['Pepperoni', 2]
            ]);

            var options = {
                'width': 420,
                'legend': 'top',
                'height': 300
            };
            var chart = new google.visualization.PieChart(document.getElementById('mychart6'));
            chart.draw(data, options);
        }
    </script>

    <style type="text/css">
        #chart_wrap {
            position: relative;
            padding-bottom: 60%;
            width: 100%;
            height: 0;
            overflow: hidden;
        }

        #mychart {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 0;
        }

        #mychart2 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 0;
        }

        #mychart3 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 0;
        }

        #mychart4 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 0;
        }

        #mychart5 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 0;
        }

        #mychart6 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 0;
        }
    </style> --}}
@stop
