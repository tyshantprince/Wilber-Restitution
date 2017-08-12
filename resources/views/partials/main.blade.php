@include('partials.header')

<div id="{{ $top_level_id or "app" }}">
        @yield('content')
</div>

@include('partials.footer')