@php
$slider_options = [
    'slidesToShow' => 4,
    'slidesToScroll' => 1,
    'autoplay' => false,
    'responsive' => [
        [
            'breakpoint' => 1024,
            'settings' => [
                'slidesToShow' => 3,
                'dots' => false,
                'arrows' => true
            ]
        ],
        [
            'breakpoint' => 800,
            'settings' => [
                'slidesToShow' => 2,
                'dots' => true,
                'arrows' => false
            ]
        ],
        [
            'breakpoint' => 600,
            'settings' => [
                'slidesToShow' => 1,
                'dots' => true,
                'arrows' => false
            ]
        ]
    ]
];
@endphp
<section class="uvigo-featured-esei {{$featured_root_classname}}">
  <div class="featured pt-4 pb-6">
    <div class="container">
      <h2 class="featured__title h2 mt-12 mb-11">{{$featured_title}}</h2>
      <div class="slick-slider sliderbehaviour slick-slider-esei"
        data-slick='@json($slider_options)'>
            @foreach ($featured_list as $item)
                {!! $item['html'] !!}
            @endforeach
      </div>
      @if ($featured_button_title !== '')
      <div class="featured__footer row justify-content-end">
        <a class="btn btn-primary" href="{{$featured_button_url}}">{{$featured_button_title}}</a>
      </div>
      @endif
    </div>
  </div>
</section>
