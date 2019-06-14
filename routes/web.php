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

Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::redirect('/home', '/dashboard', 301);

Auth::routes();

Route::group(['prefix' => 'dashboard'], function(){

    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('complete-your-profile', 'HomeController@getCompleteProfile')->name('get.completeyourprofile');
    Route::post('complete-your-profile', 'HomeController@postCompleteProfile')->name('post.completeyourprofile');

    Route::get('view-accounts-to-pay', 'HomeController@getViewPayToData')->name('get.paytodata');
    Route::get('view-accounts-to-pay/{uuid}/confirm', 'HomeController@getViewPayToDataForm')->name('get.paytodataform');
    Route::post('view-accounts-to-pay/{uuid}/confirm', 'HomeController@postViewPayToDataForm')->name('post.paytodataform');

    Route::get('view-received-payments', 'HomeController@getViewReceivedPayments')->name('get.recvpayments');
    Route::post('view-received-payments/action', 'HomeController@postViewReceivedPayments')->name('post.recvpayments');

    Route::get('add-member', 'HomeController@getAddMember')->name('get.addmember');
    Route::post('add-member', 'HomeController@postAddMember')->name('post.addmember');

    Route::get('notifications', 'HomeController@getNotifications')->name('get.notifications');

    Route::get('reset-password', 'HomeController@getResetPassword')->name('get.resetpassword');
    Route::post('reset-password', 'HomeController@postResetPassword')->name('post.resetpassword');

    Route::get('edit-profile', 'HomeController@getEditProfile')->name('get.editprofile');
    Route::post('edit-profile', 'HomeController@postEditProfile')->name('post.editprofile');

    Route::get('member/{user}', 'HomeController@getUserDetails')->name('get.userdetails');

    Route::get('coming-soon', 'HomeController@getComingSoon')->name('get.comingsoon');
});

Route::get('/test', function()
{
    $user = Auth::user();
    $password = str_random(8);
    Mail::to($user)->send(new \App\Mail\MemberWelcomeMail($user, $password));
    dd(1);
    // where someone set payment as paid then receiver
    $notify = Auth::user()->notify(new \App\Notifications\PaymentSent($payment));
    $notify = Auth::user()->notify(new \App\Notifications\PaymentDeclined($payment));
    $notify = Auth::user()->notify(new \App\Notifications\PaymentVerified($payment));
    dd($notify);
});
