@include('partials.header')

<div id="{{ $top_level_id or "app" }}">
    <div class="container">

        @yield('content')

    </div>
</div>

@include('partials.footer')