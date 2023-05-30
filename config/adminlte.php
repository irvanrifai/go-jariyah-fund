<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'Jariyah Fund',
    'title_prefix' => '',
    'title_postfix' => ' - Jariyah Fund',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => true,
    'use_full_favicon' => true,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Jariyah Fund</b>',
    'logo_img' => 'img/static/desain-03.png',
    'logo_img_class' => 'brand-image',
    'logo_img_xl' => 'img/static/desain-01.png',
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Jariyah Fund',


    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-warning',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => 'text-center',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-warning',


    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => 'admin-theme-jogja',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-light-jf elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',


    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,


    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',


    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'anggota/dashboard',
    'logout_url' => 'anggota/logout',
    'login_admin_url' => 'admin-login',
    'login_user_url' => 'user-login',
    'register_url' => 'backoffice/register',
    'password_reset_url' => 'account/password/reset',
    'password_email_url' => 'account/password/email',
    // 'password_reset_url' => false,
    // 'password_email_url' => false,
    'profile_url' => false,
    'header_user' => 'Login User',
    'header_admin' => 'Login Admin',

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => true,
    'laravel_mix_css_path' => 'css/backoffice-style.css',
    'laravel_mix_js_path' => 'js/backoffice-script.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        [
            'text' => 'Dashboard',
            'icon' => 'fas fa-fw fa-tachometer-alt',
            'url'  => 'anggota/dashboard',
        ],
        [
            'text' => 'Peminjaman',
            'icon' => 'fas fa-hand-holding-usd fa-fw',
            'submenu' => [
                [
                    'text' => 'Pinjaman Saya',
                    'url' => 'anggota/pinjam/my',
                ],
                [
                    'text' => 'Pengajuan Pinjam',
                    'url' => 'anggota/pinjam/request',
                ],
                [
                    'text' => 'Pinjaman Anggota Lain',
                    'url' => 'anggota/pinjam/other',
                ],
                [
                    'text' => 'Simulasi Pinjam',
                    'url' => 'anggota/simulation',
                ],
            ]
        ],
        [
            'text' => 'Dana Bersama',
            'icon' => 'fas fa-donate fa-fw',
            'submenu' => [
                [
                    'text' => 'Statistik',
                    'url' => 'anggota/statistik',
                ],
                [
                    'text' => 'Peruntukan',
                    'url' => 'anggota/peruntukan',
                ],
            ]
        ],
        // [
        //     'text' => 'Saran',
        //     'icon' => 'fas fa-fw fa-comments',
        //     'url'  => 'backoffice/advice',
        // ],
        // [
        //     'text' => 'Artikel',
        //     'icon' => 'fas fa-fw fa-edit',
        //     'submenu' => [
        //         [
        //             'text' => 'Tulisan Baru',
        //             'url' => 'backoffice/posts/create',
        //         ],
        //         [
        //             'text' => 'Semua Tulisan',
        //             'url' => 'backoffice/posts',
        //         ],
        //         [
        //             'text' => 'Kategori',
        //             'url' => 'backoffice/categories',
        //         ],
        //     ]
        // ],
        // [
        //     'text' => 'Halaman',
        //     'icon' => 'far fa-fw fa-file',
        //     'url' => '#',
        //     'submenu' => [
        //         [
        //             'text' => 'Halaman Baru',
        //             'url' => 'backoffice/pages/create',
        //         ],
        //         [
        //             'text' => 'Semua Halaman',
        //             'url' => 'backoffice/pages',
        //         ],
        //     ],
        // ],
        // [
        //     'text' => 'Slider',
        //     'icon' => 'fas fa-fw fa-images',
        //     //'can'  => 'manage-blog',
        //     'submenu' => [
        //         [
        //             'text' => 'Slide Baru',
        //             'url' => 'backoffice/slider/create',
        //         ],
        //         [
        //             'text' => 'Semua Slide',
        //             'url' => 'backoffice/slider',
        //         ],
        //     ],
        // ],
        // [
        //     'text' => 'Galeri',
        //     'icon' => 'fas fa-fw fa-camera-retro',
        //     //'can'  => 'manage-blog',
        //     'submenu' => [
        //         [
        //             'text' => 'Gambar Baru',
        //             'url' => 'backoffice/gallery/create',
        //         ],
        //         [
        //             'text' => 'Semua Gambar',
        //             'url' => 'backoffice/gallery',
        //         ],
        //     ],
        // ],
        // [
        //     'text' => 'Master Data & Settings',
        //     'icon' => 'fas fa-fw fa-cogs',
        //     'submenu' => [
        //         [
        //             'text' => 'Web Setting',
        //             'icon' => 'fab fa-fw fa-chrome',
        //             'url' => 'backoffice/settings',
        //         ],
        //         [
        //             'text' => 'Pengguna',
        //             'icon' => 'fas fa-fw fa-users-cog',
        //             'url' => 'backoffice/users',
        //         ],
        //     ],
        // ],

        // [
        //     'text' => 'User Guide',
        //     'icon' => 'fa fa-question-circle',
        //     'url' => 'anggota/user-guide'
        // ],
        // [
        //     'text' => 'Logout',
        //     'url' => 'anggota/logout',
        // ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        //JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
        //JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        App\myfilter\MyApp::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'Summernote' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    */

    'livewire' => false,
];
