<?php

use Bones\Router;
use Controllers\Frontend\HomeController;
use Controllers\Frontend\PurchasePlanController;
use Controllers\Frontend\PaypalController;

Router::get('/', [ HomeController::class, 'index' ])->name('frontend.home');
Router::get('/search', [ HomeController::class, 'search' ])->name('frontend.search');
Router::get('/advertisements', [ HomeController::class, 'advertisements' ])->name('frontend.advertisements');
Router::get('/pricing', [ HomeController::class, 'pricing' ])->name('frontend.pricing');

Router::bunch('/provider-contact-info', ['as' => 'provider-contact-info.'], function() {
	Router::get('/{item}', [ HomeController::class, 'provideFounderForm' ])->name('form');
    Router::post('/process/{item}', [ HomeController::class, 'provideFounderInfoProcess' ])->name('process');
});
Router::bunch('/cms', ['as' => 'cms.'], function() {
	Router::get('/{page}', [ HomeController::class, 'page' ])->name('page');
});

Router::bunch('/newsletter', ['as' => 'newsletter.'], function() {
	Router::post('/store', [ HomeController::class, 'newsletterStore' ])->name('store');
    Router::get('/verify/{email}', [ HomeController::class, 'verifyNewsletterEmail' ])->name('verify');
});

Router::bunch('/purchase-plan', ['as' => 'purchase-plan.'], function() {
    Router::bunch('/{plan}', [], function() {
        Router::get('/', [PurchasePlanController::class, 'index' ])->name('index');
        Router::post('/process', [PurchasePlanController::class, 'process' ])->name('process');

        Router::bunch('/paypal', ['as' => 'paypal.'], function() {
            Router::get('/{request_id}', [PurchasePlanController::class, 'paypalFormPage' ])->name('index');
        });

    });
});

Router::bunch('/paypal', ['as' => 'paypal.'], function() {
    Router::post('/success', [PaypalController::class, 'success' ])->name('success');
    Router::get('/cancel', [PaypalController::class, 'cancel' ])->name('cancel');
    Router::post('/notify', [PaypalController::class, 'notify' ])->name('notify');
    Router::get('/update-subscriptions', [PaypalController::class, 'update' ])->name('update');
    Router::get('/reactivate/{usersubscription}', [PaypalController::class, 'reactivate' ])->name('reactivate');

    Router::get('/check-renew-plan-cron', [PaypalController::class, 'checkRenewPlanCron' ])->name('check-renew-plan-cron');
    Router::get('/plan-renew/{plan_request}', [PaypalController::class, 'planRenew' ])->name('plan-renew');
});

