<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;

use App\Models\WebsiteSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteSettingsController extends Controller
{
    /**
     * Image Upload for Storing Website File
     *
     */
    private function imageUpload($file, $type = 'favicon')
    {
        $fullname = null;
        if (!empty($file)) {
            // Check old Files
            $check_exists = glob(public_path() . '/' . $type . '_*.*');
            if (!empty($check_exists)) {
                foreach ($check_exists as $exists) {
                    \File::delete($exists);
                }
            }

            // Upload new File
            $uploadedFile = $file;
            $filename = $type . '_' . (Carbon::now()->timestamp + rand(1, 1000));
            $fullname = $filename . '.' . strtolower($uploadedFile->getClientOriginalExtension());
            $filesize = $uploadedFile->getSize();
            $path = $uploadedFile->storeAs('/', $fullname);
        }

        return $fullname;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = WebsiteSettings::where('key', 'title')->first();
        $description = WebsiteSettings::where('key', 'description')->first();
        $link_modal = WebsiteSettings::where('key', 'link_modal')->first();
        $copyright = WebsiteSettings::where('key', 'copyright')->first();
        $departement = WebsiteSettings::where('key', 'departement')->first();
        $address = WebsiteSettings::where('key', 'address')->first();
        $phone = WebsiteSettings::where('key', 'phone')->first();
        $email = WebsiteSettings::where('key', 'email')->first();
        $instagram = WebsiteSettings::where('key', 'instagram')->first();
        $twitter = WebsiteSettings::where('key', 'twitter')->first();
        $facebook = WebsiteSettings::where('key', 'facebook')->first();
        $youtube = WebsiteSettings::where('key', 'youtube')->first();
        $best_employee = WebsiteSettings::where('key', 'best_employee')->first();
        $sipintar = WebsiteSettings::where('key', 'sipintar')->first();
        $conflict_interest = WebsiteSettings::where('key', 'conflict_interest')->first();
        $gratifikasi = WebsiteSettings::where('key', 'gratifikasi')->first();
        $public_service = WebsiteSettings::where('key', 'public_service')->first();
        $favicon = WebsiteSettings::where('key', 'favicon')->first();
        $logo = WebsiteSettings::where('key', 'logo')->first();
        $pict_modal = WebsiteSettings::where('key', 'pict_modal')->first();

        return view('backoffice.settings.index', compact('copyright', 'departement', 'address', 'phone', 'email', 'instagram', 'twitter', 'youtube', 'facebook', 'title', 'description', 'favicon', 'logo', 'link_modal', 'pict_modal', 'sipintar', 'conflict_interest', 'gratifikasi', 'public_service', 'best_employee'));
    }

    public static function contact()
    {
        $copyright = WebsiteSettings::where('key', 'copyright')->first();
        $departement = WebsiteSettings::where('key', 'departement')->first();
        $address = WebsiteSettings::where('key', 'address')->first();
        $phone = WebsiteSettings::where('key', 'phone')->first();
        $email = WebsiteSettings::where('key', 'email')->first();
        $instagram = WebsiteSettings::where('key', 'instagram')->first();
        $twitter = WebsiteSettings::where('key', 'twitter')->first();
        $facebook = WebsiteSettings::where('key', 'facebook')->first();
        $youtube = WebsiteSettings::where('key', 'youtube')->first();

        return view('public.contacts.index', compact('copyright', 'departement', 'address', 'phone', 'email', 'instagram', 'twitter', 'youtube', 'facebook'));
    }

    public static function footer($param)
    {
        $footer_settings = WebsiteSettings::get();

        foreach ($footer_settings as $ws) {
            if ($ws->key == 'address' && $param == 'address') {
                return $ws->value;
            }
            if ($ws->key == 'instagram' && $param == 'instagram') {
                return $ws->value;
            }
            if ($ws->key == 'twitter' && $param == 'twitter') {
                return $ws->value;
            }
            if ($ws->key == 'facebook' && $param == 'facebook') {
                return $ws->value;
            }
            if ($ws->key == 'youtube' && $param == 'youtube') {
                return $ws->value;
            }
            if ($ws->key == 'phone' && $param == 'phone') {
                return $ws->value;
            }
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:191'],
            'description' => ['nullable', 'string'],
            'link_modal' => ['nullable', 'string', 'max:191'],
            'pict_modal' => ['nullable', 'mimes:jpg,jpeg,png', 'max:5120'],
            'favicon' => ['nullable', 'mimes:jpg,jpeg,png,svg', 'max:1024'],
            'logo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'copyright' => ['nullable', 'string', 'max:191'],
            'address' => ['nullable', 'string', 'max:191'],
            'instagram' => ['nullable', 'string', 'max:191'],
            'twitter' => ['nullable', 'string', 'max:191'],
            'facebook' => ['nullable', 'string', 'max:191'],
            'youtube' => ['nullable', 'string', 'max:191'],
            'phone' => ['nullable', 'string', 'max:191'],
            'email' => ['nullable', 'string', 'max:191'],
            'departement' => [
                'nullable', 'string', 'max:191'
            ],
            'best_employee' => ['nullable', 'string'],
            'sipintar' => ['nullable', 'string'],
            'conflict_interest' => ['nullable', 'string'],
            'gratifikasi' => ['nullable', 'string'],
            'public_service' => ['nullable', 'string'],
        ], [
            'title.required' => 'Field Judul Wajib Diisi!',
            'favicon.mimes' => 'Field Favicon menggunakan format gambar yang tidak didukung!',
            'favicon.max' => 'Field Favicon melebihi batas ukuran file (1MB)!',
            'logo.mimes' => 'Field Logo menggunakan format gambar yang tidak didukung!',
            'logo.max' => 'Field Logo melebihi batas ukuran file (1MB)!',
            'pict_modal.mimes' => 'Field Logo menggunakan format gambar yang tidak didukung!',
            'pict_modal.max' => 'Field Logo melebihi batas ukuran file (1MB)!',
        ]);

        // Website Title
        $title = WebsiteSettings::updateOrCreate(['key' => 'title'], [
            'name' => 'Website Title',
            'value' => $request->title
        ]);

        if (!empty($request->description)) {
            // Website Description
            $description = WebsiteSettings::updateOrCreate(['key' => 'description'], [
                'name' => 'Website Description',
                'value' => $request->description
            ]);
        }

        if (!empty($request->link_modal)) {
            // Website Modal Link
            $link_modal = WebsiteSettings::updateOrCreate(['key' => 'link_modal'], [
                'name' => 'Website Modal Link',
                'value' => $request->link_modal
            ]);
        }


        if (!empty($request->copyright)) {
            // Website Copyright
            $copyright = WebsiteSettings::updateOrCreate(['key' => 'copyright'], [
                'name' => 'Website Copyright',
                'value' => $request->copyright
            ]);
        }
        if (!empty($request->departement)) {
            // Website Departement
            $departement = WebsiteSettings::updateOrCreate(['key' => 'departement'], [
                'name' => 'Website Departement Name',
                'value' => $request->departement
            ]);
        }
        if (!empty($request->address)) {
            // Website Address
            $adress = WebsiteSettings::updateOrCreate(['key' => 'address'], [
                'name' => 'Website Address',
                'value' => $request->address
            ]);
        }
        if (!empty($request->phone)) {
            // Website Phone
            $phone = WebsiteSettings::updateOrCreate(['key' => 'phone'], [
                'name' => 'Website Phone',
                'value' => $request->phone
            ]);
        }
        if (!empty($request->email)) {
            // Website Email
            $email = WebsiteSettings::updateOrCreate(['key' => 'email'], [
                'name' => 'Website Email',
                'value' => $request->email
            ]);
        }
        if (!empty($request->instagram)) {
            // Website Instagram
            $instagram = WebsiteSettings::updateOrCreate(['key' => 'instagram'], [
                'name' => 'Website Instagram',
                'value' => $request->instagram
            ]);
        }
        if (!empty($request->twitter)) {
            // Website Twitter
            $twitter = WebsiteSettings::updateOrCreate(['key' => 'twitter'], [
                'name' => 'Website Twitter',
                'value' => $request->twitter
            ]);
        }
        if (!empty($request->facebook)) {
            // Website Facebook
            $facebook = WebsiteSettings::updateOrCreate(['key' => 'facebook'], [
                'name' => 'Website Facebook',
                'value' => $request->facebook
            ]);
        }
        if (!empty($request->youtube)) {
            // Website Youtube
            $youtube = WebsiteSettings::updateOrCreate(['key' => 'youtube'], [
                'name' => 'Website Youtube',
                'value' => $request->youtube
            ]);
        }
        if (!empty($request->best_employee)) {
            // Deskripsi Karyawan Terbaik
            $best_employee = WebsiteSettings::updateOrCreate(['key' => 'best_employee'], [
                'name' => 'Deskripsi Karyawan Terbaik',
                'value' => $request->best_employee
            ]);
        }
        if (!empty($request->sipintar)) {
            // Deskripsi SIPINTAR
            $sipintar = WebsiteSettings::updateOrCreate(['key' => 'sipintar'], [
                'name' => 'Deskripsi SIPINTAR',
                'value' => $request->sipintar
            ]);
        }
        if (!empty($request->conflict_interest)) {
            // Deskripsi Benturan Kepentingan
            $conflict_interest = WebsiteSettings::updateOrCreate(['key' => 'conflict_interest'], [
                'name' => 'Website Benturan Kepentingan',
                'value' => $request->conflict_interest
            ]);
        }
        if (!empty($request->gratifikasi)) {
            // Deskripsi Gratifikasi
            $gratifikasi = WebsiteSettings::updateOrCreate(['key' => 'gratifikasi'], [
                'name' => 'Deskripsi Gratifikasi',
                'value' => $request->gratifikasi
            ]);
        }
        if (!empty($request->public_service)) {
            // Deskripsi Layanan Umum
            $public_service = WebsiteSettings::updateOrCreate(['key' => 'public_service'], [
                'name' => 'Deskripsi Layanan Umum',
                'value' => $request->public_service
            ]);
        }
        if ($request->has('favicon')) {
            // Home Modal Picture
            $favicon = WebsiteSettings::updateOrCreate(['key' => 'pict_modal'], [
                'name' => 'Website Modal Picture',
                'value' => $this->imageUpload($request->pict_modal, 'pict_modal')
            ]);
        }
        if ($request->has('favicon')) {
            // Favicon
            $favicon = WebsiteSettings::updateOrCreate(['key' => 'favicon'], [
                'name' => 'Website Favicon',
                'value' => $this->imageUpload($request->favicon, 'favicon')
            ]);
        }
        if ($request->has('logo')) {
            // Logo
            $favicon = WebsiteSettings::updateOrCreate(['key' => 'logo'], [
                'name' => 'Website Logo',
                'value' => $this->imageUpload($request->logo, 'logo')
            ]);
        }

        return redirect()->route('backoffice.settings.index')->with([
            'status' => 'success',
            'message' => 'Berhasil menyimpan data konfigurasi website!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
