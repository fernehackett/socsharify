var icons = {
github : `<i class="fab fa-github fa-3x icon-3d"></i>`,
twitter : `<i class="fab fa-twitter fa-3x icon-3d"></i>`,
facebook : `<i class="fab fa-facebook fa-3x icon-3d"></i>`,
tumblr : `<i class="fab fa-tumblr fa-3x icon-3d"></i>`,
snapchat : `<i class="fab fa-snapchat fa-3x icon-3d"></i>`,
pinterest : `<i class="fab fa-pinterest fa-3x icon-3d"></i>`,
reddit : `<i class="fab fa-reddit fa-3x icon-3d"></i>`,
telegram : `<i class="fab fa-telegram fa-3x icon-3d"></i>`,
linkedin : `<i class="fab fa-linkedin fa-3x icon-3d"></i>`
}

var link = document.createElement('link');
link.rel = 'stylesheet';
link.type = 'text/css';
link.href = `https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css`
document.getElementsByTagName('HEAD')[0].appendChild(link)

link = document.createElement('link');
link.rel = 'stylesheet';
link.type = 'text/css';
link.href = `{{ asset("templates/Charlie Marcotte/style.css") }}`
document.getElementsByTagName('HEAD')[0].appendChild(link)
link.onload = function(){
var socsharify = document.createElement("DIV")
socsharify.id = `socsharify`
@php
    $icons = isset($template->options) ? $template->options["social networks"] : ["github","facebook","twitter","instagram","linkedin"];
    $position = isset($template->options) ? $template->options["position"] : "bottom";
@endphp
let style = ``
@switch ($position)
    @case("left")
    socsharify.classList.add("left")
    @break
    @case("right")
    socsharify.classList.add("right")
    @break
@endswitch

var html=`
    <input type="checkbox" id="control"/>
    <label id="main-menu" for="control">
        <div class="share top">
            <div class="toplayer"></div>
        </div>
        <div class="share mid">
            <div class="toplayer"></div>
        </div>
        <div class="share bottom">
            <div class="toplayer"></div>
        </div>
    </label>
    @php $stt = 0; @endphp
    @foreach($icons as $key => $icon)
        @php $stt++ @endphp
    <div class="icon-container button share-button {{ $icon }}-share-button st-custom-button" data-network="{{ $icon }}">${ icons['{{ $icon }}'] ?? "" }
        <div class="section one"></div>
        <div class="section two"></div>
        <div class="section three"></div>
        <div class="section four"></div><a class="hover-toggle" href="#" @if($stt == count($icons)) id="final" @endif></a>
    </div>
    @endforeach
`
socsharify.innerHTML = html

document.body.appendChild(socsharify)
}