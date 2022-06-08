<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'frontcontroller@index')->name('front.index');
Route::get('/terms', 'frontcontroller@terms')->name('front.terms');
Route::get('/privacy', 'frontcontroller@privacy')->name('front.privacy');
Route::get('/about_us', 'frontcontroller@about_us')->name('front.about_us');
Route::post('/postIndex', 'frontcontroller@postIndex')->name('front.login');

Route::put('/auth/update', 'frontcontroller@update_profile')->name('front.auth.update')->middleware('auth');
Route::get('/order/{status}', 'frontcontroller@order')->name('front.order')->middleware('auth');
Route::get('/order/show/{id}', 'frontcontroller@order_show')->name('front.order.show')->middleware('auth');

Route::get('/admin/login', 'admin\authcont@login')->name('adminlogin');
Route::post('/admin/login/post', 'admin\authcont@postIndex')->name('adlogin');
Route::get('/logout','admin\authcont@getLogout')->name('admin.logout');

// Deals
Route::prefix('/deals')->group(function() {
    Route::get('/','admin\DealController@index')->name('deal.index');
    Route::get('/create','admin\DealController@create')->name('deal.create');
    Route::patch('/{deal}','admin\DealController@update')->name('deal.update');
    Route::get('/{deal}/edit','admin\DealController@edit')->name('deal.edit');
    Route::post('/','admin\DealController@store')->name('deal.store');
    Route::delete('/{deal}','admin\DealController@destroy')->name('deal.destroy');
    Route::get('/{deal}','admin\DealController@show')->name('deal.show');
    Route::get('/pdf/print','admin\DealController@pdf')->name('deal.pdf');
});

Route::get('/asd', function() {
    return view('admin.receipt.pdf.index');
});

// Receipts
Route::prefix('/receipts')->group(function() {
    Route::get('/home','admin\ReceiptController@home')->name('receipt.home');
    Route::get('/','admin\ReceiptController@index')->name('receipt.index');
    Route::get('/create','admin\ReceiptController@create')->name('receipt.create');
    Route::patch('/{receipt}','admin\ReceiptController@update')->name('receipt.update');
    Route::get('/{receipt}/edit','admin\ReceiptController@edit')->name('receipt.edit');
    Route::post('/','admin\ReceiptController@store')->name('receipt.store');
    Route::delete('/{receipt}','admin\ReceiptController@destroy')->name('receipt.destroy');
    Route::get('/{receipt}','admin\ReceiptController@show')->name('receipt.show');
    Route::get('/pdf/print','admin\ReceiptController@pdf')->name('receipt.pdf');
});
// Tracks
Route::prefix('/tracks')->group(function() {
    Route::get('/home','admin\TrackController@home')->name('track.home');
    Route::get('/','admin\TrackController@index')->name('track.index');
    Route::get('/create','admin\TrackController@create')->name('track.create');
    Route::patch('/{track}','admin\TrackController@update')->name('track.update');
    Route::get('/{track}/edit','admin\TrackController@edit')->name('track.edit');
    Route::post('/','admin\TrackController@store')->name('track.store');
    Route::delete('/{track}','admin\TrackController@destroy')->name('track.destroy');
    Route::get('/{track}','admin\TrackController@show')->name('track.show');
    Route::post('/pdf/print','admin\TrackController@pdf')->name('track.pdf');
});

