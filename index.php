<?php

use LinkAcademy\Gadgets\Commons\Support\Facades\Route;

# Application load
require 'app.php';

Route::get('home', 'LinkAcademy\Gadgets\Commons\Http\HomeController@index');
Route::get('products', 'LinkAcademy\Gadgets\Commons\Http\ProductsController@index');
Route::get('product/{id}', 'LinkAcademy\Gadgets\Commons\Http\ProductsController@getProduct');
