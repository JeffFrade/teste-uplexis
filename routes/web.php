<?php

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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::group(['prefix' => 'crawler'], function () {
        Route::get('/', 'CrawlerController@index')->name('crawler.index');
        Route::post('/', 'CrawlerController@crawler')->name('crawler');
    });

    Route::group(['prefix' => 'article'], function () {
        Route::get('/', 'ArticleController@index')->name('article.index');
        Route::delete('/{id}', 'ArticleController@delete')->name('article.delete');
    });
});
