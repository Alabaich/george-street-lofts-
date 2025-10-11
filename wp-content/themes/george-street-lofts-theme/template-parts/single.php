<?php
get_header();
?>

<style>
.main-content-wrapper {
    display: flex;
    gap: 40px;
}

.share-column {
    flex: 0 0 10%;
    min-width: 80px;
    max-width: 100px;
    position: sticky;
    top: 20px;
    align-self: flex-start;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.post-content-column {
    flex: 2;
    min-width: 60%;
}

.widget-area {
    flex: 1;
    min-width: 300px;
    position: sticky;
    top: 20px;
    align-self: flex-start;
}

.share-label-side {
    margin-bottom: 20px;
    display: block;
    color: var(--Color-Grey, #9E9E9E);
    font-family: Arial;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 110%;
}

.share-icon-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.share-icon-list li a {
    color: #666;
    font-size: 24px;
    transition: color 0.3s;
    display: block;
    line-height: 1;
}

.share-icon-list li a svg {
    width: 32px;
    height: 32px;
    fill: currentColor;
    vertical-align: middle;
}

.share-icon-list li a:hover {
    color: #0073aa;
}

.entry-header {
    margin-bottom: 25px;
}

.post-meta-top {
    font-size: 0.85em;
    color: #666;
    margin-bottom: 5px;
    display: none;
}

.post-meta-center {
    color: var(--Color-Grey, #9E9E9E);
    font-family: Arial;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 110%;
    text-align: center;
    margin-bottom: 20px;
    display: block;
    text-align: left;
}

.post-meta-item {
    margin: 0 5px;
}

.entry-title {
    font-size: 48px;
    font-style: normal;
    font-weight: 500;
    line-height: 110%;
    letter-spacing: -0.48px;
    text-transform: capitalize;
    font-family: "Cormorant", serif;
    text-align: left;
}

.post-thumbnail img {
    width: 100%;
    height: auto;
    margin-bottom: 30px;
    display: block;
}

.entry-content {
    word-wrap: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
}

.entry-content p {
    margin-bottom: 1.5em;
    line-height: 1.7;
    word-break: break-word;
    overflow-wrap: break-word;
}

.entry-content img {
    max-width: 100%;
    height: auto;
}

.entry-content table {
    max-width: 100%;
    overflow-x: auto;
    display: block;
}

.entry-content iframe {
    max-width: 100%;
}

.recent-news-widget {
    background: #f9f9f9;
    padding: 20px;
    border: 1px solid #eee;
}

.widget-title {
    color: var(--Black, #22282B);
    font-size: 32px;
    font-style: normal;
    font-weight: 500;
    line-height: 110%;
    letter-spacing: -0.32px;
    text-transform: capitalize;
    padding-bottom: 10px;
    margin-bottom: 20px;
    font-weight: bold;
    text-align: left;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.recent-news-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.recent-news-list li {
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.recent-news-list li:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.recent-news-title {
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.recent-news-title a {
    color: var(--Black, #22282B);
    font-family: "Cormorant", serif;
    font-size: 22px;
    font-style: normal;
    font-weight: 500;
    line-height: 140%;
    text-decoration: none;
    display: block;
}

.recent-news-title a:hover {
    color: #0073aa;
}

.recent-news-block {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.post-date-small {
    color: var(--Color-Grey, #9E9E9E);
    font-family: Arial;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 110%;
    letter-spacing: 0.14px;
}

@media (max-width: 1024px) {
    .share-column {
        display: none;
    }

    .post-content-column {
        min-width: 70%;
    }

    .entry-title {
        text-align: left;
    }
}

@media (max-width: 768px) {
    .main-content-wrapper {
        flex-direction: column;
        gap: 20px;
    }

    .post-content-column,
    .widget-area {
        min-width: 100%;
        position: static;
    }

    .entry-title {
        font-size: 1.8em;
        text-align: left;
    }

    .recent-news-title a {
        font-size: 18px;
    }

    .post-meta-center {
        text-align: left;
        font-size: 14px;
    }
}
</style>

<div id="primary" class="content-area pageWidth">
    <main id="main">

        <div class="main-content-wrapper">

            <div class="share-column">
                <span class="share-label-side">Share</span>
                <ul class="share-icon-list">
                    <li>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="32" viewBox="0 0 33 32" fill="none">
								<path d="M23.4791 2.99999H9.49244C8.6998 2.99927 7.91487 3.15562 7.183 3.45999C6.45112 3.76437 5.78681 4.21074 5.22844 4.77333C4.67224 5.33411 4.23305 5.99986 3.93641 6.73186C3.63976 7.46387 3.49156 8.24754 3.50044 9.03733V22.9627C3.49082 23.7525 3.63867 24.5364 3.93537 25.2685C4.23206 26.0007 4.67164 26.6663 5.22844 27.2267C5.78666 27.7891 6.45075 28.2354 7.18238 28.5397C7.91401 28.8441 8.69869 29.0005 9.49111 29H15.8418V19.712H13.4151C13.2649 19.711 13.1211 19.651 13.0146 19.545C12.9081 19.4391 12.8475 19.2955 12.8458 19.1453V16.164C12.8456 16.0874 12.8606 16.0115 12.8899 15.9407C12.9192 15.8699 12.9623 15.8056 13.0166 15.7516C13.0709 15.6975 13.1354 15.6548 13.2063 15.6258C13.2772 15.5968 13.3532 15.5821 13.4298 15.5827H15.8418V12.676C15.7741 11.989 15.858 11.2956 16.0874 10.6446C16.3169 9.99352 16.6864 9.40074 17.1698 8.90799C17.6537 8.41301 18.2397 8.02953 18.887 7.78428C19.5343 7.53904 20.2274 7.43792 20.9178 7.48799H23.3898C23.4654 7.48851 23.5402 7.50399 23.6098 7.53354C23.6794 7.56309 23.7425 7.60612 23.7954 7.66015C23.8484 7.71419 23.8901 7.77816 23.9182 7.84839C23.9462 7.91861 23.9602 7.9937 23.9591 8.06933V10.5893C23.9591 10.6639 23.9444 10.7377 23.9157 10.8066C23.887 10.8754 23.845 10.9379 23.7921 10.9905C23.7392 11.043 23.6764 11.0846 23.6073 11.1128C23.5383 11.141 23.4643 11.1552 23.3898 11.1547H21.8924C20.2444 11.1547 19.9298 11.9307 19.9298 13.0627V15.568H23.5244C23.6055 15.5676 23.6857 15.5844 23.7597 15.6174C23.8337 15.6504 23.8998 15.6988 23.9537 15.7594C24.0076 15.8199 24.0479 15.8912 24.0721 15.9686C24.0962 16.0459 24.1036 16.1276 24.0938 16.208L23.7338 19.1907C23.7192 19.3309 23.6527 19.4606 23.5473 19.5544C23.442 19.6481 23.3054 19.6991 23.1644 19.6973H19.9444V28.9853H23.5098C24.3022 28.9859 25.0869 28.8294 25.8185 28.5251C26.5501 28.2207 27.2142 27.7744 27.7724 27.212C28.3288 26.6511 28.7681 25.9851 29.0647 25.2528C29.3614 24.5206 29.5095 23.7367 29.5004 22.9467V9.03733C29.5108 8.2448 29.3623 7.45822 29.0637 6.72403C28.7651 5.98985 28.3224 5.32293 27.7618 4.76266C27.2003 4.19976 26.5326 3.75407 25.7974 3.45147C25.0622 3.14887 24.2741 2.9954 23.4791 2.99999Z" fill="#A67131" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" aria-label="Share on Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="32" viewBox="0 0 33 32" fill="none">
								<path d="M16.5 11.34C13.92 11.34 11.84 13.44 11.84 16C11.84 18.56 13.94 20.66 16.5 20.66C19.06 20.66 21.16 18.56 21.16 16C21.16 13.44 19.06 11.34 16.5 11.34ZM30.5 16C30.5 14.06 30.5 12.16 30.4 10.22C30.3 7.98 29.78 5.98 28.14 4.36C26.5 2.72 24.52 2.2 22.28 2.1C20.34 2 18.44 2 16.5 2C14.56 2 12.66 2 10.72 2.1C8.48 2.2 6.48 2.72 4.86 4.36C3.22 6 2.7 7.98 2.6 10.22C2.5 12.16 2.5 14.06 2.5 16C2.5 17.94 2.5 19.84 2.6 21.78C2.7 24.02 3.22 26.02 4.86 27.64C6.5 29.28 8.48 29.8 10.72 29.9C12.66 30 14.56 30 16.5 30C18.44 30 20.34 30 22.28 29.9C24.52 29.8 26.52 29.28 28.14 27.64C29.78 26 30.3 24.02 30.4 21.78C30.52 19.86 30.5 17.94 30.5 16ZM16.5 23.18C12.52 23.18 9.32 19.98 9.32 16C9.32 12.02 12.52 8.82 16.5 8.82C20.48 8.82 23.68 12.02 23.68 16C23.68 19.98 20.48 23.18 16.5 23.18ZM23.98 10.2C23.06 10.2 22.3 9.46 22.3 8.52C22.3 7.58 23.04 6.84 23.98 6.84C24.92 6.84 25.66 7.58 25.66 8.52C25.6651 8.73907 25.6251 8.95685 25.5425 9.15983C25.4599 9.36281 25.3365 9.54667 25.18 9.7C25.0267 9.85655 24.8428 9.97993 24.6398 10.0625C24.4368 10.1451 24.2191 10.1851 24 10.18L23.98 10.2Z" fill="#A67131" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="post-content-column">
                <?php
                while (have_posts()) :
                    the_post();
                ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php
                            $category = get_the_category();
                            $category_name = !empty($category) ? esc_html($category[0]->name) : 'Uncategorized';
                            $read_time_words = str_word_count(strip_tags(get_the_content()));
                            $read_time = ceil($read_time_words / 200);
                            $post_date = get_the_date('F Y');
                            ?>
                            <div class="post-meta-center">
                                <span class="post-meta-item category-name"><?php echo $category_name; ?></span>
                                <span class="post-meta-item">&bull;</span>
                                <span class="post-meta-item read-time"><?php echo $read_time; ?> min read</span>
                                <span class="post-meta-item">&bull;</span>
                                <span class="post-meta-item post-date"><?php echo $post_date; ?></span>
                            </div>
                            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        </header>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </article>
                <?php
                endwhile;
                ?>
            </div>

            <aside id="secondary" class="widget-area">
                <div class="recent-news-widget">
                    <h2 class="widget-title">Recent News</h2>
                    <ul class="recent-news-list">
                        <?php
                        $current_post_id = get_the_ID();
                        $news_query = new WP_Query(array(
                            'post_type'      => 'post',
                            'posts_per_page' => 5,
                            'post__not_in'   => array($current_post_id),
                        ));

                        if ($news_query->have_posts()) :
                            while ($news_query->have_posts()) : $news_query->the_post();
                        ?>
                                <li class="recent-news-block">
                                    <h3 class="recent-news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <p class="post-date-small"><?php echo get_the_date('d F Y'); ?></p>
                                </li>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            ?>
                            <li>No recent news found.</li>
                        <?php
                        endif;
                        ?>
                    </ul>
                </div>
            </aside>
        </div>

    </main>
</div>

<?php
get_footer();