@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header_title','Settings')
@section('content_header_prev_link','/')
@section('content_header_prev_text','Halaman Depan')

@section('content')
    <form class="card" action="{{ route('backoffice.settings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card-header d-flex align-items-center">
            <h3 class="card-title">Konfigurasi Website</h3>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="input-title" class="col-sm-2 col-form-label">Judul{!! printRequired() !!}</label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="input-title" placeholder="Judul Website" value="{{ $title->value ?? old('title') }}" required>
                    @error('title')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-description" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="input-description" placeholder="Deskripsi dari Website">{!! $description->value ?? old('description') !!}</textarea>
                    @error('title')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row" id="form-pict_modal">
                <label for="input-pict_modal" class="col-sm-2 col-form-label">Modal Picture</label>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="img-preview mb-2">
                                <button type="button" class="btn btn-sm btn-danger d-block mb-2 mx-auto btn-preview_remove" onclick="removePreview($(this), '{{ !empty($pict_modal) ? asset($pict_modal->value) : '' }}', 'pict_modal')" disabled>Reset Preview</button>
                                <img class="img-responsive" width="100%;" style="padding:.25rem;background:#eee;display:block;" src="{{ !empty($pict_modal) ? asset($pict_modal->value) : '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('pict_modal') is-invalid @enderror" name="pict_modal" id="input-pict_modal" onchange="generatePreview($(this), 'pict_modal')" accept=".jpg,.jpeg,.png">
                        <label class="custom-file-label" for="input-pict_modal">Choose file</label>

                        @error('pict_modal')
                        <div class='invalid-feedback'>{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Saran: Gunakan gambar dengan format JPG atau PNG. Ukuran maksimal adalah 5MB</small>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="input-link_modal" class="col-sm-2 col-form-label">Link Modal</label>
                <div class="col-sm-10">
                    <input type="text" name="link_modal" class="form-control @error('link_modal') is-invalid @enderror" id="input-link_modal" placeholder="Link Video Youtube" value="{{ $link_modal->value ?? old('link_modal') }}">
                    @error('link_modal')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row" id="form-favicon">
                <label for="input-favicon" class="col-sm-2 col-form-label">Favicon</label>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="img-preview mb-2">
                                <button type="button" class="btn btn-sm btn-danger d-block mb-2 mx-auto btn-preview_remove" onclick="removePreview($(this), '{{ !empty($favicon) ? asset($favicon->value) : '' }}', 'favicon')" disabled>Reset Preview</button>
                                <img class="img-responsive" width="100%;" style="padding:.25rem;background:#eee;display:block;" src="{{ !empty($favicon) ? asset($favicon->value) : '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('favicon') is-invalid @enderror" name="favicon" id="input-favicon" onchange="generatePreview($(this), 'favicon')" accept=".jpg,.jpeg,.png,.svg">
                        <label class="custom-file-label" for="input-favicon">Choose file</label>

                        @error('favicon')
                        <div class='invalid-feedback'>{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Saran: Gunakan gambar dengan format SVG atau PNG. Ukuran maksimal adalah 1MB</small>
                    </div>
                </div>
            </div>

            <div class="form-group row" id="form-logo">
                <label for="input-logo" class="col-sm-2 col-form-label">Logo</label>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="img-preview mb-2">
                                <button type="button" class="btn btn-sm btn-danger d-block mb-2 mx-auto btn-preview_remove" onclick="removePreview($(this), '{{ !empty($logo) ? asset($logo->value) : '' }}', 'logo')" disabled>Reset Preview</button>
                                <img class="img-responsive" width="100%;" style="padding:.25rem;background:#eee;display:block;" src="{{ !empty($logo) ? asset($logo->value) : '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('logo') is-invalid @enderror" name="logo" id="input-logo" onchange="generatePreview($(this), 'logo')" accept=".jpg,.jpeg,.png">
                        <label class="custom-file-label" for="input-logo">Choose file</label>

                        @error('logo')
                        <div class='invalid-feedback'>{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Saran: Gunakan gambar dengan format SVG atau PNG. Ukuran maksimal adalah 1MB</small>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="input-departement" class="col-sm-2 col-form-label">Departemen</label>
                <div class="col-sm-10">
                    <input type="text" name="departement" class="form-control @error('departement') is-invalid @enderror" id="input-departement" placeholder="Nama Departemen" value="{{ $departement->value ?? old('departement') }}">
                    @error('departement')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-address" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="input-address" placeholder="Alamat">{!! $address->value ?? old('address') !!}</textarea>
                    @error('title')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-phone" class="col-sm-2 col-form-label">Nomor Telepon</label>
                <div class="col-sm-10">
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="input-phone" placeholder="Nomor Telepon" value="{{ $phone->value ?? old('phone') }}">
                    @error('phone')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="input-email" placeholder="Email" value="{{ $email->value ?? old('email') }}">
                    @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-instagram" class="col-sm-2 col-form-label">Instagram</label>
                <div class="col-sm-10">
                    <input type="text" name="instagram" class="form-control @error('instagram') is-invalid @enderror" id="input-instagram" placeholder="https://www.instagram.com/...." value="{{ $instagram->value ?? old('instagram') }}">
                    @error('instagram')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>  

            <div class="form-group row">
                <label for="input-twitter" class="col-sm-2 col-form-label">Twitter</label>
                <div class="col-sm-10">
                    <input type="text" name="twitter" class="form-control @error('twitter') is-invalid @enderror" id="input-twitter" placeholder="https://www.twitter.com/...." value="{{ $twitter->value ?? old('twitter') }}">
                    @error('twitter')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-facebook" class="col-sm-2 col-form-label">Facebook</label>
                <div class="col-sm-10">
                    <input type="text" name="facebook" class="form-control @error('facebook') is-invalid @enderror" id="input-facebook" placeholder="https://www.facebook.com/...." value="{{ $facebook->value ?? old('facebook') }}">
                    @error('facebook')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-youtube" class="col-sm-2 col-form-label">Youtube</label>
                <div class="col-sm-10">
                    <input type="text" name="youtube" class="form-control @error('youtube') is-invalid @enderror" id="input-youtube" placeholder="https://www.youtube.com/...." value="{{ $youtube->value ?? old('youtube') }}">
                    @error('youtube')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-copyright" class="col-sm-2 col-form-label">Copyright</label>
                <div class="col-sm-10">
                    <input type="text" name="copyright" class="form-control @error('copyright') is-invalid @enderror" id="input-copyright" placeholder="Copyright" value="{{ $copyright->value ?? old('copyright') }}">
                    @error('copyright')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-best-employee" class="col-sm-2 col-form-label">Deskripsi Karyawan Terbaik</label>
                <div class="col-sm-10">
                    <textarea class="form-control @error('best_employee') is-invalid @enderror" name="best_employee" id="input-best-employee" cols="30" rows="5" placeholder="Deskripsi Karyawan Terbaik">{{ $best_employee->value ?? old('best_employee') }}</textarea>
                    @error('best_employee')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-sipintar" class="col-sm-2 col-form-label">Deskripsi SIPINTAR</label>
                <div class="col-sm-10">
                    <textarea class="form-control @error('sipintar') is-invalid @enderror" name="sipintar" id="input-sipintar" cols="30" rows="10" placeholder="Deskripsi SI PINTAR">{{ $sipintar->value ?? old('sipintar') }}</textarea>
                    @error('sipintar')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-conflict-interest" class="col-sm-2 col-form-label">Deskripsi Benturan Kepentingan</label>
                <div class="col-sm-10">
                    <textarea class="form-control @error('conflict_interest') is-invalid @enderror" name="conflict_interest" id="input-conflict-interest" cols="30" rows="10" placeholder="Deskripsi Benturan Kepentingan">{{ $conflict_interest->value ?? old('conflict_interest') }}</textarea>
                    @error('conflict_interest')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-gratifikasi" class="col-sm-2 col-form-label">Deskripsi Gratifikasi</label>
                <div class="col-sm-10">
                    <textarea class="form-control @error('gratifikasi') is-invalid @enderror" name="gratifikasi" id="input-gratifikasi" cols="30" rows="10" placeholder="Deskripsi Gratifikasi">{{ $gratifikasi->value ?? old('gratifikasi') }}</textarea>
                    @error('gratifikasi')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="input-public-service" class="col-sm-2 col-form-label">Deskripsi Survei Kepuasan Masyarakat</label>
                <div class="col-sm-10">
                    <textarea class="form-control @error('public_service') is-invalid @enderror" name="public_service" id="input-public-service" cols="30" rows="10" placeholder="Deskripsi Layanan Umum">{{ $public_service->value ?? old('public_service') }}</textarea>
                    @error('public_service')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="btn-group float-right">
                <button type="button" onclick="formReset()" class="btn btn-sm btn-danger">Reset</button>
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- /.card-footer-->
    </form>
@endsection

@section('js_inline')
<script>
    $(document).ready((e) => {
        $('a[data-rel^=lightcase]').lightcase();
    });

    // Picture
    function generatePreview(input, form_field){
        console.log("Generate Preview is running...");
        console.log("Form Field : #form-"+form_field);
        console.log(input);

        let preview_container = input.closest('#form-'+form_field).find('.img-responsive');
        let preview_remove = input.closest('#form-'+form_field).find('.btn-preview_remove');

        let fileName;
        let fileLabel = input.closest('#form-'+form_field).find('.custom-file-label');

        console.log(preview_container);
        console.log(preview_remove);

        if (input[0].files[0] && input[0].files[0]) {
            let reader = new FileReader();
            fileName = input[0].files[0].name;
            reader.onload = function(e) {
                preview_container.attr('src', e.target.result);
            }

            console.log("Filename : "+fileName);
            reader.readAsDataURL(input[0].files[0]);
            preview_remove.prop('disabled', false);
        } else {
            fileName = 'Choose File';
            $(preview_remove).click();
        }
        $(fileLabel).text(fileName);
    }
    function removePreview(input, old_value = '', form_field){
        console.log("Remove Preview is running...");

        input.prop('disabled', true);
        let preview_container = input.closest('#form-'+form_field).find('.img-responsive');

        let preview_input = input.closest('#form-'+form_field).find('.custom-file-input');
        let preview_label = input.closest('#form-'+form_field).find('.custom-file-label');

        console.log(preview_container);

        if(old_value != ''){
            preview_container.attr('src', old_value);
        } else {
            preview_container.removeAttr('src');
        }
        preview_input.val('');
        preview_label.text('Choose file');
    }
</script>
@endsection
