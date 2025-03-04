<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ServicesController;


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminHomeSliderController;
use App\Http\Controllers\Admin\AdminAboutController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminServicesController;
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

Route::get('/', [HomeController::class, 'Home'])->name('/');




    // Home Slider Routes
    Route::controller(AdminHomeSliderController::class)->group(function () {
        Route::get('admin/home_slider', 'HomeSlider')->name('home_slider');
        Route::get('admin/home_slider/add', 'Add')->name('homeslider-add');
        Route::post('admin/home_slider/store', 'Store')->name('homeslider-store');
        Route::get('admin/home_slider/edit/{home_slider_id}', 'Edit')->name('homeslider-edit');
        Route::post('admin/home_slider/update/{home_slider_id}', 'Update')->name('homeslider-update');
        Route::delete('admin/home_slider/delete/{home_slider_id}', 'Delete')->name('homeslider-delete');
        Route::get('admin/home-slider', 'HomeSliderScript')->name('home_slider_script');
    });

    

    
    
    // Route::controller(AdminAboutController::class)->group(function () {
    //     Route::get('admin/about', 'About')->name('about');
    //     Route::get('admin/about/add', 'Add')->name('about-add');
    //     Route::post('admin/about/store', 'Store')->name('about-store');
    //     Route::get('admin/about/edit/{about_id}', 'Edit')->name('about-edit');
    //     Route::post('admin/about/update/{about_id}', 'Update')->name('about-update');
    //     Route::delete('admin/about/delete/{about_id}', 'Delete')->name('about-delete');
    //     Route::get('admin/about', 'AboutScript')->name('about_script');
    // });

    


    Route::controller(AdminAboutController::class)->group(function () {
        Route::get('admin/about', 'AboutScript')->name('about_script'); // ✅ Ensure it's named 'about_script'
        Route::get('admin/about/add', 'Add')->name('about-add');
        Route::post('admin/about/store', 'Store')->name('about-store');
        Route::get('admin/about/edit/{about_id}', 'Edit')->name('about-edit');
        Route::post('admin/about/update/{about_id}', 'Update')->name('about-update');
        Route::delete('admin/about/delete/{about_id}', 'Delete')->name('about-delete');
    });
    


Route::controller(AdminBlogController::class)->group(function () {
    Route::get('admin/blog', 'BlogScript')->name('blog_script'); // Keep only one definition
    Route::get('admin/blog/add', 'Add')->name('blog-add');
    Route::post('admin/blog/store', 'Store')->name('blog-store');
    Route::get('admin/blog/edit/{blog_id}', 'Edit')->name('blog-edit');
    Route::post('admin/blog/update/{blog_id}', 'Update')->name('blog-update');
    Route::delete('admin/blog/delete/{blog_id}', 'Delete')->name('blog-delete');
});


Route::controller(AdminServicesController::class)->group(function () {
    Route::get('admin/our_services', 'ServicesScript')->name('our_services_script'); // Keep only one definition
    Route::get('admin/our_services/add', 'Add')->name('our_services-add');
    Route::post('admin/our_services/store', 'Store')->name('our_services-store');
    Route::get('admin/our_services/edit/{our_services_id}', 'Edit')->name('our_services-edit');
    Route::post('admin/our_services/update/{our_services_id}', 'Update')->name('our_services-update');
    Route::delete('admin/our_services/delete/{our_services_id}', 'Delete')->name('our_services-delete');
});


Route::controller(AdminTestimonialController::class)->group(function () {
    Route::get('admin/testimonial', 'TestimonialScript')->name('testimonial_script'); // Keep only one definition
    Route::get('admin/testimonial/add', 'Add')->name('testimonial-add');
    Route::post('admin/testimonial/store', 'Store')->name('testimonial-store');
    Route::get('admin/testimonial/edit/{testimonial_id}', 'Edit')->name('testimonial-edit');
    Route::post('admin/testimonial/update/{testimonial_id}', 'Update')->name('testimonial-update');
    Route::delete('admin/testimonial/delete/{testimonial_id}', 'Delete')->name('testimonial-delete');
});



Route::get('/login', [AdminController::class, 'login'])->middleware('aleradayLoggedIn');
Route::get('/registration', [AdminController::class, 'registration'])->middleware('preventBack')->name('registration');
Route::post('/register-user', [AdminController::class, 'registerUser'])->name('register-user');
Route::post('login-user',[AdminController::class, 'loginUser'])->name('login-user'); 
// Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware('isLoggedIn');
Route::post('/logout',[AdminController::class, 'logout'])->name('logout');;
Route::get('login', [AdminController::class, 'login'])->name('login');

Route::delete('/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard')->middleware(['isLoggedIn', 'preventBack']); 


