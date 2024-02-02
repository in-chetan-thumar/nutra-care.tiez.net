<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => 'admin'], function () {

    Auth::routes(['register' => false, 'logout' => false]);
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});

Route::group(['middleware' => 'language'], function () {
    Route::get('/', 'Front\MainController@home')->name('front.home');
    Route::get('/about-us', 'Front\MainController@aboutUs')->name('front.about.us');
    Route::get('/contact-us', 'Front\MainController@contactUs')->name('front.contact.us');
    Route::post('/contact-us', 'Front\MainController@submitContactUs')->name('submit.contact.inquiry');

    Route::get('/front-products/{category_id?}/{sub_category_id?}', 'Front\MainController@frontProducts')->name('front.front.products');
    Route::match(['get', 'post'], '/products-filter/{category_id?}/{sub_category_id?}', 'Front\MainController@productFilter')->name('front.front.products.filter');
    Route::get('/products-list', 'Front\MainController@productList')->name('front.front.products.list');
    //    Route::post('/products-table', 'Front\MainController@getProductsByCategoryId')->name('front.product.category');
    Route::post('/products/inquiry', 'Front\MainController@submitInquiry')->name('submit.product.inquiry');
    Route::get('/download/{name}', 'Front\MainController@downloadPdf')->name('front.pdf.download');

    Route::get('/privacy-policy', 'Front\MainController@privacyPolicy')->name('front.privacy.policy');
    Route::get('/terms-and-conditions', 'Front\MainController@termsConditions')->name('front.terms.and.conditions');
    Route::get('/sustainability', 'Front\MainController@sustainability')->name('front.sustainability');
    Route::get('/research-development', 'Front\MainController@researchDevelopment')->name('front.research.development');
    Route::post('/products', 'Front\MainController@getProductsByCategoryId')->name('front.product.category');
    Route::post('/select-all', 'Front\MainController@getSelectAll')->name('front.select.all');
    Route::get('/search-product', 'Front\MainController@searchProduct')->name('front.search.product');
});

Route::get('/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect(url()->previous());
})->name('locale.lang');
Route::group(['middleware' => ['auth']], function () {


    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'role:' . config('constants.ROLES.ADMIN')], function () {

        // Dashbaord
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        //Route::get('/', 'DashboardController@index')->name('dashboard');


        // Profile
        Route::get('update-profile', 'ProfileController@viewUpdateProfile')->name('update-profile.view');
        Route::post('update-profile', 'ProfileController@SaveUpdateProfile')->name('update-profile.save');
        Route::post('change-password', 'ProfileController@changePassword')->name('change-password');

        //Users
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UserController@index')->name('users.index');
            Route::post('/', 'UserController@store')->name('users.store');
            Route::get('{id}/edit', 'UserController@edit')->name('users.edit');
            Route::post('{id}', 'UserController@update')->name('users.update');
            Route::delete('{id}', 'UserController@destroy')->name('users.destroy');
        });


        // Notification
        Route::group(['prefix' => 'notification'], function () {
            Route::get('/', 'NotificationController@index')->name('notification.index');
            Route::post('/', 'NotificationController@store')->name('notification.store');
            Route::get('{id}/edit', 'NotificationController@edit')->name('notification.edit');
            Route::post('{id}', 'NotificationController@update')->name('notification.update');
            Route::delete('{id}', 'NotificationController@destroy')->name('notification.destroy');
        });

        // News
        Route::group(['prefix' => 'news'], function () {
            // Category
            Route::group(['prefix' => 'category'], function () {
                Route::get('/', 'NewsCategoryController@index')->name('newscategory.index');
                Route::post('/', 'NewsCategoryController@store')->name('newscategory.store');
                Route::get('{id}/edit', 'NewsCategoryController@edit')->name('newscategory.edit');
                Route::post('{id}', 'NewsCategoryController@update')->name('newscategory.update');
                Route::delete('{id}', 'NewsCategoryController@destroy')->name('newscategory.destroy');
            });

            // News
            Route::get('/', 'NewsController@index')->name('news.index');
            Route::post('/', 'NewsController@store')->name('news.store');
            Route::get('{id}/edit', 'NewsController@edit')->name('news.edit');
            Route::post('{id}', 'NewsController@update')->name('news.update');
            Route::delete('{id}', 'NewsController@destroy')->name('news.destroy');
        });


        /*Dhwani*/
        // Route::get('usermanagement', 'UsermanageController@index')->name('usermanagement');
        Route::get('notification-new', 'NotificationController@new')->name('notification.new');
        Route::get('newscategory', 'NewsCategoryController@new')->name('newscategory.new');
        //Route::get('managenews-new', 'ManagenewsController@index')->name('managenews.new');
        //Route::get('managewallpaper', 'ManagewallpaperController@index')->name('managewallpaper');

        // Contact Route

        Route::resource('contacts', 'ContactController');
        Route::get('contact', 'ContactController@index')->name('contact.index');

        // Page Route

        Route::resource('pages', 'PageController');
        Route::get('page', 'PageController@index')->name('page.index');

        // Product Route

        Route::resource('products', 'ProductController');
        Route::get('product', 'ProductController@index')->name('product.index');

        // Category Route

        Route::resource('categories', 'CategoryController');
        Route::get('category', 'CategoryController@index')->name('category.index');

        // Setting Route

        Route::resource('settings', 'SettingsController');
        Route::get('setting', 'SettingsController@index')->name('setting.index');

        // Attribute Route

        Route::resource('attributes', 'AttributeController');
        Route::get('attribute', 'AttributeController@index')->name('attribute.index');

        // Inquiry Route

        Route::resource('inquiries', 'InquiryController');
        Route::get('inquiry', 'InquiryController@index')->name('inquiry.index');
    });
});
