<?php

Route::group(['middleware'=>["verify.shopify", "billable"]], function () {
    Route::get('/', "Shopify\DashboardController@index")->name("home");
    Route::group(["as"=>"shopify.","namespace"=>"Shopify"], function(){
        Route::post("template", 'TemplateController@template')->name("template");
        Route::get("instructions", 'DashboardController@instructions')->name("instructions");
        Route::resource("store-templates", "TemplateController");
    });
});
Route::get('policy', 'HomeController@policy')->name("policy");
Route::get('script-tags.js', 'HomeController@getScriptTags')->name("public.script-tags");