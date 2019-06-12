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
                {!! App::getThumbnailAndCaption('large') !!}
            </div>
        @endif
    @endif
    @include('partials/entry-meta')
  </header>
  <div class="entry-content">
    @php(the_content())
  </div>
  <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'uvigothemewp'), 'after' => '</p></nav>']) !!}
  </footer>
  @php(comments_template('/partials/comments.blade.php'))
</article>
