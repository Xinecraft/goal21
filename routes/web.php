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

    /*Route::get('view-accounts-to-pay', 'HomeController@getViewPayToData')->name('get.paytodata');
    Route::get('view-accounts-to-pay/{uuid}/confirm', 'HomeController@getViewPayToDataForm')->name('get.paytodataform');
    Route::post('view-accounts-to-pay/{uuid}/confirm', 'HomeController@postViewPayToDataForm')->name('post.paytodataform');*/

    /*Route::get('view-received-payments', 'HomeController@getViewReceivedPayments')->name('get.recvpayments');
    Route::post('view-received-payments/action', 'HomeController@postViewReceivedPayments')->name('post.recvpayments');*/

    Route::get('transactions', 'HomeController@getTransactions')->name('get.transactions');
    Route::get('transactions/withdrawlist', 'HomeController@getViewWithdrawRequests')->name('get.withdrawrequests');
    Route::get('transactions/withdraw/request', 'HomeController@getViewWithdrawRequestForm')->name('get.withdrawrequest');
    Route::post('transactions/withdraw/request', 'HomeController@postViewWithdrawRequestForm')->name('post.withdrawrequest');

    Route::get('add-member', 'HomeController@getAddMember')->name('get.addmember');
    Route::post('add-member', 'HomeController@postAddMember')->name('post.addmember');

    Route::get('notifications', 'HomeController@getNotifications')->name('get.notifications');

    Route::get('reset-password', 'HomeController@getResetPassword')->name('get.resetpassword');
    Route::post('reset-password', 'HomeController@postResetPassword')->name('post.resetpassword');

    Route::get('edit-profile', 'HomeController@getEditProfile')->name('get.editprofile');
    Route::post('edit-profile', 'HomeController@postEditProfile')->name('post.editprofile');

    Route::get('go-tasks', 'HomeController@getGoListTasks')->name('get.golisttasks');
    Route::get('list-tasks', 'HomeController@getListTasks')->name('get.listtasks');
    Route::get('tasks', 'HomeController@getListTasks')->name('get.listtasks');
    Route::get('task/{uuid}', 'HomeController@getViewTask')->name('get.viewtask');
    Route::post('task/{uuid}', 'HomeController@postViewTask')->name('post.viewtask');

    Route::get('member/{user}', 'HomeController@getUserDetails')->name('get.userdetails');

    Route::get('apply-for-upgrade', 'HomeController@getPremiumApplyForm')->name('get.applyforpremium');
    Route::post('apply-for-upgrade', 'HomeController@postPremiumApplyForm')->name('post.applyforpremium');


    Route::get('coming-soon', 'HomeController@getComingSoon')->name('get.comingsoon');
});

// TODO ADD AUTH ADMIN
Route::group(['prefix' => 'dashboard/admin'], function(){
    Route::get('kyc', 'AdminController@getKYCs')->name('admin.get.kyclist');
    Route::get('kyc/{username}', 'AdminController@getKYCDetail')->name('admin.get.kycdetail');
    Route::post('kyc/{username}', 'AdminController@postActionOnKYC')->name('admin.post.kycdetail');

    Route::get('tasks/', 'AdminController@getListTasks')->name('admin.get.listtask');
    Route::get('gettasks/', 'AdminController@anyListTasks')->name('admin.any.listtask');
    Route::get('task/{uuid}/edit', 'AdminController@getEditTask')->name('admin.get.edittask');
    Route::post('task/{uuid}/edit', 'AdminController@postEditTask')->name('admin.post.edittask');
    Route::get('tasks/create', 'AdminController@getCreateTask')->name('admin.get.createtask');
    Route::post('tasks/create', 'AdminController@postCreateTask')->name('admin.post.createtask');

    Route::get('users/', 'AdminController@getListUsers')->name('admin.get.listusers');
    Route::any('getusers/', 'AdminController@anyListUsers')->name('admin.any.listusers');
    Route::get('user/{username}', 'AdminController@getListUsers')->name('admin.get.viewuser');
    Route::get('user/{username}/edit', 'AdminController@getListUsers')->name('admin.get.edituser');

    Route::get('payment-approval/', 'AdminController@getListPaymentApprovals')->name('admin.get.listpaymentapprovals');
    Route::post('payment-approval/{username}/approve', 'AdminController@postApprovePayment')->name('admin.post.approvepayment');
    Route::delete('payment-approval/{username}/reject', 'AdminController@deleteRejectPayment')->name('admin.delete.rejectpayment');

    Route::get('site-settings', 'AdminController@getSiteSettings')->name('admin.get.sitesettings');
    Route::post('site-settings', 'AdminController@postSiteSettings')->name('admin.post.sitesettings');
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

Route::get('/fakedeposit/{amount}', function($amount) {
   Auth::user()->depositFloat($amount, ['desc' => 'Completed Task X', 'txn_id' => str_random(16)]);
   dd(Auth::user()->balanceFloat);
});
Route::get('/fakewithdraw/{amount}', function($amount) {
    Auth::user()->withdrawFloat($amount, ['desc' => 'Withdraw to Bank Account', 'txn_id' => str_random(16)]);
    dd(Auth::user()->balanceFloat);
});
