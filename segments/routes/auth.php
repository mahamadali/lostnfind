<?php

use Bones\Router;
use Controllers\AuthController;

Router::get('auth/setup-portal/{plan_request}', [ AuthController::class, 'signup' ])->name('signup');
Router::bunch('/auth', ['as' => 'auth.', 'barrier' => ['is-not-auth']], function() {
	Router::get('/login', [ AuthController::class, 'index' ])->name('login');
	Router::post('/check-login', [ AuthController::class, 'checkLogin' ])->name('check.login');
	// Router::get('/setup-portal/{plan_request}', [ AuthController::class, 'signup' ])->name('signup');
	Router::post('/setup-portal-process/{plan_request}', [ AuthController::class, 'registerPost' ])->name('signup-post');
	Router::get('/forgot-password', [ AuthController::class, 'forgotPassword' ])->name('forgot-password');
	Router::post('/forgot-password-submit', [ AuthController::class, 'forgotPasswordPost' ])->name('forgot-password.submit');
	Router::get('/reset-password/{token}', [ AuthController::class, 'resetPassword' ])->name('reset-password.validate');
	Router::post('/reset-password-post/{user}', [ AuthController::class, 'resetPasswordPost' ])->name('reset-password.submit');
});