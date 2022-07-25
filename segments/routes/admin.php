<?php

use Bones\Router;
use Controllers\Backend\DashboardController;
use Controllers\Backend\UserController;
use Controllers\Backend\CompanyController;
use Controllers\Backend\CategoryController;
use Controllers\Backend\SubscriptionController;
use Controllers\AuthController;
use Barriers\Admin\IsAuthenticated;

Router::bunch('/admin', ['as' => 'admin.', 'barrier' => [IsAuthenticated::class]], function() {
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

	Router::bunch('/subscriptions', ['as' => 'subscriptions.'], function() {
		Router::get('/list', [ SubscriptionController::class, 'index' ])->name('list');
		Router::get('/create', [ SubscriptionController::class, 'create' ])->name('create');
		Router::post('/store', [ SubscriptionController::class, 'store' ])->name('store');
		Router::get('/edit/{subscription}', [ SubscriptionController::class, 'edit' ])->name('edit');
		Router::post('/update', [ SubscriptionController::class, 'update' ])->name('update');
		Router::post('/delete/{subscription}', [ SubscriptionController::class, 'delete' ])->name('delete');
	});

	Router::bunch('/company', ['as' => 'company.'], function() {
		Router::get('/index', [ CompanyController::class, 'index' ])->name('index');
		Router::post('/store', [ CompanyController::class, 'store' ])->name('store');
	});
});

Router::get('/logout', [ AuthController::class, 'logout' ])->name('auth.logout');