<?php
// Роуты для главной страници отчета 
Route::resource('/', 'IndexController', [
    'only' => ['index'],
    'names' => ['index' => 'home']
]);

// Роуты для страниц стаутсов
Route::get('status/{alias?}', [
    'only' => ['index', 'show'],
    'as' => 'status',
    'uses' => 'StatusController@index',
])->where('alias', '[\w-]+');

// Роуты для страниц филиалов
Route::get('filial/{alias?}', [
    'only' => ['index', 'show'],
    'as' => 'filial',
    'uses' => 'FilialController@index',
])->where('alias', '[\w-]+');

// Роуты для покупки и правки товаров
Route::get('sales', ['uses'=>'ProductController@index', 'as'=>'sales', 'names' => ['index' => 'sales']]); 
Route::post('sales', 'ProductController@store'); 
Route::get('sales/{id?}', ['uses'=>'ProductController@edit', 'as'=>'salesEdit'])->where('id', '[\w-]+');
Route::resource('/sales', 'ProductController'); 

// Роуты продаж перемещения между филиалами и удаления
Route::post("filial/update/sales", 'FilialController@sales');
Route::post("filial/update/delete", 'FilialController@delete');
Route::post("filial/update/redirect", 'FilialController@redirect');
Route::post("filial/update/sales_one", 'StatusController@sales_one');

// Роуты для возврата проданного товара
Route::post("status/update/retry", 'StatusController@retry');
Route::post("status/update/retry_one", 'StatusController@retry_one');

