<?php

use Illuminate\Http\Request;

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


//============================================= V1 version API  =====================================
Route::group(['namespace' => 'Api\V1', 'prefix' => 'v1'], function () {

    Route::get('appversion','AppVersionController@appversioncheck')->name('appversion');

    Route::post('login-with-password', 'LoginController@loginWithPassword')->name('loginwithpassword');
    //Route::post('logout', 'LoginController@logout');

    Route::get('a-to-z-actress', 'ActressController@atozActress')->name('atoz.actress');
    Route::get('latest-actress', 'ActressController@latestActressWallpaperCategory')->name('latest.actress');
    Route::get('popular-actress', 'ActressController@popularActressWallpaperCategory')->name('popular.actress');
    Route::get('actress-category/{actress_id}', 'ActressController@actressWallpaperCategory')->name('actress.category');

    Route::get('wallpapers/{actress_sub_category_id}', 'ActressController@wallpaperList')->name('wallpaper.list');
    Route::get('wallpaper/download/{wallpaper_id}', 'ActressController@updateWallpaperDownloads')->name('wallpaper.downloaded');
    Route::get('wallpaper/share/{wallpaper_id}', 'ActressController@updateWallpaperShares')->name('wallpaper.share');
    Route::post('wallpaper/addtofavorite', 'ActressController@addToFavorite')->name('wallpaper.addtofavorite');
    Route::post('wallpaper/removefromfavorite', 'ActressController@removeFromFavorite')->name('wallpaper.removefromfavorite');
    Route::post('wallpaper/addcomment', 'ActressController@addWallpaperComment')->name('wallpaper.comment');
    Route::post('wallpaper/comment-list', 'ActressController@wallpaperCommentList')->name('wallpaper.comment.list');

    // Register
    Route::post('register', 'RegisterController@register')->name('register');

    Route::get('news-category', 'NewsController@newsCategory')->name('news.category');
    Route::get('news-list', 'NewsController@newsList')->name('news.list');
    Route::get('news-detail/{news_id}', 'NewsController@newsDetail')->name('news.detail');
});
