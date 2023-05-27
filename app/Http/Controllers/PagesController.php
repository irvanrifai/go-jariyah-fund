<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    /**
     * Post Cache
     *
     * @var int
     */
    private static $cache_ttl = 7200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $list = self::get_cached_pages();
        return view('backoffice.pages.index')->with(compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('backoffice.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(
            [
            'title' => 'required',

            ], [
            'title.required' => 'Judul Artikel Belum Diisi',

            ]
        );

        $uid = auth()->user()->id;

        $post = new Posts;
        $post->author_id = $uid;
        $post->title = strip_tags($request->title);
        $post->slug = Str::slug($request->slug);
        $post->type = 'page';
        $post->content = htmlentities($request->main_content);
        $post->status = strip_tags($request->status);
        $post->featured_image = strip_tags($request->cover_image);
        $post->save();

        Cache::forget('posts_page__list_' . date("dmy"));

        return redirect()->route('backoffice.pages.index')->with(
            [
            'alert-type' => 'success',
            'message' => 'Berhasil Publish Halaman ' . $post->title
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Posts::findOrFail($id);
        $is_meta = PostMetaController::is_meta($page->slug);
        $meta_section = $is_meta ? PostMetaController::build_section($page->slug) : '';

        return view('backoffice.pages.edit', compact('page', 'meta_section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $uid = auth()->user()->id;
        $post = Posts::findOrFail($id);
        $post->title = strip_tags($request->title);
        $post->slug = strip_tags($request->slug);
        $post->content = htmlentities($request->main_content);
        $post->status = strip_tags($request->status);
        $post->featured_image = strip_tags($request->cover_image);
        $post->updated_by = $uid;
        $post->save();

        Cache::forget('posts_page__list_' . date("dmy"));
        Cache::forget('posts_page__id_' . $id);

        if(isset($request->meta_data) && is_array($request->meta_data)){
            foreach($request->meta_data as $ky => $v){
                Log::debug($ky.' : '.$v);
                PostMetaController::set_meta($request->slug,$ky,$v);
            }
        }

        return redirect()->route('backoffice.pages.edit', $post->id)->with(
            [
            'status' => 'success',
            'message' => 'Berhasil Ubah Halaman ' . $post->title
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $post = Posts::findOrFail($id)->delete();

        Cache::forget('posts_page__list_' . date("dmy"));
        Cache::forget('posts_page__id_' . $id);

        return back()->with(
            [
            'status' => 'success',
            'message' => 'Halaman Berhasil Dihapus'
            ]
        );

    }


    /**
     * Get Post Info
     */
    public static function get_post_info($id, $key = null)
    {
        $data = Posts::find($id);

        if (isset($key)) {
            return $data[$key];
        }

        return $data;
    }


    /**
     * Get cached posts
     * cached for 10800 (30 Seconds)
     */
    public static function get_cached_pages()
    {
        return Cache::remember(
            'posts_page__list_' . date("dmy"), self::$cache_ttl, function () {
                return self::get_all_pages();
            }
        );

    }


    /**
     * Get all posts
     */
    public static function get_all_pages()
    {
        $posts = Posts::where('type', 'page')->take(300)->get();
        $list = [];
        foreach ($posts as $post => $p) {
            $list[$post]['id'] = $p['id'];
            $list[$post]['status'] = $p['status'];
            $list[$post]['title'] = $p['title'];
            $list[$post]['slug'] = $p['slug'];
            $list[$post]['type'] = $p['type'];
            $list[$post]['views'] = $p['views'];
            $list[$post]['content'] = $p['content'];
            $list[$post]['featured_image'] = $p['featured_image'];
            $list[$post]['created_at'] = $p['created_at'];
            $list[$post]['date_readable'] = Date::parse($p['created_at'])->diffForHumans();
        }

        return $list;

    }

    /**
     * Get Post by Slug
     *
     * @param  int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function get_page_by_slug($slug)
    {
        $post = Posts::where('slug', $slug)->where('type', 'page')->first();
        if (empty($post->id)) {
            abort(404);
        }

        $is_page = 'ok';
        return view('public.post-profile', compact('post', 'is_page'));
    }


}
