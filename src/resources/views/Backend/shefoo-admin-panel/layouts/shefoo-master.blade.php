
{{-- load the header that contains the css and js assets --}}
@include('layouts.shared.header')
{{-- load the top navbar that contains notifications and authenticated user setiings --}}
@include('layouts.shared.navbar')
{{-- load the sidebar or the main menu that contains the links to all features --}}
@include('layouts.shared.sidebar')
{{-- the main content will replaced here --}}
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>

{{-- load the footer that contains the copy rights and js files --}}
@include('layouts.shared.footer')
