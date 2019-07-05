<section class="featured-announcements">
  <div class="featured pt-4 pb-8 {{$featured_list_classname}}">
    <div class="container">
      <h2 class="featured__title h2 mt-10 mb-10">{{$featured_title}}</h2>

      <div class="row justify-content-start">

        @foreach ($featured_list as $item)
          {!! $item['html'] !!}
        @endforeach

      </div>

      <div class="featured__footer row justify-content-end">
        <a class="btn btn-primary" href="{{$featured_button_url}}">{{$featured_button_title}}</a>
      </div>

    </div>
  </div>
</section>
