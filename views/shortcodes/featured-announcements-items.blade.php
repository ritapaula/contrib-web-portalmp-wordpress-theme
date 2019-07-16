<div class="col-md-6 col-lg-3">
  <div class="featured__item featured__item--noback item_announcement card mb-8">
    <div class="entry-meta">
      <time class="updated" datetime="{{ get_post_time('c', true) }}">{{ get_the_date() }}</time>
    </div>
    <div class="card-body">
      <h3 class="featured__item__title">{{ get_the_title() }}</h3>
      @php(the_excerpt())
    </div>
  </div>
</div>
