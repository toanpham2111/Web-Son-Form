<?php
get_header(); // Include header template part
?>
<div class="banner full-width h-lg-500px h-300px bg-red">
    <div class="h-lg-500px h-300px w-100 position-relative">
        <div class="content position-absolute top-50 start-50 translate-middle z-1 w-100 text-center">
            <h1 class="fs-lg-78 fs-55 text-white my-2"><?php single_cat_title(); ?></h1>
        </div>
    </div>
</div>
<div class="container my-lg-5 my-2 ">
    <?php if (have_posts()) : ?>
        <div class="blog-grid row">
            <?php
            while (have_posts()) : the_post();
            ?>
                <div class="blog-post-item col-12 col-lg-4 my-3">   
                        <?php
                        if (get_the_post_thumbnail_url()) {
                            echo ' <div class="image-wrapper position-relative h-300px w-100 d-inline-block rounded effect_img">
                            <a href="' . get_the_permalink() . '">
                            <img class="image-tab w-100 h-300px rounded position-relative d-block z-1 object-cover" src="' . get_the_post_thumbnail_url() . '" alt="thumb-image-blog">
                            </a>
                            </div>';
                        } else {
                            echo '<div class="square rounded no-shadow"></div>';
                        }
                        ?>
                    <div class="post-info mt-1">
                        <span class="post-date mb-1 fs-14"><?php echo get_the_date('d/m/Y'); ?></span>
                        <h2 class="post-title mb-1 fs-18"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p><?php esc_html_e('No posts found.'); ?></p>
        <?php endif; ?>
        </div>
        <style type="text/css">
            #menu-item-441>a {
                color: #fff;
            }

            #menu-item-441>a:before {
                width: 100%;
            }

            header.fixed #menu-item-441>a {
                color: #dd4a55;
            }

            body.menu-open .main_menu #menu-item-441>a {
                color: #dd4a55;
            }
        </style>

        <?php get_footer(); ?>