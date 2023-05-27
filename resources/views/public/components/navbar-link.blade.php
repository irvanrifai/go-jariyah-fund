<div class="container">
    <a class="navbar-brand" href="{{ env('APP_URL') }}">
        <img src="/img/static/main-logo-small.png" alt="{{ env('APP_NAME') }}" class="navbar-logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link{{ Route::is('public.homepage') ? ' active' : '' }}" aria-current="page"
                   href="{{ env('APP_URL') }}">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    Profil
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php if(isset($post->slug)){ ?>
                        <li>{{ build_page_link('Sejarah',$post->slug ?? '','sejarah','dropdown-item') }}</li>
                        <li>{{ build_page_link('Visi Misi',$post->slug ?? '','visi-misi','dropdown-item') }}</li>
                        <li>{{ build_page_link('Tupoksi',$post->slug ?? '','tugas-pokok-dan-fungsi','dropdown-item') }}</li>
                        <li>{{ build_page_link('Struktur',$post->slug ?? '','struktur-kelembagaan','dropdown-item') }}</li>
                        <li>{{ build_page_link('SDM',$post->slug ?? '','sumber-daya-manusia','dropdown-item') }}</li>
                    <?php } else { ?>
                        <li>{{ build_page_link('Sejarah','','sejarah','dropdown-item') }}</li>
                        <li>{{ build_page_link('Visi Misi','','visi-misi','dropdown-item') }}</li>
                        <li>{{ build_page_link('Tupoksi','','tugas-pokok-dan-fungsi','dropdown-item') }}</li>
                        <li>{{ build_page_link('Struktur','','struktur-kelembagaan','dropdown-item') }}</li>
                        <li>{{ build_page_link('SDM','','sumber-daya-manusia','dropdown-item') }}</li>
                    <?php } ?>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Zona Integritas
                </a>
                <ul class="dropdown-menu ul-lv-2" aria-labelledby="navbarDropdown">
                    <li class="mobile-open">
                        <a class="dropdown-item pengaduan" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="navbarDropdownSub">
                            <span class="mobile" style="display: none"><i class="bi bi-question-circle-fill"></i>&nbsp;&nbsp;</span>Pengaduan<span class="desktop">&nbsp;&nbsp;<i class="bi bi-arrow-right"></i></span>
                        </a>
                        <ul class="submenu dropdown-menu" aria-labelledby="navbarDropdownSub">
                            {{-- <li><a class="dropdown-item{{ Route::is('wbs.index') ? ' active' : '' }}"
                                   href="{{ route('wbs.index') }}">SI PINTAR</a></li>
                            <li><a class="dropdown-item{{ Route::is('benturan.kepentingan.chart') ? ' active' : '' }}"
                                   href="{{ route('benturan.kepentingan.chart') }}">Benturan Kepentingan</a></li> --}}
                            {{-- <li><a class="dropdown-item{{ Route::is('gratifikasi') ? ' active' : '' }}"
                                   href="{{ route('gratifikasi') }}">Gratifikasi</a></li>
                            <li><a class="dropdown-item" href="https://www.lapor.go.id/" target="_blank">SP4N-Lapor</a>
                            </li> --}}
                        </ul>
                    </li>
                    {{-- <li><a class="dropdown-item{{ Route::is('public-service') ? ' active' : '' }}"
                           href="{{ route('public-service') }}">Kepuasan Masyarakat</a></li> --}}
                    <li><a class="dropdown-item{{ Route::is('saran.form') ? ' active' : '' }}"
                           href="{{ route('saran.form') }}">Saran</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    Artikel
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item{{ Route::is('public.indexPosts') ? ' active' : '' }}"
                           href="{{ route('public.indexPosts') }}">Semua Artikel</a></li>
                    <?php $category = \App\Http\Controllers\PostsController::get_categories() ?>
                    @foreach($category as $submenu)
                        <li>{{ build_page_link($submenu['title'],$current_category_slug ?? '',$submenu['slug'],'dropdown-item','category') }}</li>
                    @endforeach
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Route::is('public.gallery') ? ' active' : '' }}"
                   href="{{ route('public.gallery') }}">Galeri</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Route::is('public.contactUs') ? ' active' : '' }}"
                   href="{{ route('public.contactUs') }}">Kontak</a>
            </li>
        </ul>
    </div>
</div>
