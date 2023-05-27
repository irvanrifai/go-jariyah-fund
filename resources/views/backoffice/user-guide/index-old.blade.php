@extends('adminlte::page')

@section('title', 'User Guide')

@section('content_header_title','Settings')
@section('content_header_prev_link','/')
@section('content_header_prev_text','Halaman Depan')

@section('content')
    <form class="card">
        <div class="card-header d-flex align-items-center">
            <h3 class="card-title">Petunjuk Penggunaan Go-Fund</h3>
        </div>

        <div class="card-body">
            <div id="accordion">
                <h3>Akses Halaman</h3>
                <div class="card">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#login">
                            Login
                        </a>
                    </div>
                    <div id="login" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <p>1. Akses halaman Deputi Bidang Kewirausahaan <a href="{{ env('APP_URL') }}/backoffice" target="_blank" class="text-decoration-none">disini</a>.</p>
                                </div>
                                <div class="col-6">
                                    <p class="text-justify">2. Masukkan alamat e-mail dan password yang telah terdaftar dan tekan tombol masuk.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <img src="\img\static\user-guide\akses-laman.PNG" width="350" height="400" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}">
                                </div>
                                <div class="col-6">
                                    <img src="\img\static\user-guide\insert-data.PNG" width="350" height="400" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="Masukkan alamat e-mail dan password">
                                </div>
                            </div>
                        </div>
                        <hr class="bord-no pad-all">
                    </div>

                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#register">
                            Registrasi
                        </a>
                    </div>
                    <div id="register" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <p>1. Akses halaman Deputi Bidang Kewirausahaan <a href="{{ env('APP_URL') }}/backoffice" target="_blank" class="text-decoration-none">disini</a> dan tekan tombol "Daftar sebagai anggota baru".</p>
                                </div>
                                <div class="col-6">
                                    <p class="text-justify">2. Masukkan nama lengkap, e-mail dan kata sandi baru. Tekan tombol daftar dan Anda akan diarahkan ke halaman dashboard backoffice Deputi Bidang Kewirausahaan.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <img src="\img\static\user-guide\akses-laman.PNG" width="350" height="400" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}">
                                </div>
                                <div class="col-6">
                                    <img src="\img\static\user-guide\form-register.PNG" width="350" height="400" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="Masukkan alamat e-mail dan password">
                                </div>
                            </div>
                        </div>
                        <hr class="bord-no pad-all">
                    </div>

                    <!-- <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#userEdit">
                            Sunting Pengguna
                        </a>
                    </div>
                    <div id="userEdit" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Lorem ipsum..
                        </div>
                    </div> -->
                </div>

                <h3>Pengaduan</h3>
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#gratuity">
                            Gratifikasi
                        </a>
                    </div>
                    <div id="gratuity" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menampilkan list laporan gratifikasi yang diterima, akses halaman <a href="{{ env('APP_URL') }}/backoffice/gratifikasi" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\gratifikasi.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Keterangan Gambar:</p>
                            <p>1. Tombol untuk melakukan export terharap setiap laporan gratifikasi yang diterima.</p>
                            <p>2. Tombol untuk melihat lebih detail sebuah laporan gratifikasi yang diterima.</p>
                            <p>3. Tombol untuk menyunting sebuah laporan gratifikasi yang diterima.</p>
                        </div>
                        <hr class="bord-no pad-all">
                    </div>

                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#conflictInterest">
                            Benturan Kepentingan
                        </a>
                    </div>
                    <div id="conflictInterest" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menampilkan list laporan benturan kepentingan yang diterima, akses halaman <a href="{{ env('APP_URL') }}/backoffice/conflict-interest" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\list-conflict-interests.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Keterangan Gambar:</p>
                            <p>1. Tombol untuk melakukan export terharap setiap laporan benturan kepentingan yang diterima.</p>
                            <p>2. Tombol untuk melihat lebih detail sebuah laporan benturan kepentingan yang diterima.</p>
                            <p>3. Tombol untuk menyunting sebuah laporan benturan kepentingan yang diterima.</p>

                            <hr class="bord-no pad-all">
                            <h5>Sunting Laporan Benturan Kepentingan</h5>
                            <p>Penyuntingan pada laporan hanya dapat dilakukan pada field status, tindak lanjut dan lampiran.</p>
                            <img src="\img\static\user-guide\edit-conflict-interest.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Keterangan Gambar:</p>
                            <p>1. Field status laporan (laporan baru, sedang diproses atau sudah diproses).</p>
                            <p>2. Field keterangan tindak lanjut laporan.</p>
                            <p>3. Field lampiran file mengenai laporan.</p>
                        </div>
                    </div>
                </div>

                <h3>SI PINTAR</h3>
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link text-reset" data-toggle="collapse" href="#unitSettings">
                            Setting Unit
                        </a>
                    </div>
                    <div id="unitSettings" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Lorem ipsum..
                        </div>
                        <hr class="bord-no pad-all">
                    </div>

                    <div class="card-header">
                        <a class="collapsed card-link text-reset" data-toggle="collapse" href="#serviceHistory">
                            Riwayat
                        </a>
                    </div>
                    <div id="serviceHistory" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Lorem ipsum..
                        </div>
                    </div>
                </div>

                <h3>Kepuasan Masyarakat</h3>
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link text-reset" data-toggle="collapse" href="#guestHistory">
                            Riwayat
                        </a>
                    </div>
                    <div id="guestHistory" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Lorem ipsum..
                        </div>
                        <hr class="bord-no pad-all">
                    </div>

                    <div class="card-header">
                        <a class="collapsed card-link text-reset" data-toggle="collapse" href="#guestSettings">
                            Setting
                        </a>
                    </div>
                    <div id="guestSettings" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Lorem ipsum..
                        </div>
                    </div>
                </div>

                <h3>Saran</h3>
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#advice">
                            Saran
                        </a>
                    </div>
                    <div id="advice" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <img src="\img\static\user-guide\saran.PNG" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Keterangan Gambar:</p>
                            <p>1. Tombol untuk melakukan export terharap setiap saran yang diterima.</p>
                            <p>2. Tombol untuk melihat lebih detail sebuah saran yang diterima.</p>
                        </div>
                        <hr class="bord-no pad-all">
                    </div>
                </div>

                <h3>Artikel</h3>
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#newArticle">
                            Tulisan Baru
                        </a>
                    </div>
                    <div id="newArticle" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menambahkan artikel baru pada web publik, akses halaman <a href="{{ env('APP_URL') }}/backoffice/posts/create" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\new-article.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Berikut adalah penjelasan gambar:</p>
                            <ol>
                                <li>Field judul artikel yang akan ditambahkan.</li>
                                <li>Field URL yang akan digenerate secara otomatis sesuai dengan judul yang ditulis pada field judul artikel.</li>
                                <li>Field isi artikel.</li>
                                <li>Pilihan apakah artikel akan ditampilkan (pada web publik) atau tidak.</li>
                                <li>Pilihan kategori artikel (disarankan untuk menambahkan kategori terlebih dahulu <a href="{{ env('APP_URL') }}/backoffice/categories" target="_blank" class="text-decoration-none">disini</a>).</li>
                                <li>Field untuk menambahkan/memilih gambar sebagai cover artikel.</li>
                                <li>Tombol untuk menerbitkan artikel setelah semua data form diisi.</li>
                            </ol>
                        </div>
                        <hr class="bord-no pad-all">
                    </div>

                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#allArticles">
                            Semua Tulisan
                        </a>
                    </div>
                    <div id="allArticles" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menampilkan list artikel yang telah ditambahkan, akses halaman <a href="{{ env('APP_URL') }}/backoffice/posts" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\all-articles.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Berikut adalah penjelasan gambar:</p>
                            <ol>
                                <li>Judul artikel yang telah ditambahkan.</li>
                                <li>Kategori artikel yang telah ditambahkan.</li>
                                <li>Status artikel (public berarti artikel ditampilkan di web publik).</li>
                                <li>Tombol untuk melihat artikel yang telah ditambahkan pada web publik.</li>
                                <li>Tombol untuk menyunting artikel yang telah ditambahkan.</li>
                                <li>Tombol untuk menghapus artikel yang telah ditambahkan.</li>
                            </ol>
                        </div>
                        <hr class="bord-no pad-all">
                    </div>

                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#articleCategory">
                            Kategori
                        </a>
                    </div>
                    <div id="articleCategory" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menambahkan/melihat list artikel, akses halaman <a href="{{ env('APP_URL') }}/backoffice/categories" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\category.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Berikut adalah penjelasan gambar:</p>
                            <ol>
                                <p class="font-weight-bolder">Bagian list kategori</p>
                                <li>Nama kategori yang telah ditambahkan.</li>
                                <li>Tombol untuk menyunting kategori yang telah ditambahkan.</li>
                                <li>Tombol untuk menghapus kategori yang telah ditambahkan.</li><br>
                                <p class="font-weight-bolder">Bagian penambahan kategori</p>
                                <li>Field judul kategori yang akan ditambahkan.</li>
                                <li>Field deskripsi kategori.</li>
                                <li>Tombol untuk menambahkan kategori setelah semua data form diisi.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <h3>Halaman</h3>
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#newPage">
                            Halaman Baru
                        </a>
                    </div>
                    <div id="newPage" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menambahkan halaman baru pada web publik, akses halaman <a href="{{ env('APP_URL') }}/backoffice/pages/create" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\new-page.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Berikut adalah penjelasan gambar:</p>
                            <ol>
                                <li>Field judul halaman yang akan ditambahkan.</li>
                                <li>Field URL yang akan digenerate secara otomatis sesuai dengan judul yang ditulis pada field judul halaman.</li>
                                <li>Field isi halaman.</li>
                                <li>Pilihan apakah halaman akan ditampilkan (pada web publik) atau tidak.</li>
                                <li>Field untuk menambahkan/memilih gambar sebagai cover halaman.</li>
                                <li>Tombol untuk menerbitkan halaman setelah semua data form diisi.</li>
                            </ol>
                        </div>
                        <hr class="bord-no pad-all">
                    </div>

                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#allPages">
                            Semua Halaman
                        </a>
                    </div>
                    <div id="allPages" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menampilkan list halaman yang telah ditambahkan, akses halaman <a href="{{ env('APP_URL') }}/backoffice/pages" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\all-pages.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Berikut adalah penjelasan gambar:</p>
                            <ol>
                                <li>Judul halaman yang telah ditambahkan.</li>
                                <li>Status halaman (public berarti halaman ditampilkan di web publik).</li>
                                <li>Tombol untuk melihat halaman yang telah ditambahkan pada web publik.</li>
                                <li>Tombol untuk menyunting halaman yang telah ditambahkan.</li>
                                <li>Tombol untuk menghapus halaman yang telah ditambahkan.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <h3>Slider</h3>
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#newSlide">
                            Slide Baru
                        </a>
                    </div>
                    <div id="newSlide" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menambahkan slide baru, akses halaman <a href="{{ env('APP_URL') }}/backoffice/slider/create" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\new-slider.PNG" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Berikut adalah penjelasan gambar:</p>
                            <ol>
                                <li>Field judul slide yang akan ditambahkan.</li>
                                <li>Field deskripsi mengenai gambar yang ditambahkan.</li>
                                <li>Field link halaman yang akan dituju slide.</li>
                                <li>Field untuk menambahkan/memilih gambar untuk slider.</li>
                                <li>Pilihan apakah slider akan ditampilkan atau tidak.</li>
                                <li>Tombol untuk menambahkan slide setelah semua data form diisi.</li>
                            </ol>
                        </div>
                        <hr class="bord-no pad-all">
                    </div>

                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#allSlides">
                            Semua Slide
                        </a>
                    </div>
                    <div id="allSlides" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menampilkan list slider yang telah ditambahkan, akses halaman <a href="{{ env('APP_URL') }}/backoffice/slider" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\all-slider.PNG" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Berikut adalah penjelasan gambar:</p>
                            <ol>
                                <li>Judul slide yang telah ditambahkan.</li>
                                <li>Status gambar (centang berarti ditampilkan di web publik).</li>
                                <li>Tombol untuk melihat detail slide yang telah ditambahkan.</li>
                                <li>Tombol untuk menyunting slide yang telah ditambahkan.</li>
                                <li>Tombol untuk menghapus slide yang telah ditambahkan.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <h3>Galeri</h3>
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#newPicture">
                            Gambar Baru
                        </a>
                    </div>
                    <div id="newPicture" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menambahkan gambar baru pada galeri, akses halaman <a href="{{ env('APP_URL') }}/backoffice/gallery/create" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\new-picture.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Berikut adalah penjelasan gambar:</p>
                            <ol>
                                <li>Field judul gambar yang akan ditambahkan.</li>
                                <li>Field deskripsi mengenai gambar yang ditambahkan.</li>
                                <li>Field untuk menambahkan/memilih gambar untuk galeri.</li>
                                <li>Pilihan apakah gambar akan ditampilkan pada halaman galeri atau tidak.</li>
                                <li>Tombol untuk menambahkan gambar setelah semua data form diisi.</li>
                            </ol>
                        </div>
                        <hr class="bord-no pad-all">
                    </div>

                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#allPictures">
                            Semua Gambar
                        </a>
                    </div>
                    <div id="allPictures" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menampilkan list gambar yang telah ditambahkan pada galeri, akses halaman <a href="{{ env('APP_URL') }}/backoffice/gallery" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\all-pictures.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Berikut adalah penjelasan gambar:</p>
                            <ol>
                                <li>Judul gambar yang telah ditambahkan.</li>
                                <li>Status gambar (centang berarti ditampilkan di halaman galeri).</li>
                                <li>Tombol untuk melihat detail gambar yang telah ditambahkan.</li>
                                <li>Tombol untuk menyunting gambar yang telah ditambahkan.</li>
                                <li>Tombol untuk menghapus gambar yang telah ditambahkan.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <h3>Master Data & Settings</h3>
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link text-reset" data-toggle="collapse" href="#webSettings">
                            Web Setting
                        </a>
                    </div>
                    <div id="webSettings" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Lorem ipsum..
                        </div>
                        <hr class="bord-no pad-all">
                    </div>

                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#unit">
                            Unit
                        </a>
                    </div>
                    <div id="unit" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>Untuk menambahkan/melihat list unit, akses halaman <a href="{{ env('APP_URL') }}/backoffice/unit" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\unit.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Berikut adalah penjelasan gambar:</p>
                            <ol>
                                <p class="font-weight-bolder">Bagian list unit</p>
                                <li>Nama unit yang telah ditambahkan.</li>
                                <li>Tombol untuk menyunting unit yang telah ditambahkan.</li>
                                <li>Tombol untuk menghapus unit yang telah ditambahkan.</li><br>
                                <p class="font-weight-bolder">Bagian penambahan unit</p>
                                <li>Field nama unit yang akan ditambahkan.</li>
                                <li>Field deskripsi mengenai unit yang akan ditambahkan.</li>
                                <li>Tombol untuk menambahkan unit setelah semua data form diisi.</li>
                            </ol>
                        </div>
                        <hr class="bord-no pad-all">
                    </div>

                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#userSettings">
                            Pengguna
                        </a>
                    </div>
                    <div id="userSettings" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <h5>Daftar Pengguna (Admin)</h5>
                            <p>Untuk menampilkan list pengguna (admin), akses halaman <a href="{{ env('APP_URL') }}/backoffice/users" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\list-users.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Keterangan Gambar:</p>
                            <ol>
                                <li>Tombol untuk menambahkan pengguna baru. (Akses <a href="{{ env('APP_URL') }}/backoffice/users/create" target="_blank" class="text-decoration-none">disini</a>)</li>
                                <li>Nama pengguna yang telah ditambahkan.</li>
                                <li>Alamat e-mail pengguna yang telah ditambahkan.</li>
                                <li>Status pengguna yang telah ditambahkan.</li>
                                <li>Tombol untuk melihat detail pengguna yang telah ditambahkan.</li>
                                <li>Tombol untuk menyunting pengguna yang telah ditambahkan.</li>
                                <li>Tombol untuk menghapus pengguna yang telah ditambahkan.</li>
                            </ol>

                            <hr class="bord-no pad-all">
                            <h5>Menambahkan Pengguna Baru (Admin)</h5>
                            <p>Untuk menambahhkan pengguna baru (admin), akses halaman <a href="{{ env('APP_URL') }}/backoffice/users/create" target="_blank" class="text-decoration-none">berikut</a>.<p>
                            <img src="\img\static\user-guide\new-user.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>
                            <p>Keterangan Gambar:</p>
                            <ol>
                                <li>Field nama pengguna yang akan ditambahkan.</li>
                                <li>Field e-mail pengguna yang akan ditambahkan.</li>
                                <li>Field kata sandi pengguna yang akan ditambahkan.</li>
                                <li>Field konfirmasi kata sandi pengguna yang diketik pada field sebelumnya.</li>
                                <li>Checkbox status pengguna (aktif atau tidak).</li>
                                <li>Tombol untuk menambahkan pengguna baru setelah semua data form diisi.</li>
                            </ol>

                            <hr class="bord-no pad-all">
                            <h5>Menyunting Pengguna (Admin)</h5>
                            <p>Jika terdapat kesalahan atau perlu perubahan pada data pengguna, data tersebut dapat diubah termasuk nama, e-mail, kata sandi dan status pengguna.</p>
                            <img src="\img\static\user-guide\edit-user.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>

                            <p>Tampilan form sunting password pengguna.</p>
                            <img src="\img\static\user-guide\edit-user-password.png" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="{{ env('APP_NAME') }}"><br>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">

        </div>
    </form>
@endsection
