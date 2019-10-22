<?php

namespace UVigoThemeWPApp;

use WP_Widget;

class UVigoAnnouncementsWidget extends WP_Widget
{
    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'widget-announcements',
            'description' => esc_html__('List latest announcements', 'uvigothemewp'),
            'customize_selective_refresh' => true,
        );
        parent::__construct('uvigo_announcements_widget', esc_html__('Announcements widget', 'uvigothemewp'), $widget_ops);
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        if (! isset($args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }

        $title = (! empty($instance['title'])) ? $instance['title'] : '';

        $number = (! empty($instance['number'])) ? absint($instance['number']) : 5;
        if (! $number) {
            $number = 5;
        }
        $show_excerpt = isset($instance['show_excerpt']) ? $instance['show_excerpt'] : false;
        $category     = isset($instance['category']) ? absint($instance['category']) : 0;
        $classname    = ! empty($instance['classname']) ? $instance['classname'] : '';

        $r = new \WP_Query(apply_filters('widget_posts_args', array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'cat'                 => $category,
        ), $instance));

        if (! $r->have_posts()) {
            return;
        }
        ?>
        <?php echo $args['before_widget']; ?>
        <?php
        if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        if ($show_excerpt) {
            $classname .= ' has-excerpt';
        }
        ?>
        <div class="post-items <?php echo $classname; ?>">
            <?php foreach ($r->posts as $recent_post) : ?>
                <?php
                $post_title = get_the_title($recent_post->ID);
                $title      = (! empty($post_title)) ? $post_title : __('(no title)');
                ?>
                <article class="post-item">
                    <div class="post-date"><?php echo get_the_date('', $recent_post->ID); ?></div>
                    <div class="post-title"><?php echo $title ; ?></div>
                    <?php if ($show_excerpt && has_excerpt($recent_post->ID)) : ?>
                        <div class="post-excerpt">
                            <?php echo apply_filters('the_excerpt', get_the_excerpt($recent_post->ID)); ?>
                        </div>
                    <?php endif; ?>
                    <div class="post-excerpt">
                        <?php echo apply_filters('the_content', get_the_content(null, false, $recent_post->ID)); ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <?php
        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form($instance)
    {
        $title        = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number       = isset($instance['number']) ? absint($instance['number']) : 5;
        $show_excerpt = isset($instance['show_excerpt']) ? (bool) $instance['show_excerpt'] : false;
        $category     = isset($instance['category']) ? absint($instance['category']) : 0;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
        </p>
        <p>
            <input class="checkbox" type="checkbox"<?php checked($show_excerpt); ?> id="<?php echo $this->get_field_id('show_excerpt'); ?>" name="<?php echo $this->get_field_name('show_excerpt'); ?>" />
            <label for="<?php echo $this->get_field_id('show_excerpt'); ?>"><?php _e('Display excerpt?', 'uvigothemewp'); ?></label>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php esc_html_e('Select a Category:', 'uvigothemewp'); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('category')); ?>" name="<?php echo esc_attr($this->get_field_name('category')); ?>">
                <option value="0" <?php selected(0, $category); ?>><?php esc_html_e('All', 'uvigothemewp'); ?></option>
                <?php $categories = get_categories(); ?>
                <?php foreach ($categories as $cat) : ?>
                    <option value="<?php echo absint($cat->cat_ID); ?>" <?php selected($cat->cat_ID, $category); ?>><?php echo esc_html($cat->cat_name) . ' (' . absint($cat->category_count) . ')'; ?></option>
                <?php endforeach; ?>
            </select>
            <br><small><?php esc_html_e('Select a category to display posts from.', 'uvigothemewp'); ?></small>
        </p>
        <?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['show_excerpt'] = isset($new_instance['show_excerpt']) ? (bool) $new_instance['show_excerpt'] : false;
        $instance['category'] = isset($new_instance['category']) ? (int) $new_instance['category'] : 0;

        return $instance;
    }
}

/**
 * Widget "uvigo_menu_widget"
 */
add_action('widgets_init', function () {
    register_widget('UVigoThemeWPApp\UVigoAnnouncementsWidget');
});
