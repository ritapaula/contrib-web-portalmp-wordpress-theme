<?php

namespace UVigoThemeWPApp;

use WP_Query;

const POST_CATEGORY_TERM_NEWS_SLUG = 'novas';

/**
 * Shortcode "uvigo_esei_featured"
 *
 * Actualidade e Eventos na ESEI
 *
 *
 * @param  array $atts The attributes from the shortcode
 * @return mixed $output Output of the buffer
 */
add_shortcode('uvigo_esei_featured', function ($atts) {

    $defaults_atts = array(
        'classname' => '',
        'title' => 'Actualidade',
        'mode' => 'default', // default | footer
        'button_title' => 'Novas da ESEI',
        'button_url' => '/actualidade/'
    );

    $args = shortcode_atts($defaults_atts, $atts, 'uvigo_esei_featured');

    // Footer no se muestra en frontpage
    if ((is_front_page() || is_home() ) && $args['mode'] !== 'default') {
        return '';
    }

    $items = [];

    $not_post_in = array();
    $not_events_in = array();
    if (is_single()) {
        $pt = get_post_type();
        switch ($pt) {
            case 'post':
                $not_post_in[] = get_the_ID();
                break;
            case 'uvigo-event':
                $not_events_in[] = get_the_ID();
                break;
        }
    }

    // Buscamos as novas
    $query_args = [
        'post_type' => 'post',
        'category_name'  => POST_CATEGORY_TERM_NEWS_SLUG,
        'post__not_in' => $not_post_in,
    ];
    $uvigo_featured = new WP_Query($query_args);
    if ($uvigo_featured->have_posts()) {
        while ($uvigo_featured->have_posts()) {
            $uvigo_featured->the_post();
            $template = locate_template('shortcodes/featured-esei-items');
            $output = template($template);

            $items[] = [
                'type' => get_post_type(),
                'date' => get_the_date('Y-m-d h:i'),
                'html' => $output,
            ];
        }
    }
    // Buscamos os eventos
    $query_args = [
        'post_type' => 'uvigo-event',
        'post__not_in' => $not_events_in,
    ];
    $uvigo_featured = new WP_Query($query_args);
    if ($uvigo_featured->have_posts()) {
        while ($uvigo_featured->have_posts()) {
            $uvigo_featured->the_post();
            $template = locate_template('shortcodes/featured-esei-events');
            $output = template($template);

            $items[] = [
                'type' => get_post_type(),
                'date' => get_the_date('Y-m-d h:i'),
                'html' => $output,
            ];
        }
    }

    // Ordenar por fecha más reciente
    uasort($items, function ($a, $b) {
        $date_a = $a['date'];
        $date_b = $b['date'];
        if ($date_a == $date_b) {
            return 0;
        }
        return ($date_a < $date_b) ? 1 : -1;
    });

    sage('blade')->share('featured_list', $items);
    sage('blade')->share('featured_root_classname', $args['classname']);
    sage('blade')->share('featured_title', $args['title']);
    sage('blade')->share('featured_button_title', $args['button_title']);
    sage('blade')->share('featured_button_url', $args['button_url']);
    $template = locate_template('shortcodes/featured-esei');
    $output = template($template);

    return $output;
});


/**
 * Shortcode "uvigo_generic_slider"
 *
 * Encapsula con slider
 *
 *
 * @param  array $atts The attributes from the shortcode
 * @return mixed $output Output of the buffer
 */
add_shortcode('uvigo_generic_slider', function ($atts, $content) {

    $defaults_atts = array(
        'title' => '',
        'classname' => 'uvigo_generic_slider',
    );

    $args = shortcode_atts($defaults_atts, $atts, 'uvigo_generic_slider');

    sage('blade')->share('genericslider_title', $args['title']);
    sage('blade')->share('genericslider_content', do_shortcode($content));
    sage('blade')->share('genericslider_root_classname', $args['classname']);
    $template = locate_template('shortcodes/genericslider');
    $output = template($template);

    return $output;
});
