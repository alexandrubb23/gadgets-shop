<?php

use LinkAcademy\Gadgets\Commons\Support\Facades\Route;

# Application load
require 'app.php';

Route::get('home', 'HomeController@index');
Route::get('products', 'ProductsController@index');
Route::get('product/{id}', 'ProductsController@getProduct');
Route::get('cart', 'CartController@index');
