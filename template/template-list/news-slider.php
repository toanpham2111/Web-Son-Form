<?php

/**
 * The template content
 * Post type : post (default)
 * Page : List
 * URL : /news/
 * Shortcode : [GET_LIST posts_per_page="6" template="/template-list/blog-slider-2.php" post_type="blog" taxonomy="blog-category" pagination="false" ]
 **/
?>

<?php
if ($getlist_posts->have_posts()) {
    while ($getlist_posts->have_posts()) {
        $getlist_posts->the_post();
        $post_id = get_the_ID();
        $feature_news = get_post_meta($post_id, 'feature_new', true);
        $images_banner_slider = get_field('images_banner_slider', $post_id);

        if ($feature_news == true) {
?>
            <div class="news-slide position-relative">
                <div class="position-relative w-100 h-400px">
                    <div class="overlay bg-rgba-3 "></div>
                    <a href="<?php the_permalink(); ?>">
                        <?php if (get_the_post_thumbnail_url()): ?>
                            <img class="blog-image w-100 h-400px object-cover"
                                src="<?php echo $images_banner_slider ? $images_banner_slider['url'] :  get_the_post_thumbnail_url($post_id, 'full'); ?>"
                                alt="<?php echo get_the_title(); ?>">
                        <?php else: ?>
                            <div class="h-400px position-relative" style="background: #dd4a55;"></div>
                        <?php endif; ?>
                    </a>
                    <div class="overlay position-absolute w-lg-30 w-40 h-100"></div>
                </div>
                <div class="news-info position-absolute top-lg-25 top-25 end-lg-0 end-15 fs-45 text-white z-1 w-lg-40 me-lg-5 ms-5 ms-lg-0">
                    <div class="d-flex">
                        <h3 class="fs-45 mb-0 text-white"><a class="text-white" href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                        <div class="line-title"></div>
                    </div>
                    <p class="date-tag mb-0 pb-1 fs-16 fs-lg-18">
                        <?php echo get_the_date('d/m/Y'); ?>

                        <?php
                        $tags = get_the_terms($post_id, 'post_tag');
                        if ($tags && !is_wp_error($tags)) {
                            $tags_list = array();
                            foreach ($tags as $tag) {
                                $tags_list[] = $tag->name;
                            }
                            echo "/ ";
                            echo implode(', ', $tags_list);
                        }
                        ?>
                    </p>
                    <p class="title fs-18 mb-0 fw-bold ">Information:</p>
                    <div class="des fs-16 text-white "><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></div>
                </div>
                <!-- Slider Controls -->
                <div class="slider-controls position-absolute top-lg-n65 end-lg-15 end-25 bottom-50px">
                    <button type="button" class="slick-prev start-0"></button>
                    <button type="button" class="slick-next end-n90px"></button>
                </div>
            </div>
<?php
        }
    }
    wp_reset_postdata();
} else {
    echo 'No Item';
}
?>