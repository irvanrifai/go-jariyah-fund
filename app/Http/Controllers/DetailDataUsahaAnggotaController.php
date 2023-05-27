<?php

namespace App\Http\Controllers;

use App\Models\JfDetailDataUsahaAnggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetailDataUsahaAnggotaController extends Controller
{
    public function getAllDataUsaha(){
        $data = JfDetailDataUsahaAnggota::all();
        if ($data) {
            return response()->json([
                'status' => 200,
                'message' => 'Data fetched',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data not found'
            ]);
        }
    }

    public function getOneDataUsaha($id){
        $data = JfDetailDataUsahaAnggota::where('id', $id)->first();
        if ($data) {
            return response()->json([
                'status' => 200,
                'message' => 'Data fetched',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data not found'
            ]);
        }
    }

    public function createUpdateDataUsaha(Request $request){

        $data_usaha = Validator::make($request->all(), [
            'id' => 'required',
            'duta_wakaf_id' => 'required',
            'nama_owner' => 'required',
            'nama_umkm' => 'required',
            'alamat_umkm' => 'required',
            'no_telepon' => 'required',
            'jenis_usaha' => 'required',
            'omset_usaha' => 'required',
            'akta_pendirian_usaha' => 'required', // type:file
            'npwp' => 'required',
            'nib' => 'required',
            'pirt' => 'required', // type:file
            'sertif_halal' => 'required', // type:file
            'laporan_keuangan_usaha' => 'required', // type:file
            'total_dana_usaha' => 'required',
            'dana_sekarang' => 'required',
            'dana_pinjaman_dibutuhkan' => 'required',
            'rincian_kebutuhan_dana' => 'required',
            'lama_pengembalian_pinjaman' => 'required',
            'jumlah_pengembalian_per_bulan' => 'required',
        ]);


        if ($data_usaha->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Bad Request!',
                'errors' => $data_usaha->errors()
            ]);

        } else {

            // akta_pendirian_usaha
            $file_akta_pendirian_usaha = $request->file('akta_pendirian_usaha');
            $akta_pendirian_usaha = $file_akta_pendirian_usaha->store('/');
            $file_akta_pendirian_usaha->move(public_path().'/doc/anggota', $file_akta_pendirian_usaha->store('akta_pendirian_usaha'));

            // pirt
            $file_pirt = $request->file('pirt');
            $pirt = $file_pirt->store('/');
            $file_pirt->move(public_path().'/doc/anggota', $file_pirt->store('pirt'));

            // sertif_halal
            $file_sertif_halal = $request->file('sertif_halal');
            $sertif_halal = $file_sertif_halal->store('/');
            $file_sertif_halal->move(public_path().'/doc/anggota', $file_sertif_halal->store('sertif_halal'));

            // laporan_keuangan_usaha
            $file_laporan_keuangan_usaha = $request->file('laporan_keuangan_usaha');
            $laporan_keuangan_usaha = $file_laporan_keuangan_usaha->store('/');
            $file_laporan_keuangan_usaha->move(public_path().'/doc/anggota', $file_laporan_keuangan_usaha->store('laporan_keuangan_usaha'));

            JfDetailDataUsahaAnggota::updateOrCreate(
                [
                    'id' => $request->id,
                    'duta_wakaf_id' => $request->duta_wakaf_id,
                ],
                [
                    'nama_owner' => $request->nama_owner,
                    'nama_umkm' => $request->nama_umkm,
                    'alamat_umkm' => $request->alamat_umkm,
                    'no_telepon' => $request->no_telepon,
                    'jenis_usaha' => $request->jenis_usaha,
                    'omset_usaha' => $request->omset_usaha,
                    'akta_pendirian_usaha' => $akta_pendirian_usaha,
                    'npwp' => $request->npwp,
                    'nib' => $request->nib,
                    'pirt' => $pirt,
                    'sertif_halal' => $sertif_halal,
                    'laporan_keuangan_usaha' => $laporan_keuangan_usaha,
                    'total_dana_usaha' => $request->total_dana_usaha,
                    'dana_sekarang' => $request->dana_sekarang,
                    'dana_pinjaman_dibutuhkan' => $request->dana_pinjaman_dibutuhkan,
                    'rincian_kebutuhan_dana' => $request->rincian_kebutuhan_dana,
                    'lama_pengembalian_pinjaman' => $request->lama_pengembalian_pinjaman,
                    'jumlah_pengembalian_per_bulan' => $request->jumlah_pengembalian_per_bulan,
                ]
            );

            return response()->json([
                'status' => 200,
                'message' => 'Data success stored'
            ]);
        }

    }

    public function deleteDataUsaha($id){
        $data = JfDetailDataUsahaAnggota::where('id', $id)->first();
        if ($data) {
            $data->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Data deleted',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data delete error'
            ]);
        }
    }
}
