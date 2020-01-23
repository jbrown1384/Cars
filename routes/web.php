<?php

Route::get('/', 'ContactsController@index')->name('index');
Route::post('/contact', 'ContactsController@store')->name('store');
