<?php

Route::get('/link/{code}', 'LinkController@show')->name('links.show');
Route::get('/', 'LinkController@create')->name('links.create');
Route::post('/', 'LinkController@store')->name('links.store');
