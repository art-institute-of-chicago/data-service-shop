<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return redirect('/api/v1');
});

Route::group(['prefix' => 'v1'], function() {
    Route::get('products', 'ProductController@index');
    Route::get('products/{id}', 'ProductController@show');

    Route::get('categories', 'CategoryController@index');
    Route::get('categories/{id}', 'CategoryController@show');

    Route::get('colors', 'ColorController@index');
    Route::get('colors/{id}', 'ColorController@show');

    Route::get('facets', 'FacetController@index');
    Route::get('facets/{id}', 'FacetController@show');

    Route::get('keywords', 'KeywordController@index');
    Route::get('keywords/{id}', 'KeywordController@show');

    Route::get('origins', 'OriginController@index');
    Route::get('origins/{id}', 'OriginController@show');

    Route::get('stones', 'StoneController@index');
    Route::get('stones/{id}', 'StoneController@show');

    Route::get('styles', 'StyleController@index');
    Route::get('styles/{id}', 'StyleController@show');

    Route::get('artists', 'ArtistController@index');
    Route::get('artists/{id}', 'ArtistController@show');
});
