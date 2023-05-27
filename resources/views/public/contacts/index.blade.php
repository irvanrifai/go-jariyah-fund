@extends('layouts.public')
@section('classes_body','page-contacts')
@section('title','Kontak Kami')
@section('body')
    @include('public.components.navbar')

    <?php $list = \App\Http\Controllers\PostsController::get_cached_posts() ?>
    <div class="container">
        <br><br>
        <div class="judul">
            <h1 class="judul-besar"> Kontak Kami </h1>
        </div>
        <br>

        <section id="contact-us" class="section">
            <div class="row justify-content-evenly">
                <div class="col-md-6">
                    <div class="gmaps">
                        <iframe class="responsive-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3148.0853067613352!2d106.82976197147099!3d-6.218985904346796!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3f79a35f997%3A0x3877c5bc98573b28!2sDeputi%20Bidang%20Perkoperasian%20Kementerian%20Koperasi%20dan%20UKM!5e0!3m2!1sen!2sid!4v1626332516250!5m2!1sen!2sid" allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="judul">
                        <h2 class="black-one fs-4 fw-bold">{{$departement->value ?? 'Tidak ada data'}}</h2><br>
                        <p class="black-one">{{$address->value ?? 'Tidak ada data'}}</p>
                    </div><br>

                    <div class="widget contact">
                        <a href="tel:{{$phone->value ?? 'Tidak ada data'}}" class="kontak text-decoration-none">
                            <i class="bi bi-telephone-fill" style="border-radius: 50%; padding: 4px 6.7px; background-color: #3c4d7b; color: #fff; font-size: 13px;"></i> &nbsp;<span class="num">{{$phone->value ?? 'Tidak ada data'}}</span></a>
                    </div>
                    <div class="widget contact">
                        <a href="mailto:{{$email->value ?? 'Tidak ada data'}}" class="kontak text-decoration-none">
                            <i class="bi bi-envelope-fill" style="border-radius: 50%; padding: 4px 6.7px; background-color: #3c4d7b; color: #fff; font-size: 13px;"></i> &nbsp;<span class="mail">{{$email->value ?? 'Tidak ada data'}}</span></a>
                    </div><br>
                    <div class="widget contact">
                        <p class="judul-kecil">Ikuti Kami</p>
                        <ul class="list-social-inline">
                            <li><a href="{{$instagram->value ?? 'Tidak ada data'}}" target="_blank"><i class="bi bi-instagram instagram"></i></a></li>
                            <li><a href="{{$twitter->value ?? 'Tidak ada data'}}" target="_blank"><i class="bi bi-twitter twitter"></i></a></li>
                            <li><a href="{{$facebook->value ?? 'Tidak ada data'}}" target="_blank"><i class="bi bi-facebook facebook"></i></a></li>
                            <li><a href="{{$youtube->value ?? 'Tidak ada data'}}" target="_blank"><i class="bi bi-youtube youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

    </div><br><br>
    @include('public.components.footer')
@stop