var icons = {
    github : `<i class="fab fa-github"></i>`,
    twitter : `<i class="fab fa-twitter"></i>`,
    facebook : `<i class="fab fa-facebook"></i>`,
    instagram : `<i class="fab fa-instagram"></i>`,
    google : `<i class="fab fa-google-plus"></i>`,
    tumblr : `<i class="fab fa-tumblr"></i>`,
    snapchat : `<i class="fab fa-snapchat"></i>`,
    pinterest : `<i class="fab fa-pinterest"></i>`,
    reddit : `<i class="fab fa-reddit"></i>`,
    telegram : `<i class="fab fa-telegram"></i>`,
    linkedin : `<i class="fab fa-linkedin"></i>`
}

var link = document.createElement('link');
link.rel = 'stylesheet';
link.type = 'text/css';
link.href = `https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css`
document.getElementsByTagName('HEAD')[0].appendChild(link)

link = document.createElement('link');
link.rel = 'stylesheet';
link.type = 'text/css';
link.href = `{{ asset("templates/Rob Vermeer/style.css") }}`
document.getElementsByTagName('HEAD')[0].appendChild(link)

link.onload = function(){
var socsharify = document.createElement("DIV")
socsharify.id = `socsharify`
@php
    $icons = isset($template->options) ? $template->options["social networks"] : ["github","facebook","twitter","instagram","linkedin"];
    $position = isset($template->options) ? $template->options["position"] : "bottom";
@endphp

@switch ($position)
    @case("top")
        socsharify.style.top = `0`
        socsharify.style.bottom = `auto`
    @break
    @case("bottom")
        socsharify.style.bottom = `0`
        socsharify.style.top = `auto`
    @break
@endswitch
var html = `<div class="share">
    <span>Share</span>
    <nav>
        @foreach($icons as $key => $icon)
            <a href="#" class="button share-button {{ $icon }}-share-button st-custom-button" data-network="{{ $icon }}">${ icons['{{ $icon }}'] ?? "" }</a>
        @endforeach
    </nav>
</div>`

socsharify.innerHTML = html
document.body.appendChild(socsharify)
}