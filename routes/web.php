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

Auth::routes();
Route::get('forgot-password', ['as'	=>	'forgot-password','uses' =>	'Auth\LoginController@forgotPassword']);

Route::group(['middleware' => 'auth'], function () {
	Route::get('dashboard', 'HomeController@index');
	//phiếu thu
	Route::get('get-list-cash-receipt-voucher', 'CashReceiptVoucherController@getList')->name('get-list-cash-receipt-voucher');
	Route::get('get-group-object', 'CashReceiptVoucherController@getGroupObject');
	Route::put('calendar/{id}', 'CashReceiptVoucherController@calendar');
	Route::resource('cash-receipt-voucher', 'CashReceiptVoucherController');
	//hết
	//phiếu chi
	Route::resource('cash-payment-voucher', 'CashPaymentVoucherController');
	//hết
	//quản lý tài chính
	Route::resource('finance_account', 'FinanceAccountController');
	Route::get('get-list-finance-account', 'FinanceAccountController@getList')->name('get-list-finance-account');
	Route::get('find-finance-account/{id}', 'FinanceAccountController@find')->name('find-finance-account');
	Route::get('create-finance-account', 'FinanceAccountController@create')->name('create-finance-account');
	//hết
});