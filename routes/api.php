<?php

use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Internal API
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {
    Route::get('/greeting', function () {
        return 'Hello World';
    });


    // sales machine
    Route::group([
        'prefix' => 'artikel',
        'as' => 'artikel.',
    ], function () {
        Route::get('/lists', [PostsController::class, 'get_cached_posts']);
    });

});

Route::group([
    'prefix' => 'method',
    'as' => 'method.',
], function () {
    Route::get('/session/flush', function (Request $request) {
        return 'Hello World';
    });
});

Route::middleware(['throttle:public-api'])->group(function () {
    Route::get('/add-post-view/{id?}', [PostsController::class, 'add_viewer']);
});