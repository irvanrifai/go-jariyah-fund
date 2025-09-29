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
                        radius: ['30%', '60%'],
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
                            // console.log(data)
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
@stop
