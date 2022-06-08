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

Route::group(['namespace'=>'api'], function () {
    Route::post('login', 'usercont@login');
    Route::post('register', 'usercont@store');
    Route::post('resetpassword', 'usercont@resetpassword');

    Route::get('setting', 'homecont@setting');

});

Route::group(['middleware'=>'auth:api','namespace'=>'api'], function () {
    Route::get('authuser', 'usercont@authuser');
    Route::post('auth/update', 'usercont@update');
    Route::post('customer_add', 'usercont@customer');


    Route::get('customers', 'homecont@customers');
    Route::get('orders', 'homecont@orders');
    Route::get('index', 'homecont@index');
    Route::get('customer/{id}', 'homecont@customer');
    Route::get('listProduct', 'homecont@listProduct');
    Route::get('listUser', 'homecont@listUser');
    Route::post('add_order', 'homecont@add_order');
    Route::get('payments', 'homecont@payments');
    Route::get('order_products', 'homecont@order_products');
    Route::get('order_solds', 'homecont@order_solds');
    Route::get('products', 'homecont@products');
    Route::get('pdf', 'homecont@pdf');
    Route::get('note', 'homecont@note');
    Route::get('add_payment', 'homecont@add_payment');
    Route::get('add_sold', 'homecont@add_sold');
    Route::get('destroy_prodcut', 'homecont@destroy_prodcut');
    Route::get('add_remaining', 'homecont@add_remaining');
    Route::post('add_product', 'homecont@add_product');







});
