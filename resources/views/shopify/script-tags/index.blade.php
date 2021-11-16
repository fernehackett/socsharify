@if(isset($user->share_this_api))
    let script = document.createElement("SCRIPT");
    script.type = "text/javascript";
    script.async = "async";
    script.src = "https://platform-api.sharethis.com/js/sharethis.js#property={{ $user->share_this_api }}&product=sop";
    document.head.prepend(script);
@endif
