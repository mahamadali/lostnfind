<?php

use Bones\Router;
use Controllers\AuthController;


Router::bunch('/auth', ['as' => 'auth.', 'barrier' => ['is-not-auth']], function() {
	Router::get('/login', [ AuthController::class, 'index' ])->name('login');
	Router::post('/check-login', [ AuthController::class, 'checkLogin' ])->name('check.login');
	Router::get('/setup-portal/{plan_request}', [ AuthController::class, 'signup' ])->name('signup');
	Router::post('/setup-portal-process/{plan_request}', [ AuthController::class, 'registerPost' ])->name('signup-post');
});