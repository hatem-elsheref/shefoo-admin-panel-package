<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->get('/','Backend\AdminPanelController@index')->name('shefoo.home');
