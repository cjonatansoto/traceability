<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('dispatchguides/{id}', 'App\Http\Controllers\Api\DispatchGuideController@getById');
