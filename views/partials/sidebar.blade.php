@if(is_active_sidebar('sidebar-primary'))
    @php(dynamic_sidebar('sidebar-primary'))
@endif

{!! UVigoThemeWPApp::getSidebarUsed() !!}
