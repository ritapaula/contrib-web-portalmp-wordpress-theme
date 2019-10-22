@php
$slider_options = [
    'slidesToShow' => 4,
    'slidesToScroll' => 1,
    'autoplay' => false,
    'responsive' => [
        [
            'breakpoint' => 1200,
            'settings' => [
                'slidesToShow' => 3,
                'dots' => false,
                'arrows' => true
            ]
        ],
        [
            'breakpoint' => 992,
            'settings' => [
                'slidesToShow' => 2,
                'dots' => true,
                'arrows' => false
            ]
        ],
        [
            'breakpoint' => 768,
            'settings' => [
                'slidesToShow' => 1,
                'dots' => true,
                'arrows' => false
            ]
        ]
    ]
];
@endphp
<section class="uvigo-genericslider {{$genericslider_root_classname}}">
  <div class="featured pt-12 pb-10">
    <div class="container">
      <h2 class="featured__title h2 mt-12 mb-10">{{ $genericslider_title }}</h2>
      <div class="slick-slider sliderbehaviour slick-slider-esei"
        data-slick='@json($slider_options)'>
          {!! $genericslider_content !!}
      </div>
    </div>
  </div>
</section>