Route::group(['middleware'=>'admin','prefix'=>'admin','namespace'=>'admin'], function() {
    Route::get('/', 'authcont@index')->name('admin.home');
    Route::get('/auth/profile', 'authcont@edit')->name('admin.auth.profile');
    Route::put('/auth/profile/update', 'authcont@update')->name('admin.auth.update');

    Route::resource('roles','RoleController');

    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/create', 'UserController@create')->name('users.create');
    Route::post('/users/store', 'UserController@store')->name('users.store');
    Route::get('/users/{id}/edit/', 'UserController@edit')->name('users.edit');
    Route::put('/users/update/{id}', 'UserController@update')->name('users.update');
    Route::delete('/users/destroy/{id}', 'UserController@destroy')->name('users.destroy');

    Route::resource('customer','CustomerController');
    Route::resource('product','ProductController');
    Route::get('product/{product}/about','ProductController@about')->name('product.about');
    Route::resource('order','OrderController');

    Route::get('publication/home','PublicationController@home')->name('publication.home');
    Route::get('/publication/pdf/print-all', 'PublicationController@pdfAllExpense')->name('publication.pdfAllExpense');
    Route::resource('publication','PublicationController');
    Route::post('/publication/pdf/print', 'PublicationController@pdf')->name('publication.pdf');
    Route::resource('expense','ExpenseController');
    Route::resource('employee','EmployeeController');
    Route::get('/expense_home', 'ExpenseController@home')->name('expense.home');
    Route::get('/expense/pdf/print', 'ExpenseController@pdf')->name('expense.pdf');
    Route::get('/expense/pdf/print-all', 'ExpenseController@pdfAllExpense')->name('expense.pdfAllExpense');
    Route::get('/customer/pdf/print', 'CustomerController@pdf')->name('customer.pdf');

    Route::get('/order/status/{id}/{status}', 'OrderController@status')->name('order.status');
    Route::post('/order/editprice/{id}', 'OrderController@editprice')->name('order.editprice');
    Route::post('/order/add_sold/{id}', 'OrderController@add_sold')->name('order.add_sold');
    Route::post('/order/add_recieve/{id}', 'OrderController@add_recieve')->name('order.add_recieve');
    Route::post('/order/add_payment/{id}', 'OrderController@add_payment')->name('order.add_payment');
    Route::patch('/order/payment/{id}', 'OrderController@update_payment')->name('order.update_payment');
    Route::delete('/order/payment/{id}', 'OrderController@delete_payment')->name('order.delete_payment');
    Route::post('/order/add_remaining/{id}', 'OrderController@add_remaining')->name('order.add_remaining');
    Route::post('/order/update_amount/{id}', 'OrderController@update_amount')->name('order.update_amount');
    Route::post('/order/add_product/{id}', 'OrderController@add_product')->name('order.add_product');
	Route::get('/order/pdf/print', 'OrderController@pdf')->name('order.pdf');
	Route::get('/order/note/{id}', 'OrderController@note')->name('order.note');

    // Alerts
    Route::group(['prefix' => 'alert'], function() {
        Route::get('/', 'AlertController@index')->name('alert.index');
    });


    Route::get('/setting/edit', 'settingcont@edit')->name('setting.edit');
    Route::put('/setting/update', 'settingcont@update')->name('setting.update');

    Route::get('/setting/terms', 'settingcont@terms')->name('setting.terms');
    Route::get('/setting/privacy', 'settingcont@privacy')->name('setting.privacy');
    Route::get('/setting/about_us', 'settingcont@about_us')->name('setting.about_us');

    Route::put('/setting/terms/update', 'settingcont@terms_update')->name('setting.terms.update');

    Route::get('/booking/{status}', 'bookingcont@index')->name('booking.index');
    Route::get('/booking/show/{id}', 'bookingcont@show')->name('booking.show');
    Route::get('/booking/download/{id}', 'bookingcont@download')->name('booking.download');
    Route::get('/booking/is_paid/{id}', 'bookingcont@is_paid')->name('booking.is_paid');
    Route::get('/booking/status/{id}/{status}', 'bookingcont@status')->name('booking.status');

    Route::get('/service', 'ServiceController@index')->name('service.index');
    Route::get('/service/create', 'ServiceController@create')->name('service.create');
    Route::post('/service/store', 'ServiceController@store')->name('service.store');
    Route::get('/service/edit/{id}', 'ServiceController@edit')->name('service.edit');
    Route::put('/service/update/{id}', 'ServiceController@update')->name('service.update');
    //Route::get('/service/destroy/{id}', 'ServiceController@destroy')->name('service.destroy');



});
