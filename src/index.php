<?php

use LinkAcademy\Gadgets\Commons\Support\Facades\Route;

require 'app.php';

Route::get('home', 'HomeController@index');
Route::get('products', 'ProductsController@index');
Route::get('products/{id}', 'ProductsController@getProduct');
Route::get('cart', 'CartController@index');
