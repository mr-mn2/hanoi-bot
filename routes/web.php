<?php

use App\Core\Routing\Route;

Route::add('message','/start', "homeController@index");
Route::add('message','/hanoi','homeController@honoi');
Route::add('message',[2,3,4,5],'homeController@honoi');
