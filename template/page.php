<?php get_header(); ?>

<main role="main" aria-label="Content">
    <!-- section -->
    <section>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <!-- article -->
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="pt-lg-3 pt-2 pb-4">
                    <div class="full-width bg-primary banner pt-lg-6 pt-4 pb-4 h-400px d-flex align-items-center flex-wrap pb-lg-100px">
                        <div class="container text-center text-white">
                            <div class="breadcrumbs text-white fs-19" typeof="BreadcrumbList" vocab="https://schema.org/">
                                <?php if (function_exists('bcn_display')) {
                                    bcn_display();
                                } ?>
                            </div>
                            <h1 class="text-white fs-1 my-2"><?php the_title(); ?></h1>
                            <p class="mb-1">Last Updated: <?php the_modified_date('F j, Y'); ?></p>
                            <p>By: <span class="text-black text-capitalize""><?php the_author(); ?></span></p>
                        </div>
                    </div>
                    <div class="container py-4 px-3 px-lg-0">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="featured-image py-3 text-center">
                                <?php the_post_thumbnail(); ?>
                            </div>
                        <?php endif; ?>

                        <?php the_content(); ?>
                    </div>
                </div>

            </article>
            <!-- /article -->

        <?php endwhile; ?>

        <?php else : ?>

            <!-- article -->
            <article>
                <h2><?php _e('Sorry, nothing to display.', 'html5blank'); ?></h2>
            </article>
            <!-- /article -->

        <?php endif; ?>
    </section>
    <!-- /section -->
</main>

<?php get_footer(); ?>
