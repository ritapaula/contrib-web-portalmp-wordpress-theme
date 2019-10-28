<article @php(post_class('list-feed-item'))>
    @php($end_date =  mysql2date( 'U', get_post_meta(get_the_ID(), 'uvigo_teaching_teacher_notice_end_date', true), false ))
    @php($teacher_id = get_post_meta(get_the_ID(), 'uvigo_teaching_teacher_notice_post_id', true))
    <div class="list-feed-item-preline">
        <time class="updated" datetime="{{ $start_date }}">{{ date(get_option('date_format'), $end_date) }}</time>
        | <span class="text-uppercase">{{ get_the_title($teacher_id) }}</span>
    </div>
    @include('partials.content-single-uvigo-teacher-notice')
</article>
