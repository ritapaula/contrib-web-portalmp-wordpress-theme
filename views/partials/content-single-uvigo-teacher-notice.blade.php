@php($end_date = get_post_meta(get_the_ID(), 'uvigo_teaching_teacher_notice_end_date', true))

<article @php(post_class())>
  <header>
    <h1 class="entry-title">{{ get_the_title() }}</h1>
    @if (has_excerpt())
      <div class="entry-excerpt">
        @php(the_excerpt())
      </div>
    @endif
    @include('partials/entry-tax')

    @if (App::hasFeaturedVideo())
        <div class="entry-thumbnail entry-thumbnail-video">
            {!! App::renderFeaturedVideo() !!}
        </div>
    @else
        @if (has_post_thumbnail())
            <div class="entry-thumbnail">
                {!! App::getThumbnailAndCaption('featured-thumbnail') !!}
            </div>
        @endif
    @endif
  </header>
  <div class="entry-content">
    @php(the_content())
  </div>
</article>
