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

Route::get('/', function () {
    return redirect('dashboard');
})->name('login');

Auth::routes();

Route::get('dashboard', 'HomeController@index')->name('dashboard');
Route::post('client/register', 'ClientController@register')->name('client.register');


Route::group(['middleware' => ['role_or_permission:receptionist']], function (){
    Route::post('/cashier/change_password', 'CashierController@change_password')->name('cashier.change_password');
    Route::get('/reports/monthly_report', 'ReportController@monthly_report')->name('reports.monthly_report');
    Route::post('/reports/monthly_download', 'ReportController@monthly_download')->name('reports.monthly_download');
    Route::resource('reports', 'ReportController');
    Route::resource('hobby', 'HobbyController');

});
Route::group(['middleware' => ['role_or_permission:financial_manager']], function (){
    Route::get('/payment/summary', 'PaymentController@summary')->name('payment.summary');
    Route::resource('payment', 'PaymentController');
});

Route::group(['middleware' => ['auth']], function() {
    Route::post('/client/assign_hobbies/{id}', 'ClientController@assign_hobbies')->name('client.assign_hobbies');
    Route::get('/event/hobby_match', 'EventController@hobby_match')->name('event.hobby_match');
    Route::get('/event/accept/{id}', 'EventController@accept')->name('event.accept');
    Route::get('/event/download/{id}', 'EventController@download')->name('event.download');
    Route::resource('client', 'ClientController');
    Route::resource('event', 'EventController');

});





