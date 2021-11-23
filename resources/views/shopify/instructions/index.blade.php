@extends('shopify.default')

@section('page-header')
    Hello, {{ auth()->user()->name }}
@stop
@section('content')
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <div class="row mt-1">
            <div class="col-md-12">
                <dl>
                    <dt>Step 1</dt>
                    <dd>
                        After install <b>Socsharify</b>, you will redirect to the app UI page.
                    </dd>
                    <dt>Step 2</dt>
                    <dd>
                        You must create a <a href="https://platform.sharethis.com/signup" target="_blank">ShareThis</a> account to have a key<br>
                        Then you must fill the ShareThis key and click to enable to active the app.<br>
                        Now you can use the ShareThis template in your website.<br>
                    </dd>
                    <dt>Step 3</dt>
                        You can go to the <b>Templates</b> and create the personal template for your website.<br>
                        1. The name of your personal template<br>
                        2. The default template you can use<br>
                        3. The social networks are available<br>
                        4. The available position you want to show<br>
                        <img src="{{ asset("images/Screenshot_18.jpg") }}" width="100%">
                    <dd>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
@stop
