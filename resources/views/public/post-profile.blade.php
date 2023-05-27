@extends('layouts.public')
@section('classes_body','content-single post-detail')
@section('title',$post->title)
@section('public_js')
<script>
    // Add viewer
        let request = new XMLHttpRequest();
        request.open('GET', '/api/add-post-view/{{$post->id}}', true);

        request.onload = function () {
            if (this.status >= 200 && this.status < 400) {
                // Success!
                let resp = this.response;
                console.log(resp)
            } else {
                console.log('Tidak dapat mengeset viewer. Err: ' + this.status);
            }
        };

        request.send();
</script>
@stop
@section('body')
@include('public.components.navbar')
<div class="container">
    <div class="row" style="margin-bottom: 24px;">
        <div class="col-lg-8 col-md-7 col-sm-12">
            <div class="content-wrapper">
                @if($post->featured_image)
                <img src="{{$post->featured_image}}" alt="{{$post->title}}" class="img-thumbnail img-fluid">
                @endif
                <header class="mt-4" style="text-align: center; padding-bottom: 12px;">
                    <h1>{{$post->title}}</h1>
                </header>
                <div class="main-content">
                    {!! html_entity_decode($post->content) !!}
                </div>
            </div>

            <!-- <div class="col-lg-4 col-md-5 col-sm-12"> -->
            <!-- @include('public.components.content-widget') -->
            <!-- </div> -->
        </div>
        <div class="col-lg-4 col-md-5 col-sm-12" style="margin-top: 36px">
            <aside class="widget-area widget--MenuLinks">
                <div class="widget">
                    @if(isset($is_page))
                    <header class="widget-header">
                        <h3>Profil</h3>
                    </header>
                    <div class="widget-body" style="padding-left: 0px; padding-right: 0px;">
                        <ul class="list-unstyled">
                            <li><a class="dropdown-item" href="/p/sejarah">Sejarah</a></li>
                            <li><a class="dropdown-item" href="/p/visi-misi">Visi Misi</a></li>
                            <li><a class="dropdown-item" href="/p/tugas-pokok-dan-fungsi">Tupoksi</a></li>
                            <li><a class="dropdown-item" href="/p/struktur-kelembagaan">Struktur</a></li>
                            <li><a class="dropdown-item" href="/p/sumber-daya-manusia">SDM</a></li>
                        </ul>
                    </div>
                    @else
                    <header class="widget-header">
                        <h3>Berita Terbaru</h3>
                    </header>
                    <div class="widget-body" style="padding-left: 0px; padding-right: 0px;">
                        <ul class="list-unstyled">
                            <?php $article = \App\Http\Controllers\PostsController::get_article_posts() ?>
                            @foreach($article as $list)
                            <li style="word-wrap: break-word;">
                                <a class="dropdown-item" href="/artikel/{{ $list['slug'] }}">{{ $list['title'] }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </aside>

        </div>

    </div>
</div>
@include('public.components.footer')

@stop