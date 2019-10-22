<div class="top-header">
    <div class="container">
        <div class="row no-gutters align-items-center">

            <div class="col-auto justify-content-start">
                <a href="http://uvigo.gal" target="_blank"><img class="logo-uvigo" width="200" height="30" src="@asset('images/uvigo.svg')" alt="Universidade de Vigo"></a>
            </div>

            <div class="col justify-content-center">

                <div id="top-header-menu" class="row no-gutters align-items-center top-header-menu">
                    <div class="col justify-content-center text-center">
                        @if (has_nav_menu('header_navigation'))
                        {!! wp_nav_menu(['theme_location' => 'header_navigation', 'menu_class' => 'top-header-links2', 'container_id' => 'header-navigation', 'walker' => new UVigoThemeWPApp\UVigoSplitMenuWalker()]) !!}
                        @endif
                    </div>

                    <div class="col-auto justify-content-end text-right">
                        <ul class="top-header-links">
                            {{-- <li><a href="#" target="_blank">Sede electrónica</a></li> --}}
                            <li><a href="https://secretaria.uvigo.gal/" title="Secretaría" class="elegant-icon" target="_blank"><span aria-hidden="true" class="icon_profile"></span> Secretaría</a></li>
                        </ul>
                        {!! App::languagesMenuSelector() !!}
                    </div>
                </div>

            </div>

            <div class="col-auto justify-content-end text-right">
                <button type="button" id="top-header__toggle-button" data-toggle="toggle" data-target="#top-header-menu" data-icon="3" class="top-header-menu__toggle-button">Utilidades</button>
                <button type="button" id="globalsearch__toggle-button" data-toggle="search" data-target="#currentsearch" class="btn globalsearch__toggle-button" data-icon="&#x55;"><span class="sr-only">{{ _e( 'Search', 'uvigothemewp' ) }}</span></button>
            </div>

        </div>
    </div>
</div>
