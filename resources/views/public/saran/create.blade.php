@extends('layouts.public')
@section('classes_body','page-saran')
@section('title','Saran')
@section('body')
    @include('public.components.navbar')
    <div class="container">
        <br><br>
        <section id="title" class="section">
            <div class="row mb-4">
            @if ($message=Session::get('success'))
				<div class="alert alert-success alert-block" role="alert">					
				    <strong>{{ $message }}</strong>
				</div>
			@endif
                <div class="col">
                    <h1 class="judul-besar">Saran</h1>
                </div>
                <div class="col">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-outline-secondary me-md-2">&#9664; Kembali</button>
                    </div>
                </div>
            </div>
            <p><mark>Total saran yang telah kami terima: {{$jumlah_saran}}</mark></p>
            <hr class="bord-no pad-all">
        </section>
        <section id="formSaran" class="section">
            <form class="mt-4" action="public/tambah_saran" method ="POST" enctype="multipart/form-data">
            @csrf
            <!-- 2 column grid layout with text inputs for fullname and phone number -->
            <div class="row mb-4">
                <div class="col">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukkan Nama Lengkap" required>

                        @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <label for="telp" class="form-label">Nomor Telepon</label>
                    <div class="input-group has-validation">
                        <!-- <span class="input-group-text" id="idCode">+62</span> -->
                        <input type="tel" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp" aria-describedby="idCode"placeholder="Masukkan Nomor Telepon" onkeypress='validate(event)' required>

                        @error('telp')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- 2 column grid layout with text inputs for e-mail and subject -->
            <div class="row mb-4">
                <div class="col">
                    <label for="email" class="form-label">Email Aktif</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required>

                    @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col">
                    <label for="subject" class="form-label">Subjek</label>
                    <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" id="subject" placeholder="Pelayanan Administrasi" required>

                    @error('subject')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Message input -->
            <div class="mb-3">
                <label for="validationTextarea" class="form-label">Isi Pesan</label>
                <textarea class="form-control @error('text') is-invalid @enderror" id="validationTextarea" placeholder="Masukkan isi pesan..." rows="5" name="text" required></textarea>
                <input type="hidden" id="status" value="draft" name="status" required/>
                
                @error('status')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <br><br>
            
            <!-- Submit button -->
            <div class="d-md-flex justify-content-md-end">
                <button type="submit" class="tombol button2">KIRIM</button>
            </div>
            </form>
        </section>
    </div><br><br>

@include('public.components.footer')

<script>
    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
        // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>
@stop