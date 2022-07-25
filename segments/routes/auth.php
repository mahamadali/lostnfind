<?php

use Bones\Router;
use Controllers\AuthController;


Router::bunch('/auth', ['as' => 'auth.', 'barrier' => ['is-not-auth']], function() {
	Router::get('/login', [ AuthController::class, 'index' ])->name('login');
	Router::post('/check-login', [ AuthController::class, 'checkLogin' ])->name('check.login');
});