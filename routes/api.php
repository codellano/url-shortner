<?php
Route::post('/links', 'LinksController@store');
Route::get('/{slug}', 'LinksController@show');
