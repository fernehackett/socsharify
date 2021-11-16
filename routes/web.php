<?php

//Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
//Auth::routes();

/*
|------------------------------------------------------------------------------------
| Admin
|------------------------------------------------------------------------------------
*/
//Route::group(['prefix' => ADMIN, 'as' => ADMIN . '.', 'middleware'=>['auth', 'Role:10']], function () {
//    Route::get('/', 'DashboardController@index')->name('dash');
//    Route::resource('users', 'UserController');
//});
Route::group(['middleware'=>["verify.shopify", "billable"]], function () {
    Route::get('/', "Shopify\DashboardController@index")->name("home");
    Route::group(["as"=>"shopify.","namespace"=>"Shopify"], function(){
        Route::post("teamplate", 'TemplateController@teamplate')->name("teamplate");
        Route::resource("templates", "TemplateController");
    });
});
//Route::group(['middleware'=>["auth.webhook"]], function () {
//    Route::any('/api/webhook', "API/StoreController@webHook");
//});


//Route::get('install', 'HomeController@install')->name("install");
Route::get('policy', 'HomeController@policy')->name("policy");
Route::get('script-tags.js', 'HomeController@getScriptTags')->name("public.script-tags");
//Route::match(["post","get"],'install/submit', 'HomeController@submit')->name("submit");
//Route::get('install/success', 'HomeController@success')->name("success");
