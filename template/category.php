<?php
get_header(); // Include header template part
?>
<div class="banner full-width h-lg-500px h-300px bg-red">
    <div class="h-lg-500px h-300px w-100 position-relative">
        <div class="content position-absolute top-50 start-50 translate-middle z-1 w-100 text-center">
            <h1 class="fs-lg-78 fs-55 text-white my-2 "><?php single_cat_title(); ?></h1>
        </div>
    </div>
</div>
<div class="container my-lg-5 my-2 ">
    <?php if (have_posts()) : ?>
        <div class="blog-grid row">
            <?php
            // Start the Loop
            while (have_posts()) : the_post();
            ?>
                <div class="blog-post-item col-12 col-lg-4 my-3">
                        <?php

                        if (get_the_post_thumbnail_url()) {
                            echo ' <div class="image-wrapper position-relative h-300px w-100 d-inline-block rounded effect_img">
                            <a href="' . get_the_permalink() . '">
                            <img class="image-tab w-100 rounded h-300px position-relative d-block z-1" src="' . get_the_post_thumbnail_url() . '" alt="thumb-image-blog">
                            </a>
                            </div>';
                        } else {
                            echo '<div class="square rounded no-shadow"></div>';
                        }
                        ?>
                    <div class="post-info mt-1">
                        <span class="post-date fs-14 mb-1"><?php echo get_the_date('d/m/Y'); ?></span>
                        <h2 class="post-title fs-18 mb-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <?php if ($tags && !is_wp_error($tags)) : ?>
                            <div class="my-1 d-flex flex-wrap align-items-center gap-1">
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
            <?php endwhile; ?>
        <?php else : ?>
            <p><?php esc_html_e('No posts found.'); ?></p>
        <?php endif; ?>
        </div>
        
        <?php get_footer(); ?>