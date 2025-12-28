<?php

/**
 * The template content
 * Post type : post (default)
 * Page : List
 * URL : /news/
 * Shortcode : [GET_LIST posts_per_page="6" template="/template-list/projects-slider.php" post_type="projects" taxonomy="projects-category" pagination="false" ]
 **/
?>

<?php
if ($getlist_posts->have_posts()) {
    while ($getlist_posts->have_posts()) {
        $getlist_posts->the_post();
        $post_id = get_the_ID();
        // $feature_projects = get_post_meta($post_id, 'feature_projects', true);
        $feature_projects = get_field('feature_projects', $post_id);
        $images_slider_home = get_field('images_slider_home', $post_id);
        if ($feature_projects == true) {
?>
 <?php        var_dump($feature_projects);?>
            <div class="project-slide position-relative">
                <div class="position-relative w-100 h-400px">
                    <div class="overlay bg-rgba-1 z-3 h-400px"></div>
                    <!-- Background Blur -->
                    <!-- <div class="background-blur w-100 h-100 position-absolute"
                        style="background-image: url('<?php echo $images_slider_home ? $images_slider_home['url'] : get_the_post_thumbnail_url($post_id, 'full'); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat; filter: blur(5px);">
                    </div> -->
                    <!-- Project Image without Blur -->
                    <img class="project-image w-100 h-400px rounded-20px object-cover"
                        src="<?php echo $images_slider_home ? $images_slider_home['url'] : get_the_post_thumbnail_url($post_id, 'full'); ?>"
                        alt="<?php echo get_the_title(); ?>">
                </div>
                <h3 class="project-info position-absolute top-25 start-20 fs-45 text-white z-4">
                    <a class="text-white" href="<?php the_permalink($post_id); ?>"><?php echo get_the_title(); ?></a>
                </h3>
                <p class="project-info position-absolute bottom-48 start-20 fs-16 text-white z-4"><?php echo get_the_excerpt(); ?></p>
                <a href="<?php echo get_permalink($post_id); ?>"
                    class="view-project-btn position-absolute bottom-35 z-4 start-20 py-1 px-3 fs-16 border border-1 border-white bg-rgba-6 text-white button-slider rounded">View
                    Project</a>
                <!-- Slider Controls -->
                <div class="slider-controls position-absolute bottom-50px start-20 z-4">
                    <button type="button" class="slick-prev start-0"></button>
                    <button type="button" class="slick-next end-n110px"></button>
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
