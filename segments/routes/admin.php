<?php

use Bones\Router;
use Controllers\Backend\DashboardController;
use Controllers\Backend\UserController;
use Controllers\Backend\CompanyController;
use Controllers\Backend\CategoryController;
use Controllers\Backend\TagsController;
use Controllers\Backend\SubscriptionController;
use Controllers\Backend\SmsSettingController;
use Controllers\Backend\SocialmediaController;
use Controllers\Backend\AdvertiseController;
use Controllers\Backend\FaqController;
use Controllers\Backend\PagesController;
use Controllers\Backend\MessageSettingController;
use Controllers\Backend\RenewalMailSettingController;
use Controllers\AuthController;
use Barriers\Admin\IsAuthenticated;
use Controllers\Backend\NewsletterController;

Router::bunch('/admin', ['as' => 'admin.', 'barrier' => [IsAuthenticated::class]], function() {
	Router::get('/dashboard', [ DashboardController::class, 'index' ])->name('dashboard');
	Router::bunch('/users', ['as' => 'users.'], function() {
		Router::get('/list', [ UserController::class, 'index' ])->name('list');
		Router::get('/create', [ UserController::class, 'create' ])->name('create');
		Router::post('/store', [ UserController::class, 'store' ])->name('store');
		Router::get('/edit/{user}', [ UserController::class, 'edit' ])->name('edit');
		Router::post('/update', [ UserController::class, 'update' ])->name('update');
		Router::post('/delete/{user}', [ UserController::class, 'delete' ])->name('delete');
		Router::get('/view/{user}', [ UserController::class, 'view' ])->name('view');
	});

	Router::bunch('/category', ['as' => 'category.'], function() {
		Router::get('/list', [ CategoryController::class, 'index' ])->name('list');
		Router::get('/create', [ CategoryController::class, 'create' ])->name('create');
		Router::post('/store', [ CategoryController::class, 'store' ])->name('store');
		Router::get('/edit/{category}', [ CategoryController::class, 'edit' ])->name('edit');
		Router::post('/update', [ CategoryController::class, 'update' ])->name('update');
		Router::post('/delete/{category}', [ CategoryController::class, 'delete' ])->name('delete');
	});

	Router::bunch('/tags', ['as' => 'tags.'], function() {
		Router::get('/list', [ TagsController::class, 'index' ])->name('list');
		Router::get('/create', [ TagsController::class, 'create' ])->name('create');
		Router::post('/store', [ TagsController::class, 'store' ])->name('store');
		Router::get('/edit/{tag}', [ TagsController::class, 'edit' ])->name('edit');
		Router::post('/update/{tag}', [ TagsController::class, 'update' ])->name('update');
		Router::post('/delete/{tag}', [ TagsController::class, 'delete' ])->name('delete');
		Router::post('/import', [ TagsController::class, 'import' ])->name('import');
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

	Router::bunch('/smssetting', ['as' => 'smssetting.'], function() {
		Router::get('/index', [ SmsSettingController::class, 'index' ])->name('index');
		Router::post('/store', [ SmsSettingController::class, 'store' ])->name('store');
	});

	Router::bunch('/messagesetting', ['as' => 'messagesetting.'], function() {
		Router::get('/list', [ MessageSettingController::class, 'index' ])->name('list');
		Router::get('/create', [ MessageSettingController::class, 'create' ])->name('create');
		Router::post('/store', [ MessageSettingController::class, 'store' ])->name('store');
		Router::get('/edit/{category}', [ MessageSettingController::class, 'edit' ])->name('edit');
		Router::post('/update', [ MessageSettingController::class, 'update' ])->name('update');
		Router::post('/delete/{category}', [ MessageSettingController::class, 'delete' ])->name('delete');
	});

	Router::bunch('/renewalmailsetting', ['as' => 'renewalmailsetting.'], function() {
		Router::get('/index', [ RenewalMailSettingController::class, 'index' ])->name('index');
		Router::post('/store', [ RenewalMailSettingController::class, 'store' ])->name('store');
	});

	Router::bunch('/socialmedia', ['as' => 'socialmedia.'], function() {
		Router::get('/list', [ SocialmediaController::class, 'index' ])->name('list');
		Router::get('/create', [ SocialmediaController::class, 'create' ])->name('create');
		Router::post('/store', [ SocialmediaController::class, 'store' ])->name('store');
		Router::get('/edit/{category}', [ SocialmediaController::class, 'edit' ])->name('edit');
		Router::post('/update', [ SocialmediaController::class, 'update' ])->name('update');
		Router::post('/delete/{category}', [ SocialmediaController::class, 'delete' ])->name('delete');
	});

	
	Router::bunch('/advertise', ['as' => 'advertise.'], function() {
		Router::get('/list', [ AdvertiseController::class, 'index' ])->name('list');
		Router::get('/create', [ AdvertiseController::class, 'create' ])->name('create');
		Router::post('/store', [ AdvertiseController::class, 'store' ])->name('store');
		Router::get('/edit/{category}', [ AdvertiseController::class, 'edit' ])->name('edit');
		Router::post('/update', [ AdvertiseController::class, 'update' ])->name('update');
		Router::post('/delete/{category}', [ AdvertiseController::class, 'delete' ])->name('delete');
	});

	Router::bunch('/faq', ['as' => 'faq.'], function() {
		Router::get('/list', [ FaqController::class, 'index' ])->name('list');
		Router::get('/create', [ FaqController::class, 'create' ])->name('create');
		Router::post('/store', [ FaqController::class, 'store' ])->name('store');
		Router::get('/edit/{category}', [ FaqController::class, 'edit' ])->name('edit');
		Router::post('/update', [ FaqController::class, 'update' ])->name('update');
		Router::post('/delete/{category}', [ FaqController::class, 'delete' ])->name('delete');
	});

	Router::bunch('/pages', ['as' => 'pages.'], function() {
		Router::get('/list', [ PagesController::class, 'index' ])->name('list');
		Router::get('/create', [ PagesController::class, 'create' ])->name('create');
		Router::post('/store', [ PagesController::class, 'store' ])->name('store');
		Router::get('/edit/{category}', [ PagesController::class, 'edit' ])->name('edit');
		Router::post('/update', [ PagesController::class, 'update' ])->name('update');
		Router::post('/delete/{category}', [ PagesController::class, 'delete' ])->name('delete');
	});

	Router::bunch('/newsletter', ['as' => 'newsletter.'], function() {
		Router::get('/list', [ NewsletterController::class, 'index' ])->name('list');
	});

	

});

Router::get('/logout', [ AuthController::class, 'logout' ])->name('auth.logout');