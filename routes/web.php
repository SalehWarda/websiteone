<?php

use App\Http\Controllers\Site\CustomerController;
use App\Http\Controllers\Site\LoginController;
use App\Http\Controllers\Site\PaymentController;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Auth::routes();
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

    Route::group(['middleware' => 'auth:web'], function () {


        Route::post('/logout-users', [LoginController::class, 'logout'])->name('site.logout.user');
        Route::get('/profile', [CustomerController::class, 'profile'])->name('customer.profile');
        Route::patch('/profile', [CustomerController::class, 'update_profile'])->name('customer.update_profile');
        Route::get('/profile/remove-image', [CustomerController::class, 'remove_profile_image'])->name('customer.remove_profile_image');
        Route::get('/my-courses/learning', [CustomerController::class, 'courses'])->name('customer.courses');
        Route::get('/course/{id}/learn/lectures', [CustomerController::class, 'courseVideos'])->name('course.videos');
        Route::get('/course/{course_id}/lectures/video/{video_id}', [CustomerController::class, 'videos'])->name('videos');


        Route::group(['middleware' => 'check_cart'], function () {
            Route::get('/checkout', [SiteController::class, 'checkout'])->name('site.checkout');
            Route::post('/checkout/payment', [PaymentController::class, 'checkout_now'])->name('checkout.payment');
            Route::get('/checkout/{order_id}/cancelled', [PaymentController::class, 'cancelled'])->name('checkout.cancel');
            Route::get('/checkout/{order_id}/completed', [PaymentController::class, 'completed'])->name('checkout.complete');
            Route::get('/checkout/webhook/{order?}/{env?}', [PaymentController::class, 'webhook'])->name('checkout.webhook.ipn');
        });
    });

    Route::get('/', [SiteController::class, 'index'])->name('site.index')->middleware('throttle:visit', 'visit');
//        ->middleware('throttle:visit', 'visit');

    Route::get('/blog', [SiteController::class, 'blog'])->name('site.blog');
    Route::get('/blog/post/{slug}', [SiteController::class, 'postDetails'])->name('site.blog.post');
    Route::get('/about', [SiteController::class, 'about'])->name('site.about');
    Route::get('/services', [SiteController::class, 'services'])->name('site.services');
    Route::get('/service/{slug}', [SiteController::class, 'serviceDetails'])->name('site.service-details');
    Route::get('/courses', [SiteController::class, 'courses'])->name('site.courses');
    Route::get('/courses/{slug}', [SiteController::class, 'courseDetails'])->name('site.course-details');
    Route::get('/contact', [SiteController::class, 'contact'])->name('site.contact');
    Route::post('/contact/store', [SiteController::class, 'contact_store'])->name('site.contact_store');
    Route::get('/cart', [SiteController::class, 'cart'])->name('site.cart');

    Route::get('/privacy-and-policy', [SiteController::class, 'privacyAndPolicy'])->name('site.privacyAndPolicy');
    Route::get('/term_of_use', [SiteController::class, 'termOfUse'])->name('site.termOfUse');



    Route::get('/login-users', [LoginController::class, 'getLogin'])->name('site.login');
    Route::post('/login-users', [LoginController::class, 'login'])->name('site.login.user');
    Route::get('/register-users', [LoginController::class, 'getRegister'])->name('site.register');
    Route::post('/register-users', [LoginController::class, 'register'])->name('site.register.user');


});


