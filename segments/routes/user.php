<?php

use Bones\Router;
use Controllers\User\DashboardController;

Router::bunch('/user', ['as' => 'user.'], function() {
    Router::get('/dashboard', [ DashboardController::class, 'index' ])->name('dashboard');

});