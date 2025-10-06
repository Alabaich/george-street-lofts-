<?php
/**
 * The template for displaying archive pages
 */

get_header();

// Helper function to get reading time. Make sure this function is in your functions.php
if (!function_exists('get_post_reading_time')) {
    function get_post_reading_time($post_id) {
        $content = get_post_field('post_content', $post_id);
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200); // Average 200 words per minute
        return $reading_time . ' min read';
    }
}
?>

<style>
    .blog-archive-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 15px;
        font-family: sans-serif;
    }
    .archive-header {
        text-align: center;
        margin-bottom: 40px;
    }
    .archive-title {
        font-family: "Serif", "Times New Roman", serif;
        font-size: 3rem;
        font-weight: normal;
        margin: 0 0 20px 0;
    }
    .category-filters {
        display: flex;
        justify-content: center;
        gap: 10px;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .category-filters a {
        display: block;
        padding: 8px 20px;
        background-color: #f0f0f0;
        color: #555;
        text-decoration: none;
        border-radius: 20px;
        transition: background-color 0.3s, color 0.3s;
    }
    .category-filters a:hover,
    .category-filters .current-cat a {
        background-color: #c5a47e;
        color: #fff;
    }

    .posts-grid-wrapper {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }
    .blog-card {
        text-align: left;
    }
    /* Special style for the first post on the first page */
    .blog-card.featured-post {
        grid-column: 1 / -1; /* Takes full width */
        text-align: left;
    }
    .blog-card.featured-post .post-thumbnail-link {
        height: 400px;
    }
    .blog-card.featured-post .post-content {
        padding: 20px 0;
    }

    .post-thumbnail-link {
        display: block;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 15px;
        height: 250px;
    }
    .post-thumbnail {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .post-thumbnail-link:hover .post-thumbnail {
        transform: scale(1.05);
    }
    .post-meta {
        font-size: 0.85rem;
        color: #888;
        margin-bottom: 10px;
    }
    .post-title {
        font-family: "Serif", "Times New Roman", serif;
        font-size: 1.4rem;
        font-weight: normal;
        margin: 0 0 15px 0;
    }
    .post-title a {
        color: #333;
        text-decoration: none;
    }
    .post-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.9rem;
        color: #777;
    }
    .read-more-link {
        color: #333;
        text-decoration: none;
        font-weight: bold;
    }

    /* Pagination */
    .pagination {
        margin-top: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }
    .pagination .nav-links {
        display: flex;
        gap: 10px;
    }
    .pagination .page-numbers {
        padding: 8px 14px;
        border: 1px solid #ddd;
        border-radius: 5px;
        text-decoration: none;
        color: #555;
    }
    .pagination .page-numbers.current,
    .pagination .page-numbers:hover {
        background-color: #c5a47e;
        color: #fff;
        border-color: #c5a47e;
    }

</style>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="blog-archive-container">

            <header class="archive-header">
                <h1 class="archive-title">
                    <?php
                    if (is_home() && !is_front_page()) {
                        echo 'Latest News And Events';
                    } else {
                        the_archive_title();
                    }
                    ?>
                </h1>

                <?php
                $categories = get_categories();
                if ($categories) :
                ?>
                    <ul class="category-filters">
                        <li class="<?php echo (is_home() || is_post_type_archive('post')) ? 'current-cat' : ''; ?>">
                            <a href="<?php echo get_post_type_archive_link('post'); ?>">All</a>
                        </li>
                        <?php
                        foreach ($categories as $category) {
                            $cat_class = (is_category($category->term_id)) ? 'current-cat' : '';
                            echo '<li class="' . $cat_class . '"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                        }
                        ?>
                    </ul>
                <?php endif; ?>
            </header>

            <?php if (have_posts()) : ?>
                <div class="posts-grid-wrapper">
                    <?php
                    $post_counter = 0;
                    while (have_posts()) :
                        the_post();
                        
                        // Check if it's the first post on the first page
                        $is_featured = ($post_counter === 0 && !is_paged());
                        $card_class = $is_featured ? 'blog-card featured-post' : 'blog-card';
                    ?>
                        <article id="post-<?php the_ID(); ?>" class="<?php echo $card_class; ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="post-thumbnail-link">
                                    <?php the_post_thumbnail('large', ['class' => 'post-thumbnail']); ?>
                                </a>
                            <?php endif; ?>

                            <div class="post-content">
                                <div class="post-meta">
                                    <span><?php echo get_the_date(); ?></span>
                                </div>
                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="post-footer">
                                    <a href="<?php the_permalink(); ?>" class="read-more-link">Read Now &gt;</a>
                                    <span class="reading-time"><?php echo get_post_reading_time(get_the_ID()); ?></span>
                                </div>
                            </div>
                        </article>
                    <?php
                        $post_counter++;
                    endwhile;
                    ?>
                </div>

                <?php
                // Pagination
                the_posts_pagination([
                    'mid_size'  => 2,
                    'prev_text' => '&lt;',
                    'next_text' => '&gt;',
                    'screen_reader_text' => __('Posts navigation', 'textdomain'),
                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'textdomain') . ' </span>',
                ]);
                ?>

            <?php else : ?>
                <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'textdomain'); ?></p>
            <?php endif; ?>

        </div>
    </main>
</div>

<?php
get_footer();
