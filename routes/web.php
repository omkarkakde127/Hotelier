<?php

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LuxuryController;


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminHomeSliderController;
use App\Http\Controllers\Admin\AdminAboutController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminServicesController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminRoomController;
use App\Http\Controllers\Admin\AdminLuxuryController;
use App\Http\Controllers\Admin\AdminTeamController;

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

Route::get('/', [HomeController::class, 'Home'])->name('index');
Route::get('/about', [AboutController::class, 'About'])->name('about');
Route::get('/services', [ServicesController::class, 'Services'])->name('services');
Route::get('/booking', [BookingController::class, 'Booking'])->name('booking');
Route::get('/room', [RoomController::class, 'Room'])->name('room');
Route::get('/contact', [HomeController::class, 'Contact'])->name('contact');
Route::get('/testimonial', [TestimonialController::class, 'Testimonial'])->name('testimonial');
Route::get('/team', [TeamController::class, 'Team'])->name('team');
Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');




    // Home Slider Routes
    Route::controller(AdminHomeSliderController::class)->group(function () {
        Route::get('admin/home_slider', 'HomeSlider')->name('home_slider');
        Route::get('admin/home_slider/add', 'Add')->name('homeslider-add');
        Route::post('admin/home_slider/store', 'Store')->name('homeslider-store');
        Route::get('admin/home_slider/edit/{home_slider_id}', 'Edit')->name('homeslider-edit');
        Route::post('admin/home_slider/update/{home_slider_id}', 'Update')->name('homeslider-update');
        Route::delete('admin/home_slider/delete/{home_slider_id}', 'Delete')->name('homeslider-delete');
        Route::get('admin/home-slider', 'homeSliderScript')->name('home_slider_script');
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
        Route::get('admin/about', 'About')->name('about'); // ✅ Main 'about' page
        Route::get('admin/about/script', 'AboutScript')->name('about_script'); // ✅ Added missing script route
        Route::get('admin/about/add', 'Add')->name('about-add');
        Route::post('admin/about/store', 'Store')->name('about-store');
        Route::get('admin/about/edit/{about_id}', 'Edit')->name('about-edit');
        Route::post('admin/about/update/{about_id}', 'Update')->name('about-update');
        Route::delete('admin/about/delete/{about_id}', 'Delete')->name('about-delete');
    });
    



Route::controller(AdminRoomController::class)->group(function () {
    Route::get('admin/room', 'Room')->name('room');
    Route::get('admin/room/script', 'RoomScript')->name('room_script'); // Keep only one definition
    Route::get('admin/room/add', 'Add')->name('room-add');
    Route::post('admin/room/store', 'Store')->name('room-store');
    Route::get('admin/room/edit/{room_id}', 'Edit')->name('room-edit');
    Route::post('admin/room/update/{room_id}', 'Update')->name('room-update');
    Route::delete('admin/room/delete/{room_id}', 'Delete')->name('room-delete');
});


Route::controller(AdminLuxuryController::class)->group(function () {
    Route::get('admin/luxury', 'Luxury')->name('luxury');
    Route::get('admin/luxury/script', 'LuxuryScript')->name('luxury_script'); // Keep only one definition
    Route::get('admin/luxury/add', 'Add')->name('luxury-add');
    Route::post('admin/luxury/store', 'Store')->name('luxury-store');
    Route::get('admin/luxury/edit/{luxury_id}', 'Edit')->name('luxury-edit');
    Route::post('admin/luxury/update/{luxury_id}', 'Update')->name('luxury-update');
    Route::delete('admin/luxury/delete/{luxury_id}', 'Delete')->name('luxury-delete');
});

Route::controller(AdminTeamController::class)->group(function () {
    Route::get('admin/team', 'Team')->name('team');
    Route::get('admin/team/script', 'TeamScript')->name('team_script'); // Keep only one definition
    Route::get('admin/team/add', 'Add')->name('team-add');
    Route::post('admin/team/store', 'Store')->name('team-store');
    Route::get('admin/team/edit/{team_id}', 'Edit')->name('team-edit');
    Route::post('admin/team/update/{team_id}', 'Update')->name('team-update');
    Route::delete('admin/team/delete/{team_id}', 'Delete')->name('team-delete');
});


