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
    if(count($icons) < 5){
        for ($i = count($icons); $i < 5; $i++){
            $icons[] = "";
        }
    }
    $position = isset($template->options) ? $template->options["position"] : "right";
@endphp
socsharify.classList.add(`s{{ $position }}`)
var html = `
@foreach($icons as $key => $icon)
    <div class="letters">
        <div class="card">
            <div class="card_face front">${ characters[{{ $key }}] }</div>
            <div class="card_face back button share-button {{ $icon }}-share-button st-custom-button"
                 data-network="{{ $icon }}">${ icons['{{ $icon }}'] ?? "" }
            </div>
        </div>
    </div>
@endforeach
`
socsharify.innerHTML = html
document.body.appendChild(socsharify)
}
