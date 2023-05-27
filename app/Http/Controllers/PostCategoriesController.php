<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CategoryRelationships;
use Carbon\Carbon;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class PostCategoriesController extends Controller
{
    /**
     * Post Cache
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
        $list = self::get_categories();
        return view('backoffice.posts.category')->with(compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('backoffice.posts.category');
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

        ], [
            'title.required' => 'Judul Artikel Belum Diisi',

        ]);

        $post = new Categories();
        $post->title = strip_tags($request->title);
        $post->slug = Str::slug($request->title);
        $post->description = htmlentities($request->description);
        //$post->icon = strip_tags($request->cover_image);
        $post->save();

        Cache::forget('posts_article_all_category_info_' . date("dmy"));

        return redirect()->route('backoffice.categories.index')->with([
            'alert-type' => 'success',
            'message' => 'Berhasil Tambah Kategori ' . $post->title
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categories::findOrFail($id);
        $list = self::get_categories();
        return view('backoffice.posts.category-edit')->with(compact('list'))->with(compact('category'));
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
        $category = Categories::findOrFail($id);
        $category->title = strip_tags($request->title);
        $category->description = htmlentities($request->description);
        //$category->icon = strip_tags($request->cover_image);
        $category->save();
        Cache::forget('posts_article_all_category_info_' . date("dmy"));

        return redirect()->route('backoffice.categories.edit', $category->id)->with([
            'status' => 'success',
            'message' => 'Berhasil Ubah Kategori ' . $category->title
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $cat = Categories::findOrFail($id)->delete();
        Cache::forget('posts_article_all_category_info_' . date("dmy"));

        return back()->with([
            'status' => 'success',
            'message' => 'Kategori Berhasil Dihapus'
        ]);

    }

    /**
     * Set Category
     */
    public static function post_category($post_id, $category_id, $action = 'insert')
    {
        if ('insert' === $action) {
            return $relation = CategoryRelationships::create([
                'post_id' => $post_id,
                'category_id' => $category_id,
            ]);

        } else if ('update' === $action) {
            $relation = CategoryRelationships::where('post_id', $post_id)->first();
            $relation->category_id = $category_id;
            return $relation->save();
        }
        return false;
    }

    /**
     * Get Post Category
     */
    public static function get_post_category($id, $key = null)
    {
        $data = CategoryRelationships::where('post_id', $id)->first();

        if (isset($data))
            return self::get_category_info($data->category_id, $key);

        return $data;
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
     * Get list of Category
     */
    public static function get_categories()
    {
        return Cache::remember('posts_article_all_category_info_' . date("dmy"), self::$cache_ttl, function () {
            return Categories::all();
        });
    }

    /**
     * Get Category Info
     */

    public static function get_category_info($id, $key = "")
    {
        $data = Cache::remember('posts_article_category_info_' . $key . '__' . $id . date("dmy"), self::$cache_ttl, function () use ($id) {
            return Categories::find($id);
        });

        if (isset($key)) {
            return $data[$key];
        }

        return $data;
    }

    /**
     * Get cached posts
     * cached for 10800 (30 Seconds)
     */
    public static function get_cached_posts()
    {
        return Cache::remember('posts_article__list_' . date("dmy"), self::$cache_ttl, function () {
            return self::get_all_posts();
        });

    }


    /**
     * Get all posts
     */
    public static function get_all_posts()
    {
        $posts = Posts::where('type', 'post')->take(300)->get();
        $list = [];
        foreach ($posts as $post => $p) {
            $list[$post]['id'] = $p['id'];
            $list[$post]['status'] = $p['status'];
            $list[$post]['title'] = $p['title'];
            $list[$post]['slug'] = $p['slug'];
            $list[$post]['type'] = $p['type'];
            $list[$post]['content'] = $p['content'];
            $list[$post]['views'] = $p['views'];
            $list[$post]['featured_image'] = $p['featured_image'];
            $list[$post]['category']['id'] = self::get_post_category($p['id'], 'id');
            $list[$post]['category']['slug'] = self::get_post_category($p['id'], 'slug');
            $list[$post]['category']['title'] = self::get_post_category($p['id'], 'title');
            $list[$post]['category']['icon'] = self::get_post_category($p['id'], 'icon');
            $list[$post]['created_at'] = $p['created_at'];
            $list[$post]['date_readable'] = Date::parse($p['created_at'])->diffForHumans();
        }

        return $list;

    }
}

