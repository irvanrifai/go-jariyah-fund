<?php

namespace Database\Seeders;

use App\Models\Posts;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'author_id' => 1,
                'slug' => 'sejarah',
                'seo_meta_description' => null,
                'excerpt' => null,
                'title' => 'Sejarah',
                'content' => '&lt;p&gt;ni sejarah&lt;/p&gt;',
                'seo_index' => null,
                'featured_image' => '',
                'type' => 'page',
                'status' => 'public',
                'updated_by' => null
            ],
            [
                'author_id' => 1,
                'slug' => 'pertemuan-pertama',
                'seo_meta_description' => null,
                'excerpt' => null,
                'title' => 'Pertemuan Pertama',
                'content' => '&lt;p&gt;Ini deskripsinya pertemuan pertama&lt;/p&gt;',
                'seo_index' => null,
                'featured_image' => env('APP_URL') . '/storage/photos/1/610935e767f6b.png',
                'type' => 'post',
                'status' => 'public',
                'updated_by' => null
            ],
            [
                'author_id' => 1,
                'slug' => 'covid-19-bisa-dibasmi-pakai-cara-mandi-ait-laut',
                'seo_meta_description' => null,
                'excerpt' => null,
                'title' => 'Covid 19 Bisa Dibasmi Pakai Cara Mandi Ait Laut',
                'content' => '&lt;p&gt;Ini isi kontennya, &lt;font color=&quot;#ffff00&quot;&gt;ini tulisan warna kuning&lt;/font&gt;. &lt;span style=&quot;background-color: rgb(107, 173, 222);&quot;&gt;Nah kalau ini background tulisannya yg biru&lt;/span&gt;.&amp;nbsp;&lt;br&gt;Selanjutnya coba table&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;table class=&quot;table table-bordered&quot;&gt;&lt;tbody&gt;&lt;tr&gt;&lt;td&gt;Nama&lt;/td&gt;&lt;td&gt;Telpon&lt;/td&gt;&lt;td&gt;Keterangan&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;Taufik&lt;/td&gt;&lt;td&gt;08123xxxx&lt;/td&gt;&lt;td&gt;Madiun Punya&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;&lt;p&gt;&lt;br&gt;Ini tulisan &lt;b&gt;tebal&lt;/b&gt;. Kemudan &lt;i&gt;miring&lt;/i&gt; dan font nya besar yg &lt;span style=&quot;font-size: 24px;&quot;&gt;ini&lt;/span&gt;. Kalau ini yg normal&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://kemenkop.test/storage/photos/1/610935f2359dd.png&quot; style=&quot;width: 800px;&quot;&gt;&lt;br&gt;&lt;/p&gt;',
                'seo_index' => null,
                'featured_image' => env('APP_URL') . '/storage/photos/1/610935f2359dd.png',
                'type' => 'post',
                'status' => 'public',
                'updated_by' => null
            ],
            [
                'author_id' => 1,
                'slug' => 'taufik-naik-haji',
                'seo_meta_description' => null,
                'excerpt' => null,
                'title' => 'Taufik Naik Haji',
                'content' => '&lt;p&gt;Ini tulisan taufik naik haji&amp;nbsp;&lt;/p&gt;&lt;table class=&quot;table table-bordered&quot;&gt;&lt;tbody&gt;&lt;tr&gt;&lt;td&gt;Judul 1&lt;/td&gt;&lt;td&gt;Judul 2&lt;/td&gt;&lt;td&gt;Judul 3&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;ini&lt;/td&gt;&lt;td&gt;isi&lt;/td&gt;&lt;td&gt;halo&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;gas&lt;/td&gt;&lt;td&gt;gasss&lt;/td&gt;&lt;td&gt;joss&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;&lt;p&gt;&lt;img src=&quot;https://kemenkop.test/storage/photos/1/61093614d7cd4.jpeg&quot; style=&quot;width: 800px;&quot;&gt;&lt;br&gt;&lt;/p&gt;',
                'seo_index' => null,
                'featured_image' => env('APP_URL') . '/storage/photos/1/61093614d7cd4.jpeg',
                'type' => 'post',
                'status' => 'public',
                'updated_by' => null
            ],
            [
                'author_id' => 1,
                'slug' => 'visi-misi',
                'seo_meta_description' => null,
                'excerpt' => null,
                'title' => 'Visi Misi',
                'content' => '&lt;p&gt;&lt;b&gt;&lt;span style=&quot;font-size: 18px;&quot;&gt;Visi&lt;/span&gt;&lt;/b&gt;&lt;/p&gt;&lt;p&gt;Paragraf 1 dan seterusnya&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;b&gt;&lt;span style=&quot;font-size: 18px;&quot;&gt;Misi&lt;/span&gt;&lt;/b&gt;&lt;/p&gt;&lt;p&gt;Paragraf 1 dan seterusnya&lt;b&gt;&lt;span style=&quot;font-size: 18px;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/b&gt;&lt;/p&gt;',
                'seo_index' => null,
                'featured_image' => '',
                'type' => 'page',
                'status' => 'public',
                'updated_by' => null
            ],
            [
                'author_id' => 1,
                'slug' => 'tugas-pokok-dan-fungsi',
                'seo_meta_description' => null,
                'excerpt' => null,
                'title' => 'Tugas Pokok dan Fungsi',
                'content' => '&lt;p&gt;Ini isi halaman tugas pokok dan fungsi&lt;/p&gt;',
                'seo_index' => null,
                'featured_image' => '',
                'type' => 'page',
                'status' => 'public',
                'updated_by' => null
            ],
            [
                'author_id' => 1,
                'slug' => 'struktur-kelembagaan',
                'seo_meta_description' => null,
                'excerpt' => null,
                'title' => 'Struktur Kelembagaan',
                'content' => '&lt;p&gt;Ini isi struktur kelembagaan&amp;nbsp;&lt;/p&gt;',
                'seo_index' => null,
                'featured_image' => '',
                'type' => 'page',
                'status' => 'public',
                'updated_by' => null
            ],
            [
                'author_id' => 1,
                'slug' => 'sumber-daya-manusia',
                'seo_meta_description' => null,
                'excerpt' => null,
                'title' => 'Sumber Daya Manusia',
                'content' => '&lt;p&gt;Ini isi sumber daya manusia&lt;/p&gt;',
                'seo_index' => null,
                'featured_image' => '',
                'type' => 'page',
                'status' => 'public',
                'updated_by' => null
            ],
        ];

        foreach ($posts as $post) {
            Posts::create([
                'author_id' => $post['author_id'],
                'slug' => $post['slug'],
                'seo_meta_description' => $post['seo_meta_description'],
                'excerpt' => $post['excerpt'],
                'title' => $post['title'],
                'content' => $post['content'],
                'seo_index' => $post['seo_index'],
                'featured_image' => $post['featured_image'],
                'type' => $post['type'],
                'status' => $post['status'],
                'updated_by' => $post['updated_by']
            ]);
        }
    }
}
