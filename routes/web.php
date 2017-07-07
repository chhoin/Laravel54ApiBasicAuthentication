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
    return view('welcome');
});

Route::group(['middleware' => ['web']], function () {

    Route::get ( '/status.html',        ['uses' => 'StatusMainController@index'  ]);
    Route::get ( '/main/status.html',   ['uses' => 'StatusMainController@index'  ]);

    //api URL
    Route::get( '/api/status',          ['uses' => 'StatusApiController@index' ,'middleware'=>'apiauth' ]);
    Route::get( '/api/status/{id}',     ['uses' => 'StatusApiController@show','middleware'=>'apiauth' ]);
    Route::post( '/api/status',         ['uses' => 'StatusApiController@store','middleware'=>'apiauth' ]);
    Route::put( '/api/status',          ['uses' => 'StatusApiController@update','middleware'=>'apiauth' ]);
    Route::delete( '/api/status/{id}',  ['uses' => 'StatusApiController@destroy','middleware'=>'apiauth' ]);
    Route::get( '/api/status/page/{pageid}/item/{limit}/{key}', ['uses' => 'StatusApiController@listAll','middleware'=> ['cors'] ]);

});