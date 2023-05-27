<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        $slider = Slider::all();
        return view('backoffice.slider.index')->with(compact('slider'));
    }

    public static function get_slider()
    {
        $slider = Slider::where('is_show',1)->get();
        return $slider;
    }
    
    public function slider_home()
    {
        return self::get_slider();
    }

    public function create()
    {
        return view('backoffice.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required',

        ], [
            'title.required' => 'Judul Artikel Belum Diisi',
            'image.required' => 'Gambar Belum Dilampirkan',
        ]);
        $uid = auth()->user()->id;
        $slide = new Slider;
        $slide->created_by = $uid;
        $slide->title = strip_tags($request->title);
        $slide->link = strip_tags($request->link);
        $slide->desc = strip_tags($request->desc);
        $slide->is_show = $request->is_show;
        $slide->image = strip_tags($request->image);
        $slide->save();

        return redirect()->route('backoffice.slider.index')->with([
            'alert-type' => 'success',
            'message' => 'Berhasil Menambahkan Slide ' . $slide->title
        ]);
    }

    public function destroy($id)
    {
        $slide = Slider::findOrFail($id)->delete();
        return back()->with([
            'status' => 'success',
            'message' => 'Data Berhasil Dihapus'
        ]);

    }

    public function show($id)
    {
        $slide = Slider::findOrFail($id);
        return view('backoffice.slider.show')->with(compact('slide'));
    }
    
    public function edit($id)
    {
        $slide = Slider::findOrFail($id);
        return view('backoffice.slider.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $ditampilkan = $request->is_show;
        if ($ditampilkan == "on"){
            $ditampilkan = 1;
        }
        else {
            $ditampilkan = 0;
        }
        $uid = auth()->user()->id;
        $slide = Slider::findOrFail($id);
        $slide->updated_by = $uid;
        $slide->title = strip_tags($request->title);
        $slide->link = strip_tags($request->link);
        $slide->desc = strip_tags($request->desc);
        $slide->is_show = $ditampilkan;
        $slide->image = strip_tags($request->image);
        $slide->save();

        return redirect()->route('backoffice.slider.show', $slide->id)->with([
            'status' => 'success',
            'message' => 'Berhasil Ubah Slide ' . $slide->title
        ]);
    }
}
