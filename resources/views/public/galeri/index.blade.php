@extends('layouts.public')
@section('classes_body','page-gallery')
@section('title','Galeri')
@section('public_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop
@section('public_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stop
@section('body')
    @include('public.components.navbar')
    <div class="main-gallery">
        <header class="title">
            <h1>
                Galeri Kegiatan
            </h1>
        </header>
        <div class="container content-gallery mb-5">
            <div class="row">
                @foreach($gallery as $img)
                    <div class="col-md-4">
                        <a data-lightbox="kemenkop-gallery"  class="gallery-link" href="{{ $img->image }}" target="_blank">
                            <div class="item-gallery">
                                <div class="cover-img">
                                    @if(! empty( $img->image ))
                                        <img src="{{ $img->image }}" class="img-gallery"
                                             alt="{{ $img->title }}">
                                    @else
                                        <img
                                            src="https://dummyimage.com/600x400/2361a3/f2f2f2.jpg&text=Gambar+Tidak+Ada"
                                            class="img-gallery" alt="Gambar Tidak Ada">
                                    @endif
                                </div>
                                <div class="img-caption">
                                    <h5>{{ $img->title }}</h5>
                                </div>

                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <br>
            <br>
            {{ $gallery->links() }}

    </section>
    </div>
@include('public.components.footer')
@stop
