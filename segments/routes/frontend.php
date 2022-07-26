<?php

use Bones\Router;
use Controllers\Frontend\HomeController;
use Controllers\Frontend\PurchasePlanController;

Router::get('/', [ HomeController::class, 'index' ])->name('frontend.home');
Router::bunch('/cms', ['as' => 'cms.'], function() {
	Router::get('/{page}', [ AuthController::class, 'page' ])->name('page');
});

Router::bunch('/purchase-plan', ['as' => 'purchase-plan.'], function() {
    Router::bunch('/{plan}', [], function() {
        Router::get('/', [PurchasePlanController::class, 'index' ])->name('index');
        Router::post('/process', [PurchasePlanController::class, 'process' ])->name('process');
    });
});