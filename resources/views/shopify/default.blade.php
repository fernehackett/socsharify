<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ \Osiset\ShopifyApp\Util::getShopifyConfig('app_name') }}</title>
	<link href="{{ mix('/css/app.css') }}" rel="stylesheet">
	@yield('css')
    <script>
    </script>
</head>

<body class="app">
    @include('shopify.partials.spinner')
    <div>
        @include('shopify.partials.sidebar')
        <div class="page-container">
            @include('shopify.partials.topbar')
            <main class='main-content bgc-grey-100'>
                <div id='mainContent'>
                    <div class="container-fluid">
                        <h4 class="c-grey-900 mT-10 mB-30">@yield('page-header')</h4>
						@yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
    @if(\Osiset\ShopifyApp\Util::getShopifyConfig('appbridge_enabled'))
        <script src="https://unpkg.com/@shopify/app-bridge{{ \Osiset\ShopifyApp\Util::getShopifyConfig('appbridge_version') ? '@'.config('shopify-app.appbridge_version') : '' }}"></script>
        <script src="https://unpkg.com/@shopify/app-bridge-utils{{ \Osiset\ShopifyApp\Util::getShopifyConfig('appbridge_version') ? '@'.config('shopify-app.appbridge_version') : '' }}"></script>
        <script
                @if(\Osiset\ShopifyApp\Util::getShopifyConfig('turbo_enabled'))
                data-turbolinks-eval="false"
                @endif
        >
            var AppBridge = window['app-bridge'];
            var actions = AppBridge.actions;
            var utils = window['app-bridge-utils'];
            var createApp = AppBridge.default;
            var app = createApp({
                apiKey: "{{ \Osiset\ShopifyApp\Util::getShopifyConfig('api_key', $shopDomain ?? Auth::user()->name ) }}",
                shopOrigin: "{{ $shopDomain ?? Auth::user()->name }}",
                host: "{{ \Request::get('host') }}",
                forceRedirect: true,
            });
        </script>

        @include('shopify-app::partials.token_handler')
        @include('shopify-app::partials.flash_messages')
    @endif

    @yield('js')
    @stack('scripts')

</body>

</html>
