<div class="uvigo-slide__featured__item"> 
  <div class="featured__item card">
    <div class="featured__item__type card-header text-uppercase">{{ App::getPostTypeTitle(get_post_type()) }}</div>
    <div class="entry-thumbnail">
        <a href="{{ get_permalink() }}" style="">
        {!! App::getThumbnailBackground('featured-thumbnail', ['class' => 'card-img-top']) !!}
      </a>
    </div>
    <div class="card-body">
      <h3 class="featured__item__title"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h3>
      @php(the_excerpt())
    </div>
  </div>
</div>

