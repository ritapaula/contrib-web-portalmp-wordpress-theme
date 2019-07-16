<header class="banner">

  <div id="currentsearch" class="currentsearch">
    <div class="currentsearch__container">
        <div class="currentsearch__content align-items-center">
        <button type="button" id="globalsearch__toggle-button" data-toggle="search" data-target="#currentsearch" class="btn globalsearch__toggle-button close-button" data-icon="&#x4d;"><span class="sr-only">{{ _e( 'Close', 'uvigothemewp' ) }}</span></button>
        <div class="col-6 offset-3">
            {{ get_search_form() }}
        </div>
      </div>
    </div>
  </div>

  @include('partials/header-uvigo')

  @include('partials/header-bottom')

  @include('partials/header-esei-page')

</header>
