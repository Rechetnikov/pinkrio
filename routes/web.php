<?php

Route::resource('/', 'IndexController', [
    'only' => ['index'],
    'names' => ['index' => 'home']
]);

Route::get('status/{alias?}', [
    'only' => ['index', 'show'],
    'as' => 'status',
    'uses' => 'StatusController@index',
])->where('alias', '[\w-]+');


Route::get('filial/{alias?}', [
    'only' => ['index', 'show'],
    'as' => 'filial',
    'uses' => 'FilialController@index',
])->where('alias', '[\w-]+');

Route::get('sales', ['uses'=>'ProductController@index', 'as'=>'sales', 'names' => ['index' => 'sales']]); 
Route::post('sales', 'ProductController@store'); 
Route::get('sales/{id?}', ['uses'=>'ProductController@edit', 'as'=>'salesEdit'])->where('id', '[\w-]+');
Route::resource('/sales', 'ProductController'); 

Route::post("filial/update/sales", 'FilialController@sales');
Route::post("filial/update/delete", 'FilialController@delete');
Route::post("filial/update/redirect", 'FilialController@redirect');
Route::post("filial/update/sales_one", 'StatusController@sales_one');

Route::post("status/update/retry", 'StatusController@retry');
Route::post("status/update/retry_one", 'StatusController@retry_one');

