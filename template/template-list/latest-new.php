<?php

/**
 * The template content
 * Post type : post (default)
 * Page : List
 * URL : /news/
 * Shortcode : [GET_LIST posts_per_page="6" template="/template-list/latest-new.php" post_type="posts" taxonomy="categorise" pagination="false" ]
 **/
?>

<?php
if ($getlist_posts->have_posts()) {
    while ($getlist_posts->have_posts()) {
        $getlist_posts->the_post();
        $post_id = get_the_ID();
        $feature_new = get_post_meta($post_id, 'feature_new', true);
        $thumb_img = get_the_post_thumbnail_url();
        if ($feature_new == true) {
?>
            <div class="blog-item ">
                <div class="info my-lg-4 my-1 mx-lg-3 mx-2">
                    
                        <?php if ($thumb_img) : ?>
                            <div class="image-wrapper position-relative h-100 w-100 d-inline-block rounded effect_img">
                                <div class="image-overlay post-image position-absolute w-100 h-300px z-0" style="background-image: url('<?php echo $thumb_img; ?>');"></div>
                                <a href="<?php the_permalink(); ?>">
                                <img class="image-tab w-100 h-300px position-relative rounded d-block z-1" src="<?php echo $thumb_img; ?>" alt="<?php echo esc_html(get_the_post_thumbnail_caption()); ?>">
                                </a>
                            </div>
                        <?php else : ?>
                            <div class="square rounded post-image mb-2"></div>
                        <?php endif; ?>
                    
                    <div class="mb-1 fs-14"><span><?php echo get_the_date('d/m/Y'); ?></span></div>
                    <div class="name mb-1 fw-bold fs-18"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></div>
                    <?php $tags = get_the_terms($post_id, 'post_tag'); ?>
                    <?php if ($tags && !is_wp_error($tags)) : ?>
                        <div class="mb-1 d-flex flex-wrap align-items-center gap-1">
                            <?php foreach ($tags as $tag) :
                                $tag_link = get_term_link($tag);
                                if (!is_wp_error($tag_link)) : ?>
                                    <a href="<?php echo esc_url($tag_link); ?>" class="mb-0 pt-3px pb-5px px-1 bg-red-light text-white fs-14 rounded lh-1">
                                        <?php echo esc_html($tag->name); ?>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
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