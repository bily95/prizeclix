<?php

use Illuminate\Support\Facades\Route;


Route::name('moder.')->middleware(['auth','permission:admin'])->group(function () {

        Route::namespace('Livewire\Admin')->group(function () {

            //general site setting
            Route::name('settings.')->namespace('Setting')->group(function () {
                Route::get('settings/general', 'General')->name('general');
                Route::get('settings/security', 'Security')->name('security');
                Route::get('settings/control', 'Control')->name('control');
                Route::get('settings/authentication', 'Authentication')->name('authentication');
            });

            //Email Setting and templates
            Route::name('email.')->namespace('Email')->group(function () {
                Route::get('email/templates', 'Index')->name('templates');
                Route::get('email/settings', 'Config')->name('setting');
                Route::get('email/{templateId}/edit', 'EditTemplate')->name('edit-template');
            });


            //Support Tickets
            Route::name('ticket.')->namespace('Support')->group(function () {
                Route::get('tickets/all', 'Index')->name('index');
            });
        });

        Route::namespace('Controllers\Admin')->group(function () {

            Route::resource('/ads', 'AdsZoneController');

            Route::name('manage-site.')->prefix('manage-site')->group(function(){
                Route::get('/cronjobs', 'ManageSiteController@cron')->name('cron');
            });

            Route::name('ticket.')->prefix('tickets')->group(function () {
                //support Tickets
                Route::get('/pending', 'SupportTicketController@pendingTicket')->name('pending');
                Route::get('/view/{id}', 'SupportTicketController@ticketReply')->name('view');
                Route::post('/reply/{id}', 'SupportTicketController@ticketReplySend')->name('reply');
                Route::get('/download/{ticket}', 'SupportTicketController@ticketDownload')->name('download');
                Route::post('/delete', 'SupportTicketController@ticketDelete')->name('delete');
            });


            // Language Manager
            Route::name('language.')->prefix('language')->group(function () {

                Route::get('/', 'LanguageController@langManage')->name('manage');
                Route::post('/', 'LanguageController@langStore')->name('manage.store');
                Route::post('/delete/{id}', 'LanguageController@langDel')->name('manage.del');
                Route::post('/update/{id}', 'LanguageController@langUpdate')->name('manage.update');
                Route::get('/edit/{id}', 'LanguageController@langEdit')->name('key');
                Route::post('/import', 'LanguageController@langImport')->name('importLang');

                Route::post('/store/key/{id}', 'LanguageController@storeLanguageJson')->name('store.key');
                Route::post('/delete/key/{id}', 'LanguageController@deleteLanguageJson')->name('delete.key');
                Route::post('/update/key/{id}', 'LanguageController@updateLanguageJson')->name('update.key');
            });


            // WITHDRAW SYSTEM
            Route::name('withdraw.')->prefix('shop')->group(function () {
                Route::get('pending', 'WithdrawalController@pending')->name('pending');
                Route::get('log', 'WithdrawalController@log')->name('log');
                Route::get('via/{method_id}/{type?}', 'WithdrawalController@logViaMethod')->name('method');
                Route::get('details/{id}', 'WithdrawalController@details')->name('details');
                Route::post('approve', 'WithdrawalController@approve')->name('approve');
                Route::post('reject', 'WithdrawalController@reject')->name('reject');


                // Withdraw Method
                Route::get('method/', 'WithdrawMethodController@methods')->name('method.index');
                Route::get('method/create', 'WithdrawMethodController@create')->name('method.create');
                Route::post('method/create', 'WithdrawMethodController@store')->name('method.store');
                Route::get('method/edit/{id}', 'WithdrawMethodController@edit')->name('method.edit');
                Route::post('method/edit/{id}', 'WithdrawMethodController@update')->name('method.update');
                Route::post('method/activate', 'WithdrawMethodController@activate')->name('method.activate');
                Route::post('method/deactivate', 'WithdrawMethodController@deactivate')->name('method.deactivate');
            });

            // Users countries map
            Route::get('api/users/counrites/count', 'ManageUsersController@usersMap')->name('map');
            
            //user control and details
            Route::name('users.')->prefix('users')->group(function () {
                Route::get('/list', 'ManageUsersController@allUsers')->name('all');
                Route::get('active', 'ManageUsersController@activeUsers')->name('active');
                Route::get('banned', 'ManageUsersController@bannedUsers')->name('banned');
                Route::get('email-verified', 'ManageUsersController@emailVerifiedUsers')->name('email.verified');
                Route::get('email-unverified', 'ManageUsersController@emailUnverifiedUsers')->name('email.unverified');
                Route::get('with-balance', 'ManageUsersController@usersWithBalance')->name('with.balance');

                Route::get('{scope}/search', 'ManageUsersController@search')->name('search');
                Route::get('detail/{id}', 'ManageUsersController@detail')->name('detail');
                Route::post('update/{id}', 'ManageUsersController@update')->name('update');
                Route::post('add-sub-balance/{id}', 'ManageUsersController@addSubBalance')->name('add.sub.balance');
                Route::get('send-email/{id}', 'ManageUsersController@showEmailSingleForm')->name('email.single');
                Route::post('send-email/{id}', 'ManageUsersController@sendEmailSingle')->name('do-email.single');
                Route::get('login/{id}', 'ManageUsersController@login')->name('login');
                Route::get('transactions/{id}', 'ManageUsersController@transactions')->name('transactions');
                Route::get('withdrawals/{id}', 'ManageUsersController@withdrawals')->name('withdrawals');
                Route::get('withdrawals/via/{method}/{type?}/{userId}', 'ManageUsersController@withdrawalsViaMethod')->name('withdrawals.method');

                Route::get('login/history/{id}', 'ManageUsersController@userLoginHistory')->name('login.history.single');

                Route::get('send-email', 'ManageUsersController@showEmailAllForm')->name('email.all');
                Route::post('send-email', 'ManageUsersController@sendEmailAll')->name('email.send');
                Route::get('email-log/{id}', 'ManageUsersController@emailLog')->name('email.log');
                Route::get('email-details/{id}', 'ManageUsersController@emailDetails')->name('email.details');
                Route::get('referrals/{id}', 'ManageUsersController@referrals')->name('referrals');
                Route::get('commissions/win/{id}', 'ManageUsersController@referralCommissionsWin')->name('commissions.win');
            });

            Route::prefix('referrals')->group(function () {
                //refer
                Route::get('/levels', 'ReferralController@index')->name('referral.index');
                Route::post('/referral', 'ReferralController@store')->name('store.refer');
                Route::get('/referral-status/{type}', 'ReferralController@referralStatusUpdate')->name('referral.status');
                Route::get('/referral-page', 'ReferralController@referralPage')->name('referral.customize');
                Route::post('/referral-page/save', 'ReferralController@updateReferralPage')->name('referral.do-customize');
            });

            //offerwall routes
            Route::name('offer.')->prefix('custom/offerwalls')->group(function () {
                Route::get('list', 'OfferSetupController@index')->name('index');
                Route::get('/create', 'OfferSetupController@create')->name('create');
                Route::post('/store', 'OfferSetupController@store')->name('store');
                Route::get('/edit/{offer_id}', 'OfferSetupController@edit')->name('edit');
                Route::post('/update/{offer_id}', 'OfferSetupController@update')->name('update');
                Route::get('/update-status/{offer_id}', 'OfferSetupController@updateStatus')->name('update-status');
                Route::get('/update-pay/{offer_id}', 'OfferSetupController@updatePay')->name('update-pay');
                Route::delete('/delete/{offer_id}', 'OfferSetupController@delete')->name('delete');
                Route::get('analysis', 'OfferSetupController@analysis')->name('analysis');
            });

            Route::name('offer.builtin.')->prefix('builtin/offerwalls')->group(function () {
                Route::get('list', 'OffersBuiltinController@index')->name('index');
                Route::get('edit/{offer_id}', 'OffersBuiltinController@edit')->name('edit');
                //Route::post('store', 'OffersBuiltinController@store')->name('store');
                Route::post('update/{id}', 'OffersBuiltinController@update')->name('update');
            });
            
        });

        //Notification
        Route::get('notifications', 'Controllers\SiteController@notifications')->name('notifications');
        Route::get('notification/read/{id}', 'Controllers\SiteController@notificationRead')->name('notification.read');
        Route::get('notification/delete/{id}', 'Controllers\SiteController@deleteNotify')->name('notification.delete');
        Route::get('notifications/read-all', 'Controllers\SiteController@notificationReadAll')->name('notifications.readAll');

});
