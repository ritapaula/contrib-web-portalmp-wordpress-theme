<footer class="content-info">
  <div class="container">
    @if(is_active_sidebar('sidebar-footer'))
        <div class="footer-items">
        @php(dynamic_sidebar('sidebar-footer'))
        </div>
    @endif
    @if(is_active_sidebar('sidebar-sponsor'))
        <div class="sponsor">
        @php(dynamic_sidebar('sidebar-sponsor'))
        </div>
    @endif
  </div>
  <div class="uvigo-footer uvigo-pre-footer">
      @php( $uvigo_pre_footer_content = apply_filters('uvigo_pre_footer_content', []) )
      {!! $uvigo_pre_footer_content !!}
  </div>
  <div class="uvigo-footer">
    <div id="reorder-footer" class="container">
      @include('partials/footer-uvigo')
    </div>
  </div>
</footer>
