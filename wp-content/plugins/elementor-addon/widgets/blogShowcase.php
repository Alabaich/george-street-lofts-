<?php

class Elementor_BlogShowcase extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'BlogShowcase';
    }

    public function get_title()
    {
        return esc_html__('Latest News and Events', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-post-list';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_general_content',
            [
                'label' => esc_html__('Section Settings', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => esc_html__('Section Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Latest News And Events', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'all_posts_link',
            [
                'label' => esc_html__('Read All Posts Button Link', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-site.com/blog', 'elementor-addon'),
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_taxonomy_source',
            [
                'label' => esc_html__('Tags/Categories Navigation', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'taxonomy_source',
            [
                'label' => esc_html__('Source for Tags/Categories', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'post_tag',
                'options' => [
                    'category' => esc_html__('Categories', 'elementor-addon'),
                    'post_tag' => esc_html__('Tags', 'elementor-addon'),
                ],
            ]
        );

        $this->add_control(
            'taxonomy_limit',
            [
                'label' => esc_html__('Number of Tags/Categories to Show', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 4,
                'min' => 1,
            ]
        );

        $this->add_control(
            'show_all_tag',
            [
                'label' => esc_html__('Show "All" Tag', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'elementor-addon'),
                'label_off' => esc_html__('Hide', 'elementor-addon'),
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_query',
            [
                'label' => esc_html__('Posts Query', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Number of Posts', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 4,
                'description' => esc_html__('Displays 1 large post and 3 small posts.', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'read_time_label',
            [
                'label' => esc_html__('Read Time Label Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('min read', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();

        if (!function_exists('calculate_read_time')) {
            function calculate_read_time($content, $wpm = 200)
            {
                $word_count = str_word_count(strip_tags($content));
                $minutes = ceil($word_count / $wpm);
                return max(1, $minutes);
            }
        }

        $args = [
            'post_type' => 'post',
            'posts_per_page' => $settings['posts_per_page'],
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
        ];
        $query = new \WP_Query($args);

        $posts_list = [];
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $post_id = get_the_ID();

                $image_url = get_the_post_thumbnail_url($post_id, 'full');
                if (!$image_url) {
                    $image_url = \Elementor\Utils::get_placeholder_image_src();
                }

                $terms_list = wp_get_post_terms($post_id, $settings['taxonomy_source'], ['fields' => 'slugs']);
                $filter_classes = implode(' ', $terms_list);

                $posts_list[] = [
                    'id' => $post_id,
                    'title' => get_the_title(),
                    'link' => get_permalink(),
                    'date' => get_the_date('F j, Y'),
                    'image_url' => $image_url,
                    'excerpt' => get_the_excerpt(),
                    'filter_classes' => esc_attr($filter_classes),
                    'read_time' => calculate_read_time(get_post_field('post_content', $post_id)),
                ];
            }
            wp_reset_postdata();
        }

        $terms = get_terms([
            'taxonomy' => $settings['taxonomy_source'],
            'hide_empty' => true,
            'number' => $settings['taxonomy_limit'],
        ]);

        $all_posts_url = get_post_type_archive_link('post');
        if (!$all_posts_url) {
            $all_posts_url = esc_url($settings['all_posts_link']['url']);
        }

        $svg_arrow = '<svg class="atria-read-more-svg" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.91591 16.0977C7.56088 16.4527 6.98528 16.4527 6.63026 16.0977C6.27524 15.7427 6.27524 15.1671 6.63026 14.8121L11.442 10.0004L6.63026 5.18864C6.27524 4.83361 6.27524 4.25801 6.63026 3.90299C6.98528 3.54796 7.56088 3.54796 7.91591 3.90299L13.3705 9.35753C13.7255 9.71256 13.7255 10.2882 13.3705 10.6432L7.91591 16.0977Z" fill="#32302F"/></svg>';
?>
        <style>
            .atria-blog-showcase {
                display: flex;
                flex-direction: column;
                gap: 25px;
                text-align: center;
                color: #32302F;
            }

            .atria-blog-title {
                font-size: 40px;
                font-weight: bold;
                margin: 0;
            }

            .atria-tag-navigation {
                display: flex;
                justify-content: center;
                gap: 10px;
                flex-wrap: wrap;
            }

            .atria-tag-navigation a {
                background-color: #eee;
                color: #32302F;
                padding: 8px 15px;
                text-decoration: none;
                border-radius: 4px;
                font-size: 14px;
                transition: background-color 0.3s, color 0.3s;
                white-space: nowrap;
                cursor: pointer;
            }

            .atria-tag-navigation a.is-active {
                background-color: #AA7F4C;
                color: #fff;
            }

            .atria-tag-navigation a:hover {
                background-color: #AA7F4C;
                color: #fff;
            }

            .atria-posts-container {
                display: flex;
                flex-direction: column;
                gap: 30px;
            }

            .atria-main-post {
                display: block;
                text-align: left;
                text-decoration: none;
                color: #32302F;
                display: none;
                opacity: 0;
                transition: opacity 0.5s ease;
            }

            .atria-main-post.is-visible {
                display: block;
                opacity: 1;
            }

            .atria-main-post-image-wrapper {
                margin-bottom: 15px;
                overflow: hidden;
                max-height: 300px;
                border-radius: 4px;
            }

            .atria-main-post-image {
                width: 100%;
                height: 300px;
                object-fit: cover;
                display: block;
                transition: transform 0.3s ease;
            }

            .atria-post-date {
                color: var(--Color-Grey, #9E9E9E);
                font-family: Arial;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 110%;
            }

            .atria-main-post-title {
                color: var(--Black, #32302F);
                font-family: "Albra Book TRIAL";
                font-size: 28px;
                font-style: normal;
                font-weight: 500;
                line-height: 130%;
                text-transform: capitalize;
            }

            .atria-read-time {
                color: var(--Color-Grey, #9E9E9E);
                font-family: Arial;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 110%;
                float: right;
            }

            .atria-read-more {
                color: var(--Black, #32302F);
                font-family: "Albra Book TRIAL";
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: 110%;
                display: flex;
                align-items: center;
                gap: 5px;
                width: max-content;
            }

            .atria-read-more:after {
                content: none;
            }

            .atria-read-more-svg {
                transition: transform 0.3s ease;
            }

            .atria-small-posts-grid {
                display: none;
                grid-template-columns: repeat(3, 1fr);
                gap: 30px;
                text-align: left;
                transition: opacity 0.5s ease;
            }

            .atria-small-posts-grid.is-visible {
                display: grid;
            }

            .atria-small-post {
                display: block;
                text-decoration: none;
                color: #32302F;
                display: none;
            }

            .atria-small-post.is-visible {
                display: block;
            }

            .atria-small-post-image-wrapper {
                margin-bottom: 10px;
                overflow: hidden;
                border-radius: 4px;
                max-height: 250px;
            }

            .atria-small-post-image {
                width: 100%;
                height: 150px;
                object-fit: cover;
                display: block;
                transition: transform 0.3s ease;
            }

            .atria-small-post-title {
                font-size: 16px;
                font-weight: bold;
                margin: 0 0 5px 0;
                line-height: 1.4;
            }

            .atria-footer {
                display: flex;
                justify-content: center;
            }

            .atria-main-post:hover .atria-main-post-image {
                transform: scale(1.05);
            }

            .atria-main-post:hover .atria-read-more-svg {
                transform: translateX(5px);
            }

            .atria-small-post:hover .atria-small-post-image {
                transform: scale(1.05);
            }

            .atria-small-post:hover .atria-read-more-svg {
                transform: translateX(5px);
            }

            .atria-blog-showcase .mainButton {
                width: fit-content;
            }

            @media (max-width: 1024px) {
                .atria-main-post-image {
                    height: 250px;
                }

                .atria-small-posts-grid {
                    grid-template-columns: repeat(2, 1fr);
                }

                .atria-small-post-image {
                    height: 120px;
                }

                .atria-small-post:nth-child(3) {
                    grid-column: span 2;
                    max-width: 500px;
                    margin: 0 auto;
                    text-align: center;
                }
            }

            @media (max-width: 767px) {
                .atria-blog-title {
                    font-size: 30px;
                }

                .atria-main-post-image {
                    height: 180px;
                }

                .atria-small-post-image {
                    height: 150px;
                }

                .atria-small-posts-grid {
                    grid-template-columns: 1fr;
                    gap: 20px;
                }

                .atria-small-post:nth-child(3) {
                    grid-column: span 1;
                    max-width: 100%;
                    text-align: left;
                }

                .atria-small-post:nth-child(n+3) {
                    display: none !important;
                }
            }
        </style>

        <section class="atria-blog-showcase pageWidth elementor-widget-blog-showcase-<?php echo esc_attr($widget_id); ?>">
            <div class="atria-blog-header">
                <h2 class="atria-blog-title"><?php echo esc_html($settings['main_title']); ?></h2>
            </div>

            <div class="atria-tag-navigation">
                <?php
                $first_tag_is_all = ('yes' === $settings['show_all_tag']);

                if ($first_tag_is_all) {
                    echo '<a href="#" class="filter-item is-active" data-filter="all">All</a>';
                }

                if (!is_wp_error($terms) && !empty($terms)) {
                    foreach ($terms as $term) {
                        $is_active_class = !$first_tag_is_all && $term === reset($terms) ? ' is-active' : '';
                        echo '<a href="#" class="filter-item' . esc_attr($is_active_class) . '" data-filter="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</a>';
                    }
                }
                ?>
            </div>

            <div class="atria-posts-container">
                <?php
                if (!empty($posts_list)) {
                    $main_post = array_shift($posts_list);
                    $small_posts = $posts_list;

                    echo '<a href="' . esc_url($main_post['link']) . '" class="atria-main-post all ' . esc_attr($main_post['filter_classes']) . ' is-visible" data-post-item>';
                    echo '<div class="atria-main-post-image-wrapper">';
                    echo '<img src="' . esc_url($main_post['image_url']) . '" alt="' . esc_attr($main_post['title']) . '" class="atria-main-post-image">';
                    echo '</div>';
                    echo '<p class="atria-post-date">' . esc_html($main_post['date']) . '</p>';
                    echo '<h3 class="atria-main-post-title">' . esc_html($main_post['title']) . '</h3>';
                    echo '<span class="atria-read-time">' . esc_html($main_post['read_time']) . ' ' . esc_html($settings['read_time_label']) . '</span>';
                    echo '<span class="atria-read-more">Read Now' . $svg_arrow . '</span>';
                    echo '</a>';

                    if (!empty($small_posts)) {
                        echo '<div class="atria-small-posts-grid is-visible" data-post-grid>';
                        foreach ($small_posts as $index => $post) {
                            $is_visible_class = $first_tag_is_all || strpos($post['filter_classes'], reset($terms)->slug) !== false ? ' is-visible' : '';

                            echo '<a href="' . esc_url($post['link']) . '" class="atria-small-post all ' . esc_attr($post['filter_classes']) . esc_attr($is_visible_class) . '" data-post-item>';
                            echo '<div class="atria-small-post-image-wrapper">';
                            echo '<img src="' . esc_url($post['image_url']) . '" alt="' . esc_attr($post['title']) . '" class="atria-small-post-image">';
                            echo '</div>';
                            echo '<p class="atria-post-date">' . esc_html($post['date']) . '</p>';
                            echo '<h4 class="atria-small-post-title">' . esc_html($post['title']) . '</h4>';
                            echo '<span class="atria-read-time">' . esc_html($post['read_time']) . ' ' . esc_html($settings['read_time_label']) . '</span>';
                            echo '<span class="atria-read-more">Read Now' . $svg_arrow . '</span>';
                            echo '</a>';
                        }
                        echo '</div>';
                    }
                } else {
                    echo '<p>' . esc_html__('No posts found. Please publish some blog posts.', 'elementor-addon') . '</p>';
                }
                ?>
            </div>

            <?php
            if ($settings['all_posts_link']['url']) {
                $target = $settings['all_posts_link']['is_external'] ? ' target="_blank"' : '';
                $nofollow = $settings['all_posts_link']['nofollow'] ? ' rel="nofollow"' : '';

                echo '<div class="atria-footer">';
                echo '<a href="' . esc_url($settings['all_posts_link']['url']) . '" class="mainButton"' . $target . $nofollow . '>';
                echo esc_html__('Read Our Blog', 'elementor-addon');
                echo '</a>';
                echo '</div>';
            }
            ?>
        </section>

        <script>
            jQuery(document).ready(function($) {
                let widgetContainer = $('.elementor-widget-blog-showcase-<?php echo esc_js($widget_id); ?>');
                let filterItems = widgetContainer.find('.filter-item');
                let mainPost = widgetContainer.find('.atria-main-post[data-post-item]');
                let smallPostsGrid = widgetContainer.find('[data-post-grid]');
                let smallPostItems = widgetContainer.find('.atria-small-post[data-post-item]');

                filterItems.on('click', function(e) {
                    e.preventDefault();
                    let filterValue = $(this).data('filter');

                    filterItems.removeClass('is-active');
                    $(this).addClass('is-active');

                    mainPost.removeClass('is-visible');
                    smallPostsGrid.removeClass('is-visible');
                    smallPostItems.removeClass('is-visible');

                    let targetMainPost = mainPost.filter('.' + filterValue).first();
                    let targetSmallPosts = smallPostItems.filter('.' + filterValue);

                    if (targetMainPost.length > 0) {
                        targetMainPost.addClass('is-visible');
                    }

                    if (targetSmallPosts.length > 0) {
                        smallPostsGrid.addClass('is-visible');
                        targetSmallPosts.addClass('is-visible');
                    }
                });
            });
        </script>
<?php
    }
}
