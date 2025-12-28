<?php
function load_blog_by_category() {
    // Check and sanitize the AJAX request
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : 'all';

    // Prepare WP Query
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
    );

    if ($category !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $category,
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post(); ?>
            <?php 
            $url_image = get_the_post_thumbnail_url(); 
            $post_id = get_the_ID();
            $short_description = get_field('short_description', $post_id);
            ?>
           
            <div class="grid-item col-12 col-lg-4 my-lg-2 my-1">
                <?php if ($url_image) { ?>
                    <div class="image-wrapper position-relative h-300px w-100 d-inline-block  effect_img rounded">
                        <a href="<?php the_permalink(); ?>">
                            <img class="image-tab rounded w-100 h-300px position-relative d-block object-cover" src="<?php echo esc_url($url_image); ?>" alt="thumb-image">
                        </a>
                    </div>
                <?php } else { ?>
                    <div class="square no-shadow rounded mb-1"></div>
                <?php } ?>

                <div class="date"><span class="mb-1 fs-14"><?php echo get_the_date('d/m/Y'); ?></span></div>
                <div class="name">
                    <h2 class="fw-bold fs-18 text-black mb-1"><a href="<?php the_permalink(); ?>" class="text-black"><?php the_title(); ?></a></h2>
                </div>
                <div>
                    <p class="fs-16 mb-1">
                        <?php echo wp_trim_words ($short_description, 20, '...'); ?>
                    </p>
                </div>
                <?php
                $tags = get_the_terms(get_the_ID(), 'post_tag');
                if ($tags && !is_wp_error($tags)) {
                    echo '<div class="mb-1 d-flex flex-wrap align-items-center gap-1">';
                    foreach ($tags as $tag) {
                        echo '<a href="' . esc_url(get_term_link($tag)) . '" class="mb-0 pt-3px pb-5px px-1 bg-red-light text-white fs-14 rounded lh-1">' . esc_html($tag->name) . '</a>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
        <?php endwhile;
        wp_reset_postdata();
    } else {
        echo '<p>No posts found in this category.</p>';
    }

    wp_die();
}
add_action('wp_ajax_load_blog_by_category', 'load_blog_by_category');
add_action('wp_ajax_nopriv_load_blog_by_category', 'load_blog_by_category');
?>