Route::controller(AdminServicesController::class)->group(function () {
    Route::get('admin/our_services', 'Services')->name('services');
    Route::get('admin/our_services/script', 'ServicesScript')->name('our_services_script'); // Keep only one definition
    Route::get('admin/our_services/add', 'Add')->name('our_services-add');
    Route::post('admin/our_services/store', 'Store')->name('our_services-store');
    Route::get('admin/our_services/edit/{our_services_id}', 'Edit')->name('our_services-edit');
    Route::post('admin/our_services/update/{our_services_id}', 'Update')->name('our_services-update');
    Route::delete('admin/our_services/delete/{our_services_id}', 'Delete')->name('our_services-delete');
});


Route::controller(AdminTestimonialController::class)->group(function () {
    Route::get('admin/testimonial', 'Testimonial')->name('testimonial');
    Route::get('admin/testimonial/script', 'TestimonialScript')->name('testimonial_script'); // Keep only one definition
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


Route::get('/book-room', [BookingController::class, 'create'])->name('book.room');
Route::post('/book-room', [BookingController::class, 'store'])->name('booking.store');


Route::get('/booking', function (Request $request) {
    return view('booking', [
        'source' => $request->input('source'),
        'destination' => $request->input('destination'),
        'date' => $request->input('date'),
        'seats' => $request->input('seats'),
    ]);
})->name('booking');




Route::get('/receipt', [ReceiptController::class, 'showReceipt'])->name('receipt.show');
Route::get('/download-receipt', [ReceiptController::class, 'downloadPDF'])->name('receipt.download');


Route::post('/confirm-booking', function (Request $request) {
    // Here, you can store booking details in the database.
    return "Booking Confirmed! Passenger Name: " . $request->input('name');
})->name('confirmBooking');



Route::get('/receipt/{bookingId}', [BookingController::class, 'showReceipt'])->name('showReceipt');


Route::get('/receipt/{bookingId}', [BookingController::class, 'viewReceipt'])->name('viewReceipt');
Route::get('/download-receipt/{bookingId}', [BookingController::class, 'downloadPDF'])->name('download.receipt');


Route::get('/receipt/${bookingId}', [BookingController::class, 'showReceipt'])->name('receipt');
Route::get('/download-receipt/{id}', [BookingController::class, 'downloadReceipt'])->name('downloadReceipt');

Route::get('receipt', [ReceiptController::class, 'showReceipt'])->name('receipt');
Route::get('/download-receipt/{id}', [ReceiptController::class, 'downloadPDF'])->name('download.receipt');

// Admin Bus Management Routes
Route::controller(AdminBookingController::class)->group(function () {
    Route::get('admin/hotel', 'Hotel')->name('hotel');
    Route::get('admin/hotel/add', 'Add')->name('hotel-add');
    Route::post('admin/hotel/store', 'Store')->name('hotel-store');
    Route::get('admin/hotel/edit/{hotel_id}', 'Edit')->name('hotel-edit');
    Route::post('admin/hotel/update/{hotel_id}', 'Update')->name('hotel-update');
    Route::delete('admin/hotel/delete/{hotel_id}', 'Delete')->name('hotel-delete');
    Route::get('admin/hotel-script', 'HotelScript')->name('hotel_script');

});


Route::controller(AdminBookingController::class)->group(function () {
    Route::get('admin/booking', 'Booking')->name('booking');
  
    Route::delete('admin/booking/delete/{booking_id}', 'Delete')->name('booking-delete');
    Route::get('admin/booking', 'BookingScript')->name('booking_script');
});

Route::post('/booking-store', [AdminBookingController::class, 'Store'])->name('booking-store');

Route::post('/payment-success', [AdminBookingController::class, 'paymentSuccess'])->name('payment-success');

Route::post('/payment-fail', [AdminBookingController::class, 'paymentFail'])->name('payment-fail');





Route::get('/admin/booking/send-mail/{booking_id}', [AdminBookingController::class, 'sendMail'])->name('booking-send-mail');

Route::post('/create-razorpay-order', [BookingController::class, 'createOrder'])->name('create-razorpay-order');

