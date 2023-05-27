<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CategoryRelationships;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostsController extends Controller
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
        // $list = self::get_cached_posts();
        return view('backoffice.posts.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data  = Posts::query();
            $data->where('type', 'post');
            $data->select('id','status','title');

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($q) {
                    $status = $q->status == 'public' ? 'primary' : 'warning';
                    return '<span class="badge bg-' . $status . '">' . $q->status . '</span>';
                })
                ->addColumn('category_title', function($q){
                    $category_id = DB::table('category_relationships')->where('post_id', $q->id)->pluck('category_id')->first();
                    $category_title = DB::table('categories')->where('id', $category_id)->pluck('title')->first();

                    return $category_title;
                })
                ->addColumn('action', function ($q) {
                    $actionBtn = "<a class='btn btn-link btn-sm text-primary' title='Edit' href='posts/" . $q->id . "/edit'>
                    <i class='fas fa-pen-fancy'></i>&nbsp;</a>
                    <button class='btn btn-link btn-sm text-danger' title='Hapus' onclick='formHapus(" . $q->id . ")'>
                    <i class='fas fa-trash'></i>&nbsp;
                </button>";
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status'])
                ->toJson();
        }
    }

    public function index_posts()
    {
        //        $posts = self::get_cached_posts();
        $posts = DB::table('posts')->where('type', 'post')->where('status', 'public')->paginate(9);

        return view('public.posts')->with(compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('backoffice.posts.create');
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

        $uid = auth()->user()->id;

        $post = new Posts;
        $post->author_id = $uid;
        $post->title = strip_tags($request->title);
        $post->slug = Str::slug($request->slug);
        $post->type = 'post';
        $post->content = htmlentities($request->main_content);
        $post->status = strip_tags($request->status);
        $post->featured_image = strip_tags($request->cover_image);
        $post->save();

        self::post_category($post->id, $request->category);

        Cache::forget('posts_article_list' . date("dmy"));

        return redirect()->route('backoffice.posts.index')->with([
            'alert-type' => 'success',
            'message' => 'Berhasil Publish Artikel ' . $post->title
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
        $post = Posts::findOrFail($id);
        return view('backoffice.posts.edit', compact('post'));
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
        $uid = auth()->user()->id;
        $post = Posts::findOrFail($id);
        $post->title = strip_tags($request->title);
        $post->slug = strip_tags($request->slug);
        $post->content = htmlentities($request->main_content);
        $post->status = strip_tags($request->status);
        $post->featured_image = strip_tags($request->cover_image);
        $post->updated_by = $uid;
        $post->save();
        self::post_category($post->id, $request->category, 'update');

        Cache::forget('posts_article_list' . date("dmy"));
        Cache::forget('posts_article_id' . $id);

        return redirect()->route('backoffice.posts.edit', $post->id)->with([
            'status' => 'success',
            'message' => 'Berhasil Ubah Artikel ' . $post->title
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
        // $cat = self::get_post_category($id, 'id');
        // $del_rel = CategoryRelationships::where('category_id', $cat)->delete();
        // $post = Posts::findOrFail($id)->delete();

        // Cache::forget('posts_article_list' . date("dmy"));
        // Cache::forget('posts_article_id' . $id);

        $post = Posts::find($id);

        // Delete category relationship
        CategoryRelationships::where('post_id', $post->id)->delete();
        // Delete current record
        $post->delete();

        return back()->with([
            'status' => 'success',
            'message' => 'Data Berhasil Dihapus'
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
    public static function get_cached_posts($per_page = 100)
    {
        return Cache::remember('posts_article_list' . date("dmy") . '_' . $per_page, self::$cache_ttl, function () use ($per_page) {
            return self::get_all_posts($per_page);
        });
    }


    /**
     * Get all posts
     */
    public static function get_all_posts($per_page = 100)
    {
        $posts = Posts::where('type', 'post')->take($per_page)->get();
        $list = [];
        foreach ($posts as $post => $p) {
            $list[$post]['id'] = $p['id'];
            $list[$post]['status'] = $p['status'];
            $list[$post]['title'] = $p['title'];
            $list[$post]['slug'] = $p['slug'];
            $list[$post]['type'] = $p['type'];
            $list[$post]['content'] = $p['content'];
            $list[$post]['last_view'] = $p['last_view'];
            $list[$post]['views'] = $p['views'];
            $list[$post]['featured_image'] = $p['featured_image'];
            $list[$post]['category']['id'] = self::get_post_category($p['id'], 'id');
            $list[$post]['category']['slug'] = self::get_post_category($p['id'], 'slug');
            $list[$post]['category']['title'] = self::get_post_category($p['id'], 'title');
            $list[$post]['category']['icon'] = self::get_post_category($p['id'], 'icon');
            $list[$post]['created_at'] = $p['created_at'];
            $list[$post]['created_at_human'] = $p['created_at'];
            $list[$post]['date_readable'] = Date::parse($p['created_at'])->diffForHumans();
        }

        return $list;
    }

    public function categoryIndex($slug)
    {
        $category = Categories::where('slug', $slug)->first();
        $title = $category->title;
        //        $categoryRel = CategoryRelationships::where('category_id',$category->id);
        //
        $posts_raw = DB::table('category_relationships')
            ->join('posts', 'posts.id', '=', 'category_relationships.post_id')
            ->join('categories', 'categories.id', '=', 'category_relationships.category_id')
            ->where('categories.id', $category->id)
            ->where('posts.status', 'public')
            ->where('posts.type', 'post')
            ->select('posts.*', 'categories.title AS category_name', 'categories.id AS category_id')
            ->orderBy('id')
            ->get();

        $posts = $posts_raw->unique();
        $current_category_slug = $slug;

        return view('public.category')->with(compact('posts', 'title', 'current_category_slug'));
    }


    /**
     * Get Post by Slug
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function get_post_by_slug($slug)
    {
        if (empty($slug)) {
            return redirect()->route('public.indexPosts');
        }

        $post = Posts::where('slug', $slug)->where('type', 'post')->first();

        if (empty($post->id)) {
            abort(404);
        }

        // Update the post count
        Posts::find($post->id)->increment('views');

        return view('public.post', compact('post'));
    }


    /**
     * Ajax Page/Post Viewer
     *
     * @param int $id
     * @return string
     */
    public function add_viewer($id)
    {
        $post = Posts::findOrFail($id);
        $post->last_view = $post->last_view + 1;
        $post->save();

        return 'Current View for ' . $post->title . ' is ' . $post->last_view;
    }

    public static function get_article_posts()
    {
        $posts = Posts::where('type', 'post')
            ->orderByDesc('id')
            ->get();
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
            $list[$post]['created_at_human'] = $p['created_at'];
            $list[$post]['date_readable'] = Date::parse($p['created_at'])->diffForHumans();
        }

        return $list;
    }
}
