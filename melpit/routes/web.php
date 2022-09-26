<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', 'ItemsController@showItems')->name('top');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('items/{item}', 'ItemsController@showItemDetail')->name('item');

Route::middleware('auth')
    ->group(function(){
        Route::get('items/{item}/buy','ItemsController@showBuyItemForm')->name('item.buy');
        Route::get('sell','SellController@showSellForm')->name('sell');
        Route::post('sell','SellController@sellItem')->name('sell');
    });

Route::prefix('mypage')
    // コントローラの名前空間の接頭辞
    ->namespace('Mypage')
    ->middleware('auth')
    ->group(function(){
        Route::get('edit-profile','ProfileController@showProfileEditForm')->name('mypage.edit-profile');
        Route::post('edit-profile','ProfileController@editProfile')->name('mypage.edit-profile');
        Route::get('sold-items','SoldItemsController@showSoldItems')->name('mypage.sold-items');
    });
