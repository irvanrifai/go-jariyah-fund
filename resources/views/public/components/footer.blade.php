<footer class="bg-dot-nusantara main-footer">
    <?php $address = \App\Http\Controllers\WebsiteSettingsController::footer('address') ?>
    <?php $instagram = \App\Http\Controllers\WebsiteSettingsController::footer('instagram') ?>
    <?php $twitter = \App\Http\Controllers\WebsiteSettingsController::footer('twitter') ?>
    <?php $facebook = \App\Http\Controllers\WebsiteSettingsController::footer('facebook') ?>
    <?php $youtube = \App\Http\Controllers\WebsiteSettingsController::footer('youtube') ?>
    <?php $phone = \App\Http\Controllers\WebsiteSettingsController::footer('phone') ?>
    <div class="container mf-widget">
        <div class="row">
            <div class="col-lg-5 col-md-4 col-sm-12">
                <div class="widget logo">
                    <a class="footer-brand" href="{{ env('APP_URL') }}">
                        <img src="/img/static/main-logo-small.png" alt="{{ env('APP_NAME') }}" class="footer-logo">
                    </a>
                </div>

                <div class="widget office">
                    <hr class="hr-37">
                    <h4 class="gold-title">Kantor Pusat</h4>
                            <p>{{$address}}</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="widget footer-links">
                    <h4 class="gold-title">Zona Integritas</h4>
                    <ul class="list-link">
                        <li><a href="/wbs">Pengaduan SI PINTAR</a></li>
                        {{-- <li><a href="{{ route('benturan.kepentingan.form') }}">Benturan Kepentingan</a></li> --}}
                        <li><a href="/tambah_gratifikas">Gratifikasi</a></li>
                        <li><a href="https://www.lapor.go.id/" target="_blank">SP4N-Lapor</a></li>
                        <li><a href="/form/pelayanan-publik">Survei Kepuasan Masyarakat</a></li>
                        <li><a href="/saran">Saran</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-12">
                <div class="widget footer-contact">
                    <a href="tel:{{$phone}}" class="link-phone"><i class="bi-telephone-plus ico-phone"></i> &nbsp;<span
                            class="num">{{$phone}}</span></a>
                    <p>Ikuti Kami</p>
                    <ul class="list-social-inline">
                        <li><a href="{{$instagram}}" target="_blank"><i class="bi-instagram ico-social"></i></a></li>
                        <li><a href="{{$facebook}}" target="_blank"><i class="bi-facebook ico-social"></i></a></li>
                        <li><a href="{{$twitter}}" target="_blank"><i class="bi-twitter ico-social"></i></a></li>
                        <li><a href="{{$youtube}}"><i class="bi-youtube ico-social"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="mf-credits">
        <p>Copyright {{ date('Y')  }} © {{ env('APP_NAME') }}</p>
    </div>
</footer>
