@extends('layouts.public')
@section('classes_body','content-single post-detail')
@section('title','Index Berita')
@section('body')
    @include('public.components.navbar')
    <section class="news-widget">
        <div class="container">
            <div class="row title-section">
                <div class="col-md-6 news-widget__Title">
                    <h3>Berita Terbaru</h3>
                </div>
            </div>
            <div class="row loop-section">
                @foreach($posts as $li)
                    <div class="col-md-4">
                        <a class="news-link" href="/artikel/{{ $li['slug'] }}" target="_blank">
                            <div class="item-news">
                                <div class="cover-img">
                                    @if(! empty( $li['featured_image'] ))
                                        <img src="{{ $li['featured_image'] }}" class="img-news"
                                             alt="{{ $li['title'] }}">
                                    @else
                                        <img
                                            src="https://dummyimage.com/600x400/2361a3/f2f2f2.jpg&text=Gambar+Tidak+Ada"
                                            class="img-news" alt="Gambar Tidak Ada">
                                    @endif
                                </div>
                                <div class="meta-section">
                                    <span class="category">{{ $li['category']['title']  }}</span>
                                    <i class="bi bi-dot"></i>
                                    <span class="date">
                                        {{ $li['created_at']->diffForHumans() }}
                                    </span>
                                </div>
                                <h4 class="item-news__Title">{{ $li['title'] }}</h4>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('public.components.footer')
@stop
