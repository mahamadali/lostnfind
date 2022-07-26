<?php

use Bones\Router;
use Controllers\Frontend\HomeController;

Router::get('/', [ HomeController::class, 'index' ])->name('home');
Router::bunch('/cms', ['as' => 'cms.'], function() {
	Router::get('/{page}', [ AuthController::class, 'page' ])->name('page');
});