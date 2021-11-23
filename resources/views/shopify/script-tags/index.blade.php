
@if($user->enable && isset($user->share_this_api))
    var script = document.createElement("SCRIPT");
    script.type = "text/javascript";
    script.async = "async";
    @isset($template)
        script.src = "https://platform-api.sharethis.com/js/sharethis.js#property={{ $user->share_this_api }}&product=custom-share-buttons";
    @else
        script.src = "https://platform-api.sharethis.com/js/sharethis.js#property={{ $user->share_this_api }}&product=sop";
    @endisset
    document.head.prepend(script);
    @isset($template)
        @include("shopify.templates.{$template->parent->name}.index")
    @endisset
@endif
