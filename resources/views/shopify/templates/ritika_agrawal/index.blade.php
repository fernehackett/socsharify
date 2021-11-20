var icons = {
    github : `<i class="fab fa-github-square"></i>`,
    twitter : `<i class="fab fa-twitter-square"></i>`,
    facebook : `<i class="fab fa-facebook-square"></i>`,
    instagram : `<i class="fab fa-instagram-square"></i>`,
    google : `<i class="fab fa-google-plus-square"></i>`,
    tumblr : `<i class="fab fa-tumblr-square"></i>`,
    snapchat : `<i class="fab fa-snapchat-square"></i>`,
    pinterest : `<i class="fab fa-pinterest-square"></i>`,
    reddit : `<i class="fab fa-reddit-square"></i>`,
    telegram : `<i class="fab fa-telegram"></i>`,
    linkedin : `<i class="fab fa-linkedin"></i>`
}
var characters = [`S`,`H`,`A`,`R`,`E`,]
var link = document.createElement('link');
link.rel = 'stylesheet';
link.type = 'text/css';
link.href = `https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css`
document.getElementsByTagName('HEAD')[0].appendChild(link)

link = document.createElement('link');
link.rel = 'stylesheet';
link.type = 'text/css';
link.href = `{{ asset("templates/ritika agrawal/style.css") }}`
document.getElementsByTagName('HEAD')[0].appendChild(link)

link.onload = function(){
var socsharify = document.createElement("DIV")
socsharify.id = `socsharify`
@php
    $icons = isset($template->options) ? $template->options["social networks"] : ["github","facebook","twitter","instagram","linkedin"];
    $position = isset($template->options) ? $template->options["position"] : "right";
@endphp
var html = `
<div class="button">
    @php
    @endphp
    @foreach($icons as $key => $icon)
        <div class="letters">
            <div class="card">
                <div class="card_face front">${ characters[{{ $key }}] }</div>
                <div class="card_face back button share-button {{ $icon }}-share-button st-custom-button" data-network="{{ $icon }}">${ icons['{{ $icon }}'] ?? "" }</div>
            </div>
        </div>
    @endforeach
</div>
`
socsharify.innerHTML = html
let socsharifyBtn = socsharify.querySelector(".button");
@switch ($position)
    @case("top")
    socsharifyBtn.style.display = `flex`
    socsharifyBtn.style.width = `270px`
    socsharifyBtn.style.height = `60px`
    socsharify.style.top = `0`
    socsharify.style.bottom = `auto`
    socsharify.style.left = `50%`
    socsharify.style.right = `0`
    socsharify.style.transform = `translateX(-50%)`
    @break
    @case("bottom")
    socsharifyBtn.style.display = `flex`
    socsharifyBtn.style.width = `270px`
    socsharifyBtn.style.height = `60px`
    socsharify.style.top = `auto`
    socsharify.style.bottom = `0`
    socsharify.style.left = `50%`
    socsharify.style.right = `auto`
    socsharify.style.transform = `translateX(-50%)`
    @break
    @case("left")
    socsharifyBtn.style.display = `block`
    socsharifyBtn.style.width = `50px`
    socsharifyBtn.style.height = `250px`
    socsharify.style.top = `50%`
    socsharify.style.bottom = `auto`
    socsharify.style.left = `0`
    socsharify.style.right = `auto`
    socsharify.style.transform = `translateY(-50%)`
    @break
    @case("right")
    socsharifyBtn.style.display = `block`
    socsharifyBtn.style.width = `50px`
    socsharifyBtn.style.height = `250px`
    socsharify.style.top = `50%`
    socsharify.style.bottom = `auto`
    socsharify.style.left = `auto`
    socsharify.style.right = `0`
    socsharify.style.transform = `translateY(-50%)`
    @break
@endswitch
document.body.appendChild(socsharify)
}
