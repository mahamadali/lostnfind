<?php

use Bones\Router;
use Controllers\Backend\DashboardController;
use Controllers\Backend\UserController;
use Controllers\Backend\CompanyController;
use Controllers\Backend\CategoryController;
use Controllers\Backend\SmsSettingController;
use Controllers\Backend\SocialmediaController;
use Controllers\AuthController;

Router::bunch('/admin', ['as' => 'admin.', 'barrier' => ['is-auth']], function() {
	Router::get('/dashboard', [ DashboardController::class, 'index' ])->name('dashboard');
	Router::bunch('/users', ['as' => 'users.'], function() {
		Router::get('/list', [ UserController::class, 'index' ])->name('list');
		Router::get('/create', [ UserController::class, 'create' ])->name('create');
		Router::post('/store', [ UserController::class, 'store' ])->name('store');
		Router::get('/edit/{user}', [ UserController::class, 'edit' ])->name('edit');
		Router::post('/update', [ UserController::class, 'update' ])->name('update');
		Router::post('/delete/{user}', [ UserController::class, 'delete' ])->name('delete');
	});

	Router::bunch('/category', ['as' => 'category.'], function() {
		Router::get('/list', [ CategoryController::class, 'index' ])->name('list');
		Router::get('/create', [ CategoryController::class, 'create' ])->name('create');
		Router::post('/store', [ CategoryController::class, 'store' ])->name('store');
		Router::get('/edit/{category}', [ CategoryController::class, 'edit' ])->name('edit');
		Router::post('/update', [ CategoryController::class, 'update' ])->name('update');
		Router::post('/delete/{category}', [ CategoryController::class, 'delete' ])->name('delete');
	});

	Router::bunch('/company', ['as' => 'company.'], function() {
		Router::get('/index', [ CompanyController::class, 'index' ])->name('index');
		Router::post('/store', [ CompanyController::class, 'store' ])->name('store');
	});

	Router::bunch('/smssetting', ['as' => 'smssetting.'], function() {
		Router::get('/index', [ SmsSettingController::class, 'index' ])->name('index');
		Router::post('/store', [ SmsSettingController::class, 'store' ])->name('store');
	});

	Router::bunch('/socialmedia', ['as' => 'socialmedia.'], function() {
		Router::get('/list', [ SocialmediaController::class, 'index' ])->name('list');
		Router::get('/create', [ SocialmediaController::class, 'create' ])->name('create');
		Router::post('/store', [ SocialmediaController::class, 'store' ])->name('store');
		Router::get('/edit/{category}', [ SocialmediaController::class, 'edit' ])->name('edit');
		Router::post('/update', [ SocialmediaController::class, 'update' ])->name('update');
		Router::post('/delete/{category}', [ SocialmediaController::class, 'delete' ])->name('delete');
	});
});

Router::get('/logout', [ AuthController::class, 'logout' ])->name('auth.logout');