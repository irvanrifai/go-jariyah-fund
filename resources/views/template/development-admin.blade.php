@extends('admin.index')

@section('title', 'Informasi')

@section('plugins.Summernote', true)

@section('body')

<div class="text-center pt-4">
    <div class="container">
        <div class="col">
            <img class="img-fluid text-center rounded-circle" src="{{ asset('img/static/development.png') }}" alt="" style="min-width: 50px; max-width: 280px; height: auto;">
            <h5 class="text-center pt-4 text-muted">Fitur sedang dalam pengembangan</h5>
        </div>
    </div>
</div>

@stop
