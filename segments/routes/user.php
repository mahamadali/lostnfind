<?php

use Bones\Router;
use Controllers\User\DashboardController;
use Controllers\User\ItemController;

Router::bunch('/user', ['as' => 'user.'], function() {
    Router::get('/dashboard', [ DashboardController::class, 'index' ])->name('dashboard');
	Router::bunch('/items', ['as' => 'items.'], function() {
		Router::get('/', [ ItemController::class, 'index' ])->name('index');
		Router::get('/create', [ ItemController::class, 'create' ])->name('create');
		Router::post('/store', [ ItemController::class, 'store' ])->name('store');
		Router::get('/edit/{item}', [ ItemController::class, 'edit' ])->name('edit');
		Router::post('/update/{item}', [ ItemController::class, 'update' ])->name('update');
		Router::post('/delete/{item}', [ ItemController::class, 'delete' ])->name('delete');
	});
});