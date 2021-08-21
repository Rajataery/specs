<?php

use Illuminate\Support\Facades\Route;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;

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

Route::get('/', 'FrontendController@index');
Route::get('/become-a-guru', 'FrontendController@becomeAGuru')->name('become-a-guru');
Route::get('/allGuru', 'FrontendController@allGuru')->name('allGuru');
Route::get('/guru/{id}', 'FrontendController@guru')->name('guru.single');
Route::get('/terms-conditions', 'FrontendController@termConditions')->name('termConditions');
Route::get('/about-us', 'FrontendController@aboutUs')->name('aboutUs');
 
// Gmail API

Route::get('/gmail-api', 'GmailApiController@createToken');
Route::get('/oauth/gmail/callback', 'GmailApiController@callback');
Route::get('/gmail-api/read-email', 'GmailApiController@readEmail')->name('read-email');


// Route::match(['get', 'post'],'/booking-flow-Corporate', 'FrontendController@bookingFlowCorporate')->name('booking-flow-Corporate');
Route::get('/guru-page', 'FrontendController@guruPage')->name('guru-page');
Route::get('/course_detail/{id}', 'FrontendController@course_detail')->name('course_detail');
Route::get('/course_all', 'FrontendController@course_all')->name('course_all');
Route::get('/quiz_view', 'QuizController@index');
Route::post('/quiz_store', 'QuizController@quiz_store');

Route::post('/becomeAguru', 'GuruController@becomeAguru')->name('becomeAGuru');

Route::get('/inhouse-course/price', 'CourseController@getCoursePrice')->name('course.price');

Route::post('/book-in-house-course', 'CourseController@bookInhouseCourse')->name('bookInhouseCourse');

Route::get('/mailAccept/{id}', 'CourseController@mailAccept')->name('mailAccept');
Route::get('/mailReject/{id}', 'CourseController@mailReject')->name('mailReject');
Route::get('/mailAccept_admin/{id}', 'CourseController@mailAccept_admin')->name('mailAccept_admin');
    Route::get('/mailReject_admin/{id}', 'CourseController@mailReject_admin')->name('mailReject_admin');


Route::post('/accepted/{id}', 'CourseController@accepted')->name('accepted');
Route::post('/rejected/{id}', 'CourseController@rejected')->name('rejected');
Route::post('/sendemail/{id}', 'CourseController@sendemail')->name('sendemail');

//Public Course Booking
// Route::match(['get', 'post'],'/booking-flow-public', 'FindCourse@bookingPublic')->name('bookingPublic');
Route::post('/public-course/search', 'FindCourse@findPublicCourse')->name('findPublicCourse');
Route::get('/selectDate', 'FindCourse@selectDate')->name('selectDate');
Route::get('/selectseats', 'FindCourse@selectseats')->name('selectseats');
Route::post('/public-course/search_next', 'FindCourse@PublicCoursenextmonth');
Route::post('/public-course/checkout', 'CourseController@publicCourseCheckout')->name('bookingPublic.checkout');
 Route::post('/discountCode', 'CourseController@discountCode')->name('discountCode');
//Guru Booking
Route::post('/booking-flow-guru', 'FrontendController@bookingFlowGuru')->name('bookingFlowGuru');
Route::post('/guru-booking/checkout', 'CourseController@bookingGuruCheckout')->name('bookingGuru.checkout');

Route::post('/contact', 'FrontendController@contact')->name('contact');
Route::get('/thanks', 'FrontendController@thanks')->name('thanks');

Route::get('/thank-you', 'CourseController@thankYou')->name('thank-you');

Route::match(['get', 'post'],'/Find', 'FindCourse@Find')->name('find.course');
Auth::routes();

