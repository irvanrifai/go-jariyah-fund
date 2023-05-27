<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = Gallery::all();
        return view('backoffice.gallery.index')->with(compact('gallery'));
    }

    public function index_public()
    {
        $gallery = Gallery::paginate(6);
        return view('public.galeri.index')->with(compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backoffice.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required',

        ], [
            'title.required' => 'Judul Artikel Belum Diisi',
            'image.required' => 'Gambar Belum Dipilih',

        ]);

        $gallery = new Gallery;
        $gallery->title = strip_tags($request->title);
        $gallery->desc = $request->desc;
        $gallery->image = strip_tags($request->image);
        $gallery->is_show = $request->is_show;

        $gallery->save();

        return redirect()->route('backoffice.gallery.index')->with([
            'alert-type' => 'success',
            'message' => 'Data Gallery Berhasil Ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gallery::find($id)->increment('count_show');
        $gallery = Gallery::findOrFail($id);
        return view('backoffice.gallery.show')->with(compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('backoffice.gallery.edit')->with(compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required',

        ], [
            'title.required' => 'Judul Artikel Belum Diisi',
            'image.required' => 'Gambar Belum Dipilih',

        ]);

        $ditampilkan = $request->is_show;
        if ($ditampilkan == "on"){
            $ditampilkan = 1;
        }
        else {
            $ditampilkan = 0;
        }

        $gallery = Gallery::findOrFail($id);
        $gallery->title = strip_tags($request->title);
        $gallery->desc = $request->desc;
        $gallery->image = strip_tags($request->image);
        $gallery->is_show = $ditampilkan;

        $gallery->save();

        return redirect()->route('backoffice.gallery.edit', $gallery->id)->with([
            'status' => 'success',
            'message' => 'Data Gallery Berhasil Diubah'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gallery::findOrFail($id)->delete();
        return redirect()->route('backoffice.gallery.index');
    }
}
