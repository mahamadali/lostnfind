<?php

use Bones\Router;
use Controllers\Frontend\HomeController;
use Controllers\Frontend\PurchasePlanController;
use Controllers\Frontend\PaypalController;

Router::get('/', [ HomeController::class, 'index' ])->name('frontend.home');
Router::bunch('/cms', ['as' => 'cms.'], function() {
	Router::get('/{page}', [ HomeController::class, 'page' ])->name('page');
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
    Router::get('/success', [PaypalController::class, 'success' ])->name('success');
    Router::get('/cancel', [PaypalController::class, 'cancel' ])->name('cancel');
    Router::get('/notify', [PaypalController::class, 'notify' ])->name('notify');
});