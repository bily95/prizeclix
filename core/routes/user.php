<?php

use Illuminate\Support\Facades\Route;

Route::name('user.')->group(function () {

    //login
    Route::prefix('login')->group(function () {
        Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('/complete', 'Auth\LoginController@login')->name('login.complete');
    });

    // logout
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    // Google authentication
    Route::prefix('google')->group(function () {
        Route::get('/', 'Auth\LoginController@googleLogin')->name('google-login');
        Route::get('/callback', 'Auth\LoginController@googleLoginCallback')->name('google-login-callback');
    });

    // register
    Route::prefix('register')->group(function () {
        Route::get('/', 'Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('/complete', 'Auth\RegisterController@register')->name('register.complete')->middleware('regStatus');
        Route::post('/check-mail', 'Auth\RegisterController@checkUser')->name('checkUser');
    });

    //password authentication
    Route::name('password.')->prefix('auth/password')->group(function () {
        Route::get('/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('request');
        Route::post('/email', 'Auth\ForgotPasswordController@sendResetCodeEmail')->name('email');
        Route::get('/code-verify', 'Auth\ForgotPasswordController@codeVerify')->name('code.verify');
        Route::post('/do-reset', 'Auth\ResetPasswordController@reset')->name('update');
        Route::get('/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('reset');
        Route::post('/verify-code', 'Auth\ForgotPasswordController@verifyCode')->name('verify.code');
    });

    // require authentications
    Route::middleware(['auth'])->group(function () {

        // vlidation Email authentication
        Route::get('authorization', 'AuthorizationController@authorizeForm')->name('authorization');
        Route::get('resend-verify', 'AuthorizationController@sendVerifyCode')->name('send.verify.code');
        Route::post('verify-email', 'AuthorizationController@emailVerification')->name('verify.email');
        Route::post('verify-g2fa', 'AuthorizationController@g2faVerification')->name('go2fa.verify');

        // require active and not banned users or invalid browsing
        Route::middleware(['checkStatus'])->group(function () {

            // user Profile
            Route::get('profile/{tab?}', 'UserProfileController@index')->name('profile');
            Route::post('settings', 'UserProfileController@submitProfile')->name('profile.setting.update');
            Route::post('account', 'UserProfileController@submitAccount')->name('profile.account.update');
            Route::post('password', 'UserProfileController@submitPassword')->name('change.password.submit');
            Route::post('delete-account', 'UserProfileController@deleteAccount')->name('account.delete');

            //2FA
            Route::post('2fa/enable', 'UserProfileController@create2fa')->name('twofactor.enable');
            Route::post('2fa/disable', 'UserProfileController@disable2fa')->name('twofactor.disable');


            // Withdraw
            Route::get('shop', 'WithdrawalController@withdrawMoney')->name('withdraw');
            Route::post('shop', 'WithdrawalController@withdrawStore')->name('withdraw.money');
            Route::get('shop/preview', 'WithdrawalController@withdrawPreview')->name('withdraw.preview');
            Route::post('shop/do-preview', 'WithdrawalController@withdrawSubmit')->name('withdraw.submit');
            Route::get('/shop/history', 'WithdrawalController@withdrawLog')->name('withdraw.history');

            // Transaction
            Route::get('money/transactions', 'UserController@transactions')->name('transactions');


            // Referred Users
            Route::get('referrals', 'ReferralController@index')->name('referral');


            // User Support Ticket
            Route::get('tickets', 'TicketController@supportTicket')->name('ticket');
            Route::get('open-ticket', 'TicketController@openSupportTicket')->name('ticket.open');
            Route::post('create-ticket', 'TicketController@storeSupportTicket')->name('ticket.store');
            Route::get('tickets/view/{ticket}', 'TicketController@viewTicket')->name('ticket.view');
            Route::post('tickets/reply/{ticket}', 'TicketController@replyTicket')->name('ticket.reply');
            Route::get('tickets/download/{ticket}', 'TicketController@ticketDownload')->name('ticket.download');

            // offerwall 
            Route::name('offer.')->group(
                function () {
                    Route::get('/reawrds', 'ReportsController@userOfferReports')->name('reports');
                 }
            );
        });
    });
});


Route::get('/change/{lang?}', 'SiteController@changeLanguage')->name('lang');
