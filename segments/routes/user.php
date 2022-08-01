<?php

use Bones\Router;
use Controllers\User\DashboardController;
use Controllers\User\ItemController;
use Controllers\User\AdditionalContactController;
use Controllers\User\MyPlanController;
use Controllers\User\TransactionController;
use Controllers\Backend\UserController;

Router::bunch('/user', ['as' => 'user.', 'barrier' => ['is-auth']], function() {
    Router::get('/dashboard', [ DashboardController::class, 'index' ])->name('dashboard');

	Router::bunch('/profile', ['as' => 'profile.'], function() {
		Router::get('/edit/{id}', [UserController::class, 'edit' ])->name('edit');
		Router::post('/update/{id}', [UserController::class, 'update' ])->name('update');
	});

	Router::bunch('/items', ['as' => 'items.'], function() {
		Router::get('/', [ItemController::class, 'index' ])->name('index');
		Router::get('/create', [ItemController::class, 'create' ])->name('create');
		Router::post('/store', [ItemController::class, 'store' ])->name('store');
		Router::get('/edit/{item}', [ItemController::class, 'edit' ])->name('edit');
		Router::post('/update/{item}', [ItemController::class, 'update' ])->name('update');
		Router::post('/delete/{item}', [ItemController::class, 'delete' ])->name('delete');
		Router::get('/view/{item}', [ ItemController::class, 'view' ])->name('view');
		Router::post('/check-tag', [ItemController::class, 'checkTag' ])->name('checkTag');
	});

	Router::bunch('/additional-contacts', ['as' => 'additional-contacts.'], function() {
		Router::get('/', [AdditionalContactController::class, 'index' ])->name('index');
		Router::get('/create', [AdditionalContactController::class, 'create' ])->name('create');
		Router::post('/store', [AdditionalContactController::class, 'store' ])->name('store');
		Router::get('/edit/{contact}', [AdditionalContactController::class, 'edit' ])->name('edit');
		Router::post('/update/{contact}', [AdditionalContactController::class, 'update' ])->name('update');
		Router::post('/delete/{contact}', [AdditionalContactController::class, 'delete' ])->name('delete');
	});

	Router::bunch('/my-plans', ['as' => 'my-plans.'], function() {
		Router::get('/', [MyPlanController::class, 'index' ])->name('index');
	});

	Router::bunch('/transactions', ['as' => 'transactions.'], function() {
		Router::get('/', [TransactionController::class, 'index' ])->name('index');
	});
});