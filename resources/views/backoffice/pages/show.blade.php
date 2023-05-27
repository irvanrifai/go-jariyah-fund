@extends('layouts.public')
@section('classes_body','wbs-topic wbs-topic-new')
@section('public_css')
    <link href="{{ asset('css/public/wbs-style.css') }}" rel="stylesheet">
@stop
@section('public_js')
    <script src="{{ asset('js/public/wbs-script.js') }}"></script>
@stop
@section('body')
    @include('public.components.navbar')
    <div class="container">
        <div class="row">
            <div class="col-8 m-auto">
                <div class="wbs add-topic-wrapper">
                    <h1>Terima Kasih</h1>

                </div>
            </div>
        </div>
    </div>
    @include('public.components.footer')
@stop
