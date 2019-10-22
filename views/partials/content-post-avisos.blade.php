<article @php(post_class('mb-10'))>
  <header>
    <div class="entry-meta mb-2">
      <time class="updated" datetime="{{ get_post_time('c', true) }}">{{ get_the_date() }}</time>
    </div>
    <p class="entry-title mb-3 font-weight-normal">{{ get_the_title() }}</p>
    @php(the_excerpt())
  </header>
</article>
