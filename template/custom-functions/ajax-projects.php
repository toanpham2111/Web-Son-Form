<?php

function load_projects_by_category()
{
    $category = $_POST['category'];

    // Prepare WP Query
    $args = array(
        'post_type' => 'projects',
        'posts_per_page' => -1,
    );

    if ($category != 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'categories_projects',
                'field' => 'slug',
                'terms' => $category,
            ),
        );
    }
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post(); ?>
            <?php $url_image = get_the_post_thumbnail_url();
            $post_id = get_the_ID();
            ?>
            <div class="grid-item col-12 col-lg-4 my-lg-2 my-1">

                <?php if ($url_image) { ?>
                    <div class="image-wrapper position-relative h-300px w-100 d-inline-block effect_img rounded  ">
                        <a href="<?php the_permalink(); ?>">
                            <img class="image-tab rounded w-100 h-300px position-relative d-block object-cover" src="<?php the_post_thumbnail_url(); ?>" alt="thumb-image">
                        </a>
                    </div>
                <?php } else { ?>
                    <div class="square no-shadow rounded mb-1"></div>
                <?php } ?>

                <div class="date"><span class="mb-1 fs-14"><?php echo get_the_date('d/m/Y'); ?></span></div>
                <div class="name ">
                    <h2 class="fw-bold fs-18 mb-1 text-black "> <a href="<?php the_permalink(); ?>" class="text-black"><?php the_title(); ?></a></h2>
                </div>
                <?php
                $tags = get_the_terms($post_id, 'tags_projects');
                if ($tags && !is_wp_error($tags)) {
                    echo '<div class="mb-1 d-flex flex-wrap align-items-center gap-1">';
                    foreach ($tags as $tag) {
                        echo '<a href="' . get_term_link($tag) . '" class="mb-0 pt-3px pb-5px px-1 bg-red-light text-white fs-14 rounded lh-1">' . $tag->name . '</a>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
<?php endwhile;
        wp_reset_postdata();
    } else {
        echo '<p>No projects found in this category.</p>';
    }

    wp_die();
}
add_action('wp_ajax_load_projects_by_category', 'load_projects_by_category');
add_action('wp_ajax_nopriv_load_projects_by_category', 'load_projects_by_category');



?>