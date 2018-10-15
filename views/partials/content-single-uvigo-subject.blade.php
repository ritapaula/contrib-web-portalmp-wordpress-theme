<article @php(post_class())>
  <header>
    <h1 class="entry-title">{{ get_the_title() }}</h1>
    @if (has_excerpt())
      <div class="entry-excerpt">
        @php(the_excerpt())
      </div>
    @endif
    {{-- @include('partials/entry-meta') --}}
    {{-- @include('partials/entry-tax') --}}
    @if (has_post_thumbnail())
      <div class="entry-thumbnail">
        {!! UVigoThemeWPApp::getThumbnailAndCaption('large') !!}
      </div>
    @endif
  </header>
  <div class="entry-section general-data">
    <p class="field">
      <span class="field__label">{{ __('Code', 'uvigothemewp') }}: </span>
      <span class="field__item">{{ the_field('uvigo_teaching_subject_codigo') }}</span>
    </p>
    <p class="field">
      <span class="field__label">{{ __('Acronym', 'uvigothemewp') }}: </span>
      <span class="field__item">{{ the_field('uvigo_teaching_subject_acronimo') }}</span>
    </p>
    <p class="field">
      <span class="field__label">{{ __('Name', 'uvigothemewp') }}: </span>
      <span class="field__item">{{ get_the_title() }}</span>
    </p>
    <p class="field">
      <span class="field__label">{{ __('Center', 'uvigothemewp') }}: </span>
      <span class="field__item">{!! do_shortcode('[uvigo_center][/uvigo_center]') !!}</span>
    </p>
    <p class="field">
      <span class="field__label">{{ __('Certification', 'uvigothemewp') }}: </span>
      <span class="field__item">{!! do_shortcode('[uvigo_certification id_subject=' . get_the_ID() . ' ][/uvigo_certification]') !!}</span>
    </p>
    <p class="field">
      <span class="field__label">{{ __('Course', 'uvigothemewp') }}: </span>
      <span class="field__item">
        @php( $course = get_field('uvigo_teaching_subject_course') )
        @if ( $course )
          {{ $course['label'] }}
        @endif
      </span>
    </p>
    <p class="field">
      <span class="field__label">{{ __('Period', 'uvigothemewp') }}: </span>
      <span class="field__item">
        @php( $period = get_field('uvigo_teaching_subject_period') )
        @if ( $period )
          {{ $period['label'] }}
        @endif
      </span>
    </p>
    <p class="field">
      <span class="field__label">{{ __('Type', 'uvigothemewp') }}: </span>
      <span class="field__item">
        @php( $type = get_field('uvigo_teaching_subject_type') )
        @if ( $type )
          {{ $type['label'] }}
        @endif
      </span>
    </p>
    <p class="field">
      <span class="field__label">{{ __('Learning outcomes', 'uvigothemewp') }}: </span>
      <span class="field__item">{{ the_field('uvigo_teaching_subject_learning_outcomes') }}</span>
    </p>
    <p class="field">
      <span class="field__label">{{ __('Department', 'uvigothemewp') }}: </span>
      <span class="field__item">{!! do_shortcode('[uvigo_departments post_id=' . get_the_ID() . ' ][/uvigo_departments]') !!}</span>
    </p>
    <p class="field">
      <span class="field__label">{{ __('Web', 'uvigothemewp') }}: </span>
      <span class="field__item">
        @php( $teaching_guide_url = get_field('uvigo_teaching_subject_teaching_guide') )
        @if ( $teaching_guide_url )
          <a href="{{ the_field('uvigo_teaching_subject_web') }}" target="_blank">{{ the_field('uvigo_teaching_subject_web') }}</a>
        @endif
        </span>
    </p>
    <p class="field">
      <span class="field__label">{{ __('Teachers', 'uvigothemewp') }}: </span>
      <span class="field__item">{!! do_shortcode('[uvigo_teachers template="list" id_subject=' . get_the_ID() . ' ][/uvigo_teachers]') !!}</span>
    </p>
    <p class="field">
      <span class="field__label">{{ __('Responsible teachers', 'uvigothemewp') }}: </span>
      <span class="field__item">
        @php( $responsible_teacher_id = get_field('uvigo_teaching_subject_responsible_teacher') )
        @if ( $responsible_teacher_id )
          <a href="{{ get_permalink( $responsible_teacher_id ) }}" target="_blank">{{ get_the_title( $responsible_teacher_id ) }}</a>
        @endif
      </span>
    </p>
    <p class="field">
      <span class="field__label">{{ __('Teaching guide', 'uvigothemewp') }}: </span>
      <span class="field__item">
        @php( $teaching_guide_url = get_field('uvigo_teaching_subject_teaching_guide') )
        @if ( $teaching_guide_url )
          <a href="{{ the_field( 'uvigo_teaching_subject_teaching_guide' ) }}" target="_blank">{{ __('Link DocNet', 'uvigothemewp') }}</a>
        @endif
      </span>
    </p>
  </div>
</article>
