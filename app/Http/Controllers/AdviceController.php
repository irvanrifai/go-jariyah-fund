<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Saran;
use App\Exports\SaranExport;
use Maatwebsite\Excel\Facades\Excel;

class AdviceController extends Controller
{
    public function show_create_form()
    {
        $jumlah_saran = Saran::all()->count();
        return view('public.saran.create')->with(compact('jumlah_saran'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tambah_saran(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'telp' => ['required', 'max:14'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'subject' => 'required',
            'text' => 'required',

        ], [
            'name.required' => 'Masukkan Nama Lengkap!',
            'name.max' => 'Masukkan nama dengan benar!',
            'telp.required' => 'Masukkan Nomor Telepon!',
            // 'telp.integer' => 'Masukkan nomor telepon dengan benar!',
            'telp.max' => 'Masukkan nomor telepon dengan benar!',
            'email.required' => 'Harap masukkan email!',
            'email.email' => 'Harap masukkan email dengan benar!',
            'subject.required' => 'Masukkan Subjek!',
            'text.required' => 'Masukkan Isi Pesan!',

        ]);

        $saran = new Saran;
        $saran->name = strip_tags($request->name);
        $saran->telp = strip_tags($request->telp);
        $saran->email = strip_tags($request->email);
        $saran->subject = $request->subject;
        $saran->text = strip_tags($request->text);
        $saran->status = strip_tags($request->status);

        $user_agent = $request->header('User-Agent');
        $bname = 'Unknown';
        $platform = 'Unknown';

        //First get the platform?
        if (preg_match('/linux/i', $user_agent)) {
            $platform = 'Linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
            $platform = 'Mac';
        }
        elseif (preg_match('/windows|win32/i', $user_agent)) {
            $platform = 'Windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$user_agent) && !preg_match('/Opera/i',$user_agent))
        {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }
        elseif(preg_match('/Firefox/i',$user_agent))
        {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        }
        elseif(preg_match('/Chrome/i',$user_agent))
        {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        }
        elseif(preg_match('/Safari/i',$user_agent))
        {
            $bname = 'Apple Safari';
            $ub = "Safari";
        }
        elseif(preg_match('/Opera/i',$user_agent))
        {
            $bname = 'Opera';
            $ub = "Opera";
        }
        elseif(preg_match('/Netscape/i',$user_agent))
        {
            $bname = 'Netscape';
            $ub = "Netscape";
        }
        $saran->user_agent = $platform.' | '.$bname;
        $saran->save();
        return back()->with(['success'=>'Terima kasih atas saran yang telah diberikan.']);
    }

    public function index()
    {
        $list = Saran::take(100)->get();
        return view('backoffice.advice.index')->with(compact('list'));
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saran = Saran::findOrFail($id);
        return view('backoffice.advice.show')->with(compact('saran'));
    }

    public function destroy($id){
        $list = Saran::find($id)->delete();
        return redirect('/backoffice/advice');; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saran = Saran::findOrFail($id);
        return view('backoffice.advice.edit', compact('saran'));
    }

    public function update(Request $request, $id)
    {
        $uid = auth()->user()->id;
        $saran = Saran::findOrFail($id);
        $saran->status = strip_tags($request->status);
        $user_agent = $request->header('User-Agent');
        $bname = 'Unknown';
        $platform = 'Unknown';

        //First get the platform?
        if (preg_match('/linux/i', $user_agent)) {
            $platform = 'Linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
            $platform = 'Mac';
        }
        elseif (preg_match('/windows|win32/i', $user_agent)) {
            $platform = 'Windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$user_agent) && !preg_match('/Opera/i',$user_agent))
        {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }
        elseif(preg_match('/Firefox/i',$user_agent))
        {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        }
        elseif(preg_match('/Chrome/i',$user_agent))
        {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        }
        elseif(preg_match('/Safari/i',$user_agent))
        {
            $bname = 'Apple Safari';
            $ub = "Safari";
        }
        elseif(preg_match('/Opera/i',$user_agent))
        {
            $bname = 'Opera';
            $ub = "Opera";
        }
        elseif(preg_match('/Netscape/i',$user_agent))
        {
            $bname = 'Netscape';
            $ub = "Netscape";
        }
        $saran->user_agent = $platform.' | '.$bname;
        $saran->save();
        return redirect()->route('backoffice.advice.index')->with([
            'status' => 'success',
            'message' => 'Berhasil Ubah Saran ' . $saran->title
        ]);
    }

    public function export() 
    {
        $filename = 'Laporan_Saran_'.date('Y-m-d').'.xlsx';
        return Excel::download(new SaranExport, $filename);
    }

}
