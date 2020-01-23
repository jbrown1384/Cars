<?php

// landing page 
Route::get('/', 'ContactsController@index')->name('index');

// contact form submit endpoint
Route::post('/contact', 'ContactsController@store')->name('store');