Route::group([
    'middleware' => ['auth:web'],
], function () {

    Route::get('/home',  'HomeController@index')->name('home');
    // Route::get('/dates', 'DateController@index')->name('dates');
    Route::get('/AssignToMe', 'DateController@assginToMe')->name('assignDates');
    // Route::Get('/assignMe/{id}', 'DateController@assginMe');

    Route::Get('/assignMe/{id}/{type}', 'DateController@assginMe');
    
    Route::get('/dates/view/{id}/{type}', 'DateController@view')->name('dates.view');

    Route::get('/upcoming-bookings', 'DateController@index')->name('gurubookings.upcoming');
    Route::get('/past-bookings', 'DateController@pastBookings')->name('gurubookings.past');
    Route::get('/available-bookings', 'DateController@availableBookings')->name('gurubookings.available');
    Route::get('/pending-bookings', 'DateController@pendingBookings')->name('gurubookings.pendingRequested');
    Route::get('/candidateDetails/{id}', 'DateController@candidateDetails')->name('candidateDetails');
    Route::get('/candidateDetailsInhouse/{id}', 'DateController@candidateDetailsInhouse')->name('candidateDetailsInhouse');
    Route::get('/candidateDetailsGuru/{id}', 'DateController@candidateDetailsGuru')->name('candidateDetailsGuru');
    Route::post('/attendance', 'DateController@attendance')->name('date.attendance');
    Route::post('/attendanceInhouse', 'DateController@attendanceInhouse')->name('date.attendanceInhouse');
    // Route::get('/request', 'DateController@pendingBookings')->name('gurubookings.pendingRequested');

    Route::get('/profile', 'GuruController@profile')->name('profile');
    Route::post('/profile/update', 'GuruController@profilePost')->name('profile.update');
});

// Route::get('/inhouseThanks', 'CourseController@inhouseThanks')->name('inhouseThanks');

Route::get('/confirmed', function () {
    return 'password confirmed';
})->middleware(['auth', 'password.confirm']);

Route::get('/verified', function () {
    return 'email verified';
})->middleware('verified');

Route::group(['prefix' => '/customer', 'namespace' => 'Customer', 'as' => 'customer.'], function () {
    Route::redirect('/', '/customer/login');
    Auth::routes(['verify' => true]);

     Route::get('/home', 'CustomerController@index')->name('home');
     Route::get('/dashboard', 'CustomerController@dashboard')->name('dashboard');
     Route::get('/invoice/{id}', 'CustomerController@invoice')->name('invoice');
     Route::get('/customer_details/{id}', 'CustomerController@customer_details')->name('customer_details');
    });
//dates

