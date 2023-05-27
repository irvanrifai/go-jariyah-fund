<?php


namespace App\Http\Controllers;

use App\Models\BestEmployee;
use App\Models\Gallery;
use App\Models\WbsTopic;
use App\Models\WebsiteSettings;
use App\Models\Posts;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function home(){
        // dd(Hash::make('password'));
        return "Whooopppss!";
        $gallery = Gallery::take(6)->where('is_show',1)->get();
        $post = PostsController::get_cached_posts(3);
        return view('public.home');
        // $post = Posts::join('categories', 'categories.id', '=', '')->orderBy('created_at', 'DESC')->limit(3)->with('categories')->get();
        // print_r($post);die();

    //     $title = WebsiteSettings::where('key', 'title')->first();
    //     $description = WebsiteSettings::where('key', 'description')->first();
    //     $link_modal = WebsiteSettings::where('key', 'link_modal')->first();
    //     $pict_modal = WebsiteSettings::where('key', 'pict_modal')->first();
    //     $best_employee_desc = WebsiteSettings::where('key', 'best_employee')->first();

    //     // $employee = BestEmployee::first();

    //     // $laporan_masuk = WbsTopic::count();
    //     // $laporan_proses = WbsTopic::where('status', '=', 'on-progress')->count();
    //     // $laporan_selesai = WbsTopic::where('status', '=', 'finish')->count();
    //     // $laporan_tidak_diproses = WbsTopic::where('status', '=', 'no-response')->count();
    //     return view('public.home')->with(compact('post', 'gallery', 'laporan_masuk', 'laporan_proses', 'laporan_selesai', 'laporan_tidak_diproses', 'title', 'description', 'link_modal', 'pict_modal', 'employee', 'best_employee_desc'));
     }
}
