<div class="bottom-header">
  <div class="container">

    <div class="row bottom-header-row no-gutters2">
      <div class="brand-container col-9 col-xl-4">

          <div class="brand-header">
            @if (function_exists('the_custom_logo'))
              <div class="brand-logo">{!! the_custom_logo() !!}</div>
              <div class="brand-mobile-logo">{!! App::theCustomMobileLogo() !!}</div>
            @endif
          </div>

      </div>
      <div class="menu-toggle col-3">

        <button type="button" data-toggle="togglenav" data-target="#nav-container" class="toggle-button d-none">
          <span class="sr-only">{{ _e( 'Menu', 'uvigothemewp' ) }}</span>
          <span class="toggle-bar"></span>
          <span class="toggle-bar"></span>
          <span class="toggle-bar"></span>
          <span class="toggle-bar"></span>
        </button>

        <button type="button" class="toggle-button toggle-button-mobile">
          <span class="sr-only">{{ _e( 'Menu', 'uvigothemewp' ) }}</span>
          <span class="toggle-bar"></span>
          <span class="toggle-bar"></span>
          <span class="toggle-bar"></span>
          <span class="toggle-bar"></span>
        </button>

      </div>

      <div id="nav-container" class="menu-container col-8">
        <nav class="nav-primary">
          @if (has_nav_menu('primary_navigation'))
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav justify-content-end', 'container_id' => 'primary-navigation']) !!}
          @endif
        </nav>
      </div>
    </div>

  </div>
</div>

<div id="nav-container-mobile" class="nav-container-mobile">
  <div class="container">
    <nav class="nav-primary-mobile">
        @if (has_nav_menu('primary_navigation'))
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'container_id' => 'primary-navigation', 'after' => '<span class="menu-item-more">+</span>']) !!}
        @endif
    </nav>
  </div>
</div>
