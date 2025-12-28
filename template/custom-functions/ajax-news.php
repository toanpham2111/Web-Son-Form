<?php
function load_more_news_posts()
{
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 3;

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $posts_per_page,
        'offset' => $offset,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $post_id = get_the_ID();
            $short_description= get_field('short_description' , $post_id);
?>
            <div class="col-12 col-md-6 col-lg-4 mb-lg-3 mb-1">
                <div class="item h-100">
                    <div class="news-thumbnail my-1">

                        <?php if (get_the_post_thumbnail_url()) { ?>
                            <div class="image-wrapper position-relative h-100 w-100 d-inline-block rounded effect_img">
                                <a href="<?php echo get_the_permalink(); ?>">
                                    <img class="image-tab rounded w-100 h-300px position-relative d-block z-1" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="thumb-image-blog">
                                </a>
                            </div>
                        <?php } else { ?>
                            <div class="square no-shadow rounded"></div>
                        <?php } ?>

                    </div>
                    <div class="txt">
                        <p class="mb-1 fs-14"><?php echo get_the_date('F j, Y'); ?></p>
                        <h3 class="mb-1 fs-18"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                        <p><?php echo wp_trim_words($short_description, 20, '...'); ?></p>
                        <?php
                        $tags = get_the_terms($post_id, 'post_tag');
                        if ($tags && !is_wp_error($tags)) {
                            echo '<div class="my-1 d-flex flex-wrap align-items-center gap-1">';
                            foreach ($tags as $tag) {
                                echo '<a href="' . get_term_link($tag) . '" class="mb-0 pt-3px pb-5px px-1 bg-red-light text-white fs-14 rounded lh-1">' . $tag->name . '</a>';
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
<?php
        endwhile;
        wp_reset_postdata();
    else :
        echo 'No more posts';
    endif;

    wp_die();
}
add_action('wp_ajax_load_more_news_posts', 'load_more_news_posts');
add_action('wp_ajax_nopriv_load_more_news_posts', 'load_more_news_posts');
?>