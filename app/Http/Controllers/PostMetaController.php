<?php


namespace App\Http\Controllers;


use App\Models\PostMeta;
use Illuminate\Support\Facades\Log;

class PostMetaController
{

    /**
     * Meta Mapper
     */
    public static $meta_map = [
        'tentang-kami' => [
            'title' => 'About Us Meta Data',
            'name' => 'meta_data',
            'meta' => [
                'youtube_url' => [
                    'title' => 'Link YouTube',
                    'type' => 'url',
                    'required' => 1,
                ],
                'sub_title' => [
                    'title' => 'Sub Title',
                    'type' => 'text',
                    'required' => 1
                ],
                'description' => [
                    'title' => 'Deskripsi',
                    'type' => 'textarea',
                    'required' => 1
                ],
                'cover' => [
                    'title' => 'Cover Image',
                    'type' => 'file',
                    'required' => 1
                ],
            ]
        ]
    ];

    /**
     * Check if post are have meta
     *
     * @param  $slug
     * @return bool
     */
    public static function is_meta($slug)
    {
        return array_key_exists($slug, self::$meta_map);
    }

    /**
     * Print Meta Section
     *
     * @param  $slug
     * @return string
     */
    public static function build_section($slug): string
    {
        $meta = self::$meta_map[$slug];
        return view('backoffice.meta.section')->with(compact('meta','slug'))->render();
    }

    public static function set_meta($slug, $key, $value)
    {
        $old_meta = PostMeta::where('slug', $slug)->where('key', $key)->first();
        Log::debug($old_meta);

        if (isset($old_meta)) {
            $update = PostMeta::find($old_meta->id);
            $update->value = htmlentities($value);
            $update->save();

            return $update->id;
        }

        $meta = new PostMeta();
        $meta->slug = strip_tags($slug);
        $meta->key = strip_tags($key);
        $meta->value = htmlentities($value);
        $meta->save();
        return $meta->id;
    }

    public static function get_meta($slug, $key)
    {
        $meta = PostMeta::where('slug', $slug)->where('key', $key)->first();

        if (isset($meta)){
            return $meta->value;
        }

        return null;

    }


}
