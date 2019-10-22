@php($place = get_post_meta(get_the_ID(), 'uvigo_news_event_place', true))
@php($place_url = get_post_meta(get_the_ID(), 'uvigo_news_event_place_url', true))
@php($date = get_post_meta(get_the_ID(), 'uvigo_news_event_start_date', true))
@php($speaker = get_post_meta(get_the_ID(), 'uvigo_news_event_speaker', true))
@php($speaker_position = get_post_meta(get_the_ID(), 'uvigo_news_event_speaker_position', true))
@php($poster = get_field('uvigo_event_poster'))

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

    {{-- @include('partials/entry-meta') --}}

    <div class="custom-block">

        <div class="row">
            <div class="col-6">
                
                <p class="entry-meta-item d-block mb-3">
                    <span class="icon_clock_alt position-absolute" style="font-size: 1.375rem; margin-top: -2px;" aria-hidden="true"></span>
                    <span class="pl-7 d-block">{{ $date }}</span>
                </p>
                <p class="entry-meta-item d-block mb-4">
                    <span class="icon_pin_alt position-absolute" style="font-size: 1.5rem;" aria-hidden="true"></span>
                    <span class="pl-7 d-block">
                        @if($place_url)
                            <a target="_blank" class="font-weight-normal" href="{!! $place_url !!}">{{ $place }}</a>
                        @else
                            {{ $place }}
                        @endif
                    </span>
                </p>
                @if($speaker)
                    <p class="entry-meta-item d-block font-weight-normal mb-4">
                        <span class="icon_id position-absolute" style="font-size: 1.5rem; margin-top: -2px;" aria-hidden="true"></span>
                        <span class="pl-7 d-block">
                            {{ $speaker }}
                            {{-- @if($speaker_position)
                                <span class="entry-meta-item d-block text-gray">{{ $speaker_position }}</span>
                            @endif --}}
                        </span>
                    </p>
                @endif
                @if($poster)
                    <p class="entry-meta-item d-block font-weight-normal mb-4">
                        <span class="icon_menu-square_alt2 position-absolute" style="font-size: 1.375rem;" aria-hidden="true"></span>
                        <span class="pl-7 d-block">
                            <a target="_blank" class="font-weight-normal" href="{{ $poster['url'] }}">Cartel (<span class="font-weight-regular text-uppercase">{{ $poster['subtype'] }}, {{ size_format($poster['filesize']) }}</span>)</a>                            
                        </span>
                    </p>
                @endif
            </div>
            <div class="col-6">
                @if(have_rows('uvigo_event_videos'))
                    <div class="h4 text-primary mb-4">
                        <span class="icon_film position-absolute" style="font-size: 1.25rem; margin-top: -2px;" aria-hidden="true"></span>
                        <span class="d-block pl-7">Vídeos</span>
                    </div>
                    <ul class="list-peak">
                        @while(have_rows('uvigo_event_videos')) @php(the_row())
                            <li>
                                <a href="@php(the_sub_field('uvigo_event_video_url'))" target="_blank">@php(the_sub_field('uvigo_event_video_title'))</a>
                                {{--
                                @if(get_sub_field('uvigo_event_video_subtitle'))
                                    <span class="d-block">@php(the_sub_field('uvigo_event_video_subtitle'))</span>
                                @endif
                                --}}
                            </li>
                        @endwhile
                    </ul>
                @endif

            </div>
        </div>

    </div>

  </header>
  <div class="entry-content">
    @php(the_content())

    @if(have_rows('uvigo_event_videos'))
        <h2>Vídeos</h2>
        <ul class="list-peak">
            @while(have_rows('uvigo_event_videos')) @php(the_row())
                <li>
                    <a href="@php(the_sub_field('uvigo_event_video_url'))" target="_blank">@php(the_sub_field('uvigo_event_video_title'))</a>
                    @if(get_sub_field('uvigo_event_video_subtitle'))
                        <span class="d-block">@php(the_sub_field('uvigo_event_video_subtitle'))</span>
                    @endif
                </li>
            @endwhile
        </ul>
    @endif

  </div>
  <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'ciuvigo'), 'after' => '</p></nav>']) !!}
  </footer>
  @php(comments_template('/partials/comments.blade.php'))
</article>
