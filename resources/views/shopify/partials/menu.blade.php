@php
    $r = \Route::current()->getAction();
    $route = (isset($r['as'])) ? $r['as'] : '';
@endphp

<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, 'home') ? 'active' : '' }}" href="{{ route('home') }}">
        <span class="icon-holder">
            <i class="c-blue-500 ti-home"></i>
        </span>
        <span class="title">Dashboard</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, 'shopify.templates.index') ? 'active' : '' }}" href="{{ route('shopify.templates.index') }}">
        <span class="icon-holder">
            <i class="c-blue-500 ti-list"></i>
        </span>
        <span class="title">Templates</span>
    </a>
</li>
