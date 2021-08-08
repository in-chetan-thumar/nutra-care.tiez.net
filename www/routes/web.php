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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['middleware'=>'language'], function () {
    Route::get('/', 'Front\MainController@home')->name('front.home');
    Route::get('/about-us', 'Front\MainController@aboutUs')->name('front.about.us');
    Route::get('/contact-us', 'Front\MainController@contactUs')->name('front.contact.us');
    Route::post('/contact-us', 'Front\MainController@submitContactUs')->name('submit.contact.inquiry');

    Route::get('/front-products', 'Front\MainController@frontProducts')->name('front.front.products');
    Route::get('/products/{id}', 'Front\MainController@getProductsByCategoryId')->name('front.product.category');
    Route::post('/products/inquiry', 'Front\MainController@submitInquiry')->name('submit.product.inquiry');
    Route::get('/download/{name}', 'Front\MainController@downloadPdf')->name('front.pdf.download');

    Route::get('/privacy-policy', 'Front\MainController@privacyPolicy')->name('front.privacy.policy');
    Route::get('/terms-and-conditions', 'Front\MainController@termsConditions')->name('front.terms.and.conditions');
    Route::get('/sustainability', 'Front\MainController@sustainability')->name('front.sustainability');
    Route::get('/research-development', 'Front\MainController@researchDevelopment')->name('front.research.development');

});

Route::get('/{locale}', function ($locale) {
    Session::put('locale',$locale);
    return redirect(url()->previous());
})->name('locale.lang');
