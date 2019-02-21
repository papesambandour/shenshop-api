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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');
    Route::get('user', 'ApiController@getAuthUser');

    //PRODUCT

    Route::get('produits', 'ProduitController@allproduits');
    Route::get('produits/{id}', 'ProduitController@getProtuit');

    Route::post('commandes', 'CommandeController@savecommande');
    Route::get('commandes/{id}', 'CommandeController@getCommande');
    Route::get('commandes', 'CommandeController@allcommande');


});