Route::group(['prefix' => '/admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::redirect('/', '/admin/login');
    Auth::routes(['verify' => true]);
    
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/courses', 'CourseController@index')->name('courses');
    Route::get('/course/create', 'CourseController@create')->name('courses.create');
    Route::post('/course/store', 'CourseController@store')->name('courses.store');
    Route::get('/course/view/{id}', 'CourseController@view')->name('courses.view');
    Route::get('/course/edit/{id}', 'CourseController@edit')->name('courses.edit');
    Route::put('/course/update/{id}', 'CourseController@update')->name('courses.update');
    Route::get('/course/delete/{id}', 'CourseController@delete')->name('courses.delete');
    

    Route::get('/setting/vat', 'SettingController@index')->name('setting.vat');
    Route::post('/setting/vatamount', 'SettingController@storeVatAmount')->name('setting.vatamount');
    
    Route::get('/guruPanel', 'GuruController@index')->name('guru');
    /*Route::get('/profilePostupdate', 'GuruController@profilePostupdate');*/
    Route::get('/guruPanel/create', 'GuruController@create')->name('guru.create');
    Route::post('/guruPanel/store', 'GuruController@store')->name('guru.store');
    Route::get('/guruPanel/edit/{id}', 'GuruController@edit')->name('guru.edit');
    Route::post('/guruPanel/notification_status', 'GuruController@notification_status')->name('guru.notification_status');
    Route::post('/guruPanel/update/{id}', 'GuruController@update')->name('guru.update');
    Route::get('/guruPanel/delete/{id}', 'GuruController@delete')->name('guru.delete');
    Route::get('/guruPanel/view/{id}', 'GuruController@view')->name('guru.view');
    Route::post('/guru_status/{id}', 'GuruController@guru_status');

    Route::get('/venue', 'VenueController@index')->name('venue');
    Route::get('/venue/create', 'VenueController@create')->name('venue.create');
    Route::post('/venue/store', 'VenueController@store')->name('venue.store');
    Route::get('/venue/edit/{id}', 'VenueController@edit')->name('venue.edit');
    Route::post('/venue/update/{id}', 'VenueController@update')->name('venue.update');
    Route::get('/venue/view/{id}', 'VenueController@view')->name('venue.view');
    Route::get('/venue/delete/{id}', 'VenueController@delete')->name('venue.delete');
    Route::post('/venue/allow-site/{id}', 'VenueController@allowToSite'); 
    

    Route::get('/dates', 'DateController@index')->name('dates');

    Route::get('/dates/candidateDetailsPublic/{id}', 'DateController@candidateDetailsPublic')->name('dates.candidateDetailsPublic');

    Route::get('/dates/create', 'DateController@create')->name('dates.create');
    Route::post('/dates/store', 'DateController@store')->name('dates.store');
    Route::get('/dates/edit/{id}', 'DateController@edit')->name('dates.edit');
    Route::post('/dates/update/{id}', 'DateController@update')->name('dates.update');
    Route::get('/dates/view/{id}', 'DateController@view')->name('dates.view');
    Route::get('/dates/delete/{id}', 'DateController@delete')->name('dates.delete');
    Route::get('/past-dates', 'DateController@pastDates')->name('pastDates');
    Route::post('/allow-status/{id}', 'DateController@status');
    Route::post('/course_status/{id}', 'DateController@course_status');
    Route::post('/course_feature/{id}', 'DateController@course_feature');
    Route::post('/attendance', 'DateController@attendance')->name('dates.attendance');
    Route::get('/dates/vatprice/{id}', 'DateController@vatprice')->name('dates.vatprice');
    Route::get('/exportAttendance', 'DateController@exportAttendance')->name('dates.exportAttendance');
    Route::post('/sendMail', 'DateController@sendMail')->name('dates.sendMail');
    Route::get('/download-report/{id}', 'DateController@exportReport')->name('dates.exportReport');
    
    Route::post('/notes', 'DateController@notes')->name('dates.notes');
    Route::post('/searchfilter', 'DateController@searchfilter')->name('dates.searchfilter');
    
    

    Route::get('/requests', 'ApprovalController@index')->name('requests');
    Route::get('/request/view/{id}/{type}', 'ApprovalController@view');
    Route::post('/request/confirm/{id}', 'ApprovalController@confirm')->name('confirm');
    Route::post('/nearUser', 'GuruController@nearSearch')->name('nearUser');
    Route::get('/inhousBooking', 'HomeController@inHouseBooking')->name('inhousBooking');
    Route::get('/inhousBooking/view/{id}', 'HomeController@inHouseBookingView')->name('inHouseBookingView');
    // Route::post('/inhousBooking/setPrice/{id}',  'HomeController@setPrice')->name('guruPrice');
    Route::post('/assignGuru/{id}', 'HomeController@assignGuru')->name('assignGuru');
    Route::get('/approveBooking/{id}', 'HomeController@approveBooking')->name('approveBooking');
    Route::get('/publicBooking', 'HomeController@publicBooking')->name('publicBooking');
    Route::get('/publicBooking/view/{id}', 'HomeController@publicBookingView')->name('publicBookingView');
    Route::get('/guruBooking', 'HomeController@guruBooking')->name('guruBooking');
    Route::get('/guruBooking/view/{id}', 'HomeController@guruBookingView')->name('guruBookingView');
    Route::post('/publicBookingUpdate/{id}', 'HomeController@publicBookingUpdate')->name('publicBookingUpdate');
    Route::get('/customers', 'HomeController@customers')->name('customers');
    Route::get('/customers/{id}', 'HomeController@customer_details')->name('customer_details');
    Route::get('/customer_bookings/{id}', 'HomeController@customer_bookings')->name('customer_bookings');

    Route::get('/certificates', 'CertificateController@index')->name('certificates');
    Route::get('/certificate/create', 'CertificateController@create')->name('certificate.create');
    Route::post('/certificate/store', 'CertificateController@store')->name('certificate.store');
    Route::get('/certificate/view/{id}', 'CertificateController@view')->name('certificate.view');
    Route::get('/certificate/edit/{id}', 'CertificateController@edit')->name('certificate.edit');
    Route::put('/certificate/update/{id}', 'CertificateController@update')->name('certificate.update');
    Route::get('/certificate/delete/{id}', 'CertificateController@delete')->name('certificate.delete');
    

    Route::get('/certificate/issue', 'CertificateController@issueCertificate')->name('certificate.issue');
    Route::get('/get-certificate/{course_id}', 'CertificateController@getCertificate')->name('certificate.get');

    Route::get('/confirmed', function () {
        return 'password confirmed';
    })->middleware(['auth:admin-web', 'password.confirm:admin.password.confirm']);
    
    Route::get('/verified', function () {
        return 'email verified';
    })->middleware('verified:admin.verification.notice,admin-web');

    
    Route::get('/coupon', 'CouponController@index')->name('coupon');
    Route::post('/store', 'CouponController@store')->name('store');
    Route::get('/insert','CouponController@insert')->name('insert');
    Route::get('/view/{id}','CouponController@view')->name('view');
});

// Route::get('stripe', 'StripePaymentController@stripe');
// Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');