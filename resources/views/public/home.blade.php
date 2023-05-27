@extends('layouts.public')
@section('classes_body','homepage')
@section('title','Selamat Datang di Deputi Bidang Kewirausahaan')
@section('body')
@section('public_css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css"
    integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop
@section('public_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"
    integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stop
<header class="header-container">
    <div class="bg-home-static bg-dot-nusantara"></div>
    @include('public.components.navbar-home')
    <div class="slider-home">
        @include('public.components.slider-home')
    </div>
</header>
<section class="welcome-hero">
    <div class="container bg-dot-nusantara-grey">
        <div class="row">
            <div class="col-md-12">
                <div class="content-wrapper">
                    <div class="sub-title">
                        <i class="bi bi-dash-lg"></i> &nbsp;SEKILAS TENTANG DEPUTI BIDANG KEWIRAUSAHAAN
                    </div>
                    <h2>
                        {{$title->value ?? ''}}
                    </h2>
                    <p>
                        {{$description->value ?? 'Tidak ada data'}}
                    </p>
                    <div class="cta-wrapper">
                        <a href="/tentang-kami" class="btn btn--gold">
                            SELENGKAPNYA
                        </a>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6 bg-dot-blue">
                <div class="cta-thumbnail-wrapper">
                    <div class="cta-video-cover">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#homeVideoModal">

                            @if(! empty( $img['image'] ))
                                <img src="{{$pict_modal->value ?? 'Tidak ada data'}}" class="img-gallery">
                            @else
                                <img
                                    src="https://i.ibb.co/NS2X2Yv/muhammad-faiz-zulkeflee-alw-Cw-GFmw-Q-unsplash-1.png"
                                    class="img-gallery" alt="Gambar Tidak Ada">
                            @endif
                        </a>
                    </div>
                    <div class="play-btn">

                        <a href="#" data-bs-toggle="modal" data-bs-target="#homeVideoModal">
                            <svg width="97" height="97" viewBox="0 0 97 97" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="49" cy="49" r="36" fill="#3C4D7B" fill-opacity="0.7" />
                                <circle cx="48.5" cy="48.5" r="48.5" fill="#3C4D7B" fill-opacity="0.7" />
                                <path
                                    d="M73 49C73 55.3652 70.4714 61.4697 65.9706 65.9706C61.4697 70.4714 55.3652 73 49 73C42.6348 73 36.5303 70.4714 32.0294 65.9706C27.5286 61.4697 25 55.3652 25 49C25 42.6348 27.5286 36.5303 32.0294 32.0294C36.5303 27.5286 42.6348 25 49 25C55.3652 25 61.4697 27.5286 65.9706 32.0294C70.4714 36.5303 73 42.6348 73 49ZM45.37 40.279C45.1457 40.1193 44.8818 40.0244 44.6072 40.0048C44.3325 39.9851 44.0578 40.0414 43.813 40.1675C43.5683 40.2936 43.3629 40.4846 43.2195 40.7197C43.0761 40.9547 43.0002 41.2247 43 41.5V56.5C43.0002 56.7753 43.0761 57.0453 43.2195 57.2803C43.3629 57.5154 43.5683 57.7064 43.813 57.8325C44.0578 57.9586 44.3325 58.0149 44.6072 57.9952C44.8818 57.9756 45.1457 57.8807 45.37 57.721L55.87 50.221C56.0644 50.0822 56.2229 49.8991 56.3323 49.6867C56.4417 49.4743 56.4987 49.2389 56.4987 49C56.4987 48.7611 56.4417 48.5257 56.3323 48.3133C56.2229 48.1009 56.0644 47.9178 55.87 47.779L45.37 40.279Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>

<div class="bg-half-circle">
    <section class="wbs-stats">
        <div class="container">
            <div class="stats-container bg-dot-nusantara">
                <div class="row title-section">
                    <div class="col-md-9">
                        <div class="stats-title">
                            <h3>Statistik Layanan Sistem Informasi Pengaduan Interaktif dan Responsif (SI PINTAR)</h3>
                            <p>Deputi Bidang Kewirausahaan</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-read-more text-ls-2">
                            <a href="/wbs">Selengkapnya &nbsp;<i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="wbs-stats-item new">
                            <div class="stats-icon">
                                <i class="bi bi-file-earmark-plus"></i>
                            </div>

                            <div class="stats-text">
                                <label for="bi-file-arrow-down">Laporan Masuk</label>
                                {{-- <p id="stats-new">{{$laporan_masuk}}</p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="wbs-stats-item on-process">
                            <div class="stats-icon">
                                <i class="bi bi-file-earmark-break"></i>
                            </div>

                            <div class="stats-text">
                                <label for="stats-process">Laporan Diproses</label>
                                {{-- <p id="stats-process">{{$laporan_proses}}</p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="wbs-stats-item finish">
                            <div class="stats-icon">
                                <i class="bi bi-file-earmark-check"></i>
                            </div>

                            <div class="stats-text">
                                <label for="stats-finish">Laporan Selesai</label>
                                {{-- <p id="stats-finish">{{$laporan_selesai}}</p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="wbs-stats-item no-response">
                            <div class="stats-icon">
                                <i class="bi bi-file-earmark-excel"></i>
                            </div>

                            <div class="stats-text">
                                <label for="stats-finish">Tidak Diproses</label>
                                {{-- <p id="stats-finish">{{$laporan_tidak_diproses}}</p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="footer-wrapper">
                            <div class="text-lable">
                                <p>Layanan SI PINTAR</p>
                            </div>
                            <div class="cta-link">
                                <a href="/wbs" class="btn btn--white">Laporkan Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    {{-- @if ($employee->is_active == 1)
    <section class="best-performer">
        <div class="container bg-dot-yellow" style="padding-top: 10px; padding-bottom: 10px">
            <div class="row justify-content-md-center">
                <div class="col-md-4">
                    <div class="profile-thumbnail-wrapper">
                        <div class="profile-cover">
                            <img src="{{$employee->photo ?? 'https://cdn.id9.site/temp/christina-wocintechchat-com-0Zx1bDv5BNY-unsplash-1200.jpg'}}"
                                alt="Image Profile">
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="content-wrapper">
                        <h2>
                            Karyawan Terbaik.
                        </h2>
                        <p>
                            {{$best_employee_desc->value ?? ''}}
                        </p>

                        <div class="mini-list">
                            {!! html_entity_decode($employee->content) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif --}}
</div>

<section class="news-widget">
    <div class="container">
        <div class="row title-section">
            <div class="col-md-6 news-widget__Title">
                <h3>Berita Terbaru</h3>
            </div>
            <div class="col-md-6 news-widget__BlogLink text-ls-2"><a class="float-right" href="/artikel">Selengkapnya
                    &nbsp;
                    <i class="bi bi-arrow-right"></i></a></div>
        </div>
        <div class="row loop-section">
            {{-- @foreach($post as $li) --}}
            {{-- <div class="col-md-4">
                <a class="news-link" href="/artikel/{{ $li['slug'] }}" target="_blank">
                    <div class="item-news">
                        <div class="cover-img">
                            {{-- @if(! empty( $li['featured_image'] ))
                            <img src="{{ $li['featured_image'] }}" class="img-news" alt="{{ $li['title'] }}">
                            @else
                            <img src="https://dummyimage.com/600x400/2361a3/f2f2f2.jpg&text=Gambar+Tidak+Ada"
                                class="img-news" alt="Gambar Tidak Ada">
                            @endif
                        </div>
                        <div class="meta-section">
                            <!-- <span class="category">{-- $li['category']['title']  --}</span> -->
                            <span class="category">{{ $li->categories->title  }}</span>
                            <i class="bi bi-dot"></i>
                            <span class="date">
                                {{ $li['created_at']->diffForHumans() }}
                            </span>
                            <span class="current-view">
                                <i class="bi bi-eye"></i>&nbsp; {{ $li['views'] }}
                            </span>
                        </div>
                        <h4 class="item-news__Title">{{ $li['title'] }}</h4> --}}
                    {{-- </div>
                </a>
            </div>
            @endforeach --}}
        </div>
    </div>
</section>


<section class="main-gallery">
    <header class="title">
        <h3>
            Galeri Kegiatan
        </h3>
    </header>
    <div class="container content-gallery">
        <div class="row">
            <?php
            use App\Models\Gallery;
            $gallery = Gallery::take(50)->where('is_show', 1)->get();
            ?>
            @foreach($gallery as $img)
            <div class="col-md-4">
                <a class="gallery-link" href="{{ $img['image'] }}" data-lightbox="kemenkop-gallery" target="_blank">
                    <div class="item-gallery">
                        <div class="cover-img">
                            @if(! empty( $img['image'] ))
                            <img src="{{ $img['image'] }}" class="img-gallery" alt="{{ $img['title'] }}">
                            @else
                            <img src="https://dummyimage.com/600x400/2361a3/f2f2f2.jpg&text=Gambar+Tidak+Ada"
                                class="img-gallery" alt="Gambar Tidak Ada">
                            @endif
                        </div>
                        <div class="img-caption">
                            <h5>{{ $img['title'] }}</h5>
                        </div>

                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

</section>
<!-- Modal -->
<div class="modal fade" id="homeVideoModal" tabindex="-1" aria-labelledby="homeVideoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="homeVideoModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe width="100%" height="390" src="{{$link_modal->value ?? 'Tidak ada data'}}"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@include('public.components.footer')
@stop
