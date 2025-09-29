@extends('admin.layout.main')

@section('title', 'Dashboard')

@section('css-new-dashboard')

    <!-- Vendor CSS Files -->
    <link href="{{ asset('asset-new-dashboard/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset-new-dashboard/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('asset-new-dashboard/css/style.css') }}" rel="stylesheet">

@endsection

@section('body')
<div class="content">
  <h4 class="pt-3 px-3"> Dashboard Admin </h4>

  <div class="container-fluid">

    <main id="main" class="main">

        <section class="section dashboard">
            <div class="row">

              <!-- Left side columns -->
              <div class="col-lg-12">
                <div class="row">

                  <!-- Sales Card -->
                  <div class="col-xxl-3 col-md-3">
                    <div class="card info-card sales-card">

                      <div class="card-body">
                        <h5 class="card-title"><span>Total |</span> Group</h5>

                        <div class="d-inline-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                          </div>
                          <div class="ps-3">
                            <h6>{{ $totalgroup }}</h6>
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
                        <h5 class="card-title"><span>Total |</span> Anggota</h5>

                        <div class="d-inline-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-person"></i>
                          </div>
                          <div class="ps-3">
                            <h6>{{ $totalkelompok }}</h6>
                            <span class="text-success small pt-1 fw-bold">0%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                          </div>
                        </div>
                      </div>

                    </div>
                  </div><!-- End Sales Card -->

                  <!-- Sales Card -->
                  <div class="col-xxl-3 col-md-3">
                    <div class="card info-card sales-card">

                      <div class="card-body">
                        <h5 class="card-title"><span>Total |</span> Ajuan Pinjaman</h5>

                        <div class="d-inline-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-folder-plus"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $totalajuan }}</h6>
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
                        <h5 class="card-title"><span>Total |</span> Pinjaman Aktif</h5>

                        <div class="d-inline-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-wallet2"></i>
                          </div>
                          <div class="ps-3">
                            <h6>{{ $req }}</h6>
                            <span class="text-danger small pt-1 fw-bold">0%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

                          </div>
                        </div>
                      </div>

                    </div>
                  </div><!-- End Sales Card -->

                </div>
              </div><!-- End Left side columns -->

              <!-- Left side columns -->
              <div class="col-lg-12">
                <div class="row">

                  <!-- Sales Card -->
                  <div class="col-xxl-4 col-md-4">
                    <div class="card info-card revenue-card">

                      <div class="card-body">
                        <h5 class="card-title"><span>Total Nominal |</span> Pinjaman Aktif</h5>

                        <div class="d-inline-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cash"></i>
                          </div>
                          <div class="ps-3">
                            <h4 class="text-lg" style="color: midnightblue"><small>Rp. {{ number_format($acc, 2, ',', '.') }}</small></h4>
                            <span class="text-success small pt-1 fw-bold">0%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                          </div>
                        </div>
                      </div>

                    </div>
                  </div><!-- End Sales Card -->

                  <!-- Sales Card -->
                  <div class="col-xxl-4 col-md-4">
                    <div class="card info-card customers-card">

                      <div class="card-body">
                        <h5 class="card-title"><span>Total Nominal |</span> Sisa Pinjaman</h5>

                        <div class="d-inline-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cash"></i>
                          </div>
                          <div class="ps-3">
                            <h4 class="text-lg" style="color: midnightblue"><small>Rp. {{ number_format($fin, 2, ',', '.') }}</small></h4>
                            <span class="text-danger small pt-1 fw-bold">0%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

                          </div>
                        </div>
                      </div>

                    </div>
                  </div><!-- End Sales Card -->

                  <!-- Sales Card -->
                  <div class="col-xxl-4 col-md-4">
                    <div class="card info-card sales-card">

                      <div class="card-body">
                        <h5 class="card-title"><span>Total |</span> Dana Bersama</h5>

                        <div class="d-inline-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cash-coin"></i>
                            </div>
                            <div class="ps-3">
                                <h4 class="text-lg" style="color: midnightblue"><small>Rp. {{ number_format($tomu, 2, ',', '.') }}</small></h4>
                                <span class="text-success small pt-1 fw-bold">0%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                            </div>
                        </div>
                    </div>

                    </div>
                  </div><!-- End Sales Card -->

                </div>
              </div><!-- End Left side columns -->

              <!-- Left side columns -->
              <div class="col-lg-12">
                <div class="row">

                  <!-- Sales Card -->
                  <div class="col-xxl-4 col-md-4">
                    <div class="card info-card customers-card">

                      <div class="card-body">
                        <h5 class="card-title"><span>Total Dana |</span> Belum Dipinjam</h5>

                        <div class="d-inline-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cash-stack"></i>
                          </div>
                          <div class="ps-3">
                            <h4 class="text-lg" style="color: midnightblue"><small>Rp. {{ number_format($final, 2, ',', '.') }}</small></h4>
                            <span class="text-danger small pt-1 fw-bold">0%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

                          </div>
                        </div>
                      </div>

                    </div>
                  </div><!-- End Sales Card -->

                  <!-- Sales Card -->
                  <div class="col-xxl-4 col-md-4">
                    <div class="card info-card sales-card">

                      <div class="card-body">
                        <h5 class="card-title"><span>Total Dana |</span> Seluruh Kelompok</h5>

                        <div class="d-inline-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                          </div>
                          <div class="ps-3">
                            <h4 class="text-lg" style="color: midnightblue"><small>Rp. {{ number_format($total_all, 2, ',', '.') }}</small></h4>
                            <span class="text-success small pt-1 fw-bold">0%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                          </div>
                        </div>
                      </div>

                    </div>
                  </div><!-- End Sales Card -->

                </div>
              </div><!-- End Left side columns -->

            </div>
          </section>
    </main>

    <!-- Small boxes (Stat box) -->

    {{-- dashboard card renew --}}

    {{-- <div class="row">
      <div class="col-lg-3">
        <!-- small box -->
        <div class="small-box" style="background-color:#4897D8">
          <center>
            <h1><i class="ion ion-person-stalker" style="margin-top:10px;opacity: .5;padding:2px;"></h1></i>
          </center>
          <!-- border: 1px solid white;border-radius: 15px;-->
          <div class="inner">
            <center><b>
                <h4>{{$totalgroup}}
              </b></h4>
              <p>Total Kelompok </p>
            </center>
          </div>
        </div>
      </div>

      <div class="col-lg-3">
        <!-- small box -->
        <div class="small-box" style="background-color:#FFDB5C">
          <center>
            <h1><i class="ion ion-person" style="margin-top:10px;opacity: .5;padding:2px;"></h1></i>
          </center>
          <!--border: 1px solid white;
  border-radius: 15px;-->
          <div class="inner">
            <center><b>
                <h4>{{$totalkelompok}}
              </b></h4>
              <p>Total Anggota</p>
            </center>
          </div>
        </div>
      </div>

      <div class="col-lg-3">
        <!-- small box -->
        <div class="small-box" style="background-color:#FA6E59">
          <center>
            <h1><i class="ion ion-map img-circle" style="opacity: .8;padding:10px;"></h1></i>
          </center>
          <div class="inner">
            <center><b>
                <h4>{{$totalajuan}}
              </b></h4>
              <p>Ajuan Pinjaman</p>
            </center>
          </div>
        </div>
      </div>

      <div class="col-lg-3">
        <!-- small box -->
        <div class="small-box" style="background-color:#F8A055">
          <center>
            <h1><i class="ion ion-bookmark img-circle" style="opacity: .8;padding:10px;"></h1></i>
          </center>
          <div class="inner">
            <center><b>
                <h4>{{$req}}
              </b></h4>
              <p>Total Pinjaman Aktif</p>
            </center>
          </div>
        </div>
      </div>


      <div class="col-lg-3">
        <!-- small box -->
        <div class="small-box" style="background-color: #FFDB5C">
          <center>
            <h1><i class="ion ion-social-usd" style="margin-top:10px;opacity: .5;padding:2px;
 "></h1></i>
          </center>
          <div class="inner">
            <center><b>
                <h4>{{"Rp".number_format($final)}}
              </b></h4>
              <p> Total Dana Belum Dipinjam</p>
            </center>
          </div>
        </div>
      </div>

      <div class="col-lg-3">
        <!-- small box -->
        <div class="small-box" style="background-color: #FA6E59 ">
          <center>
            <h1><i class="ion ion-social-usd" style="margin-top:10px;opacity: .5;padding:2px;"></h1></i>
          </center>
          <div class="inner">
            <center><b>
                <h4>
              </b></h4>
              <p> Total Dana Seluruh Kelompok</p>
            </center>
          </div>
        </div>
      </div>


      <div class="col-lg-3">
        <!-- small box -->
        <div class="small-box" style="background-color: #F8A055">
          <center>
            <h1><i class="ion ion-social-usd img-circle" style="opacity: .8;padding:10px;"></h1></i>
          </center>
          <div class="inner">
            <center><b>
                <h4>{{"Rp".number_format($acc)}}
              </b></h4>
              <p>Total Nominal Pinjaman Aktif</p>
            </center>
          </div>
        </div>
      </div>

      <div class="col-lg-3">
        <!-- small box -->
        <div class="small-box" style="background-color:#4897D8">
          <center>
            <h1><i class="ion ion-social-usd img-circle" style="opacity: .8;padding:10px;"></h1></i>
          </center>
          <div class="inner">
            <center><b>
                <h4>{{"Rp".number_format($fin)}}
              </b></h4>
              <p>Total Nominal Sisa Pinjaman</p>
            </center>
          </div>
        </div>
      </div>

      <div class="col-lg-3">
        <!-- small box -->
        <div class="small-box" style="background-color:#4897D8">
          <center>
            <h1><i class="ion ion-social-usd img-circle" style="opacity: .8;padding:10px;"></h1></i>
          </center>
          <div class="inner">
            <center><b>
                <h4>{{"Rp".number_format($tomu)}}
              </b></h4>
              <p>Total Dana Bersama</p>
            </center>
          </div>
        </div>
      </div> --}}

@section('js-new-dashboard')
    <!-- Vendor JS Files -->
    <script src="{{ asset('asset-new-dashboard/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('asset-new-dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset-new-dashboard/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('asset-new-dashboard/vendor/echarts/echarts.min.js') }}"></script>
    <!-- <script src="{{ asset('asset-new-dashboard/vendor/quill/quill.min.js') }}"></script> -->
    <!-- <script src="{{ asset('asset-new-dashboard/vendor/simple-datatables/simple-datatables.js') }}"></script> -->
    <!-- <script src="{{ asset('asset-new-dashboard/vendor/tinymce/tinymce.min.js') }}"></script> -->
    <!-- <script src="{{ asset('asset-new-dashboard/vendor/php-email-form/validate.js') }}"></script> -->

    <!-- Template Main JS File -->
    <script src="{{ asset('asset-new-dashboard/js/main.js') }}"></script>
@endsection

@endsection

