<article @php(post_class('list-feed-item'))>
    @php($start_date =  mysql2date( 'U', get_post_meta(get_the_ID(), 'uvigo_offers_offer_start_date', true), false ))
    <div class="list-feed-item-preline">
        <time class="updated" datetime="{{ $start_date }}">{{ date(get_option('date_format'), $start_date) }}</time>
        | <span class="text-uppercase">{{ get_post_meta(get_the_ID(), 'uvigo_offers_offer_reference', true) }}</span>
    </div>
    <!-- <a class="list-feed-item-link" href="{{ get_permalink() }}">{{ get_the_title() }}</a> -->
    @include('partials.content-single-uvigo-offer')
</article>