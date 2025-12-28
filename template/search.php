<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main search_main">
    <div class="banner full-width h-300px">
      <div class="h-300px position-relative"
        style="background:#dd4a55;">
        <div class="overlay"></div>
        <div class="content position-absolute top-50 start-50 translate-middle z-1 w-100 text-center">
          <h1 class="fs-lg-78 fs-55 text-white my-2 ">Search</h1>
        </div>
      </div>
    </div>
    <?php
    $s = get_search_query();
    $args = array(
      's' => $s,
      'taxonomy' => array('category', 'tags_projects', 'categories_projects', 'categories_blog', 'tags_blog'),
      'orderby' => 'date',
      'order' => 'ASC',
    );
    // The Query
    $the_query = new WP_Query($args);
    ?>
    <div class="container my-lg-5 my-2">
      <?php if ($the_query->have_posts()) : ?>
        <p class="text-red fs-2 mb-2 border-bottom border-red pb-2 fw-bold"><?php echo $the_query->found_posts; ?> kết quả cho từ khóa: "<?php echo get_query_var('s') ?>"</p>
        <div class="search_main_list row my-3">
          <?php while ($the_query->have_posts()) : ?>
            <?php $the_query->the_post(); ?>
            <div class="pb-2 mb-2 col-12 col-lg-4">
              <?php
              $taxonomies = get_queried_object(get_the_ID());
              $thumb_img = get_the_post_thumbnail_url();

              if (!empty($taxonomy_names)) :
                foreach ($taxonomy_names as $tax_name) : ?>
                  <p><?php echo $tax_name; ?> </p>
              <?php endforeach;
              endif;
              ?>
              <a href="<?php the_permalink(); ?>">
                <?php if ($thumb_img) : ?>
                  <div class="image-wrapper position-relative h-300px w-100 d-inline-block rounded effect_img">
                    <img class="image-tab w-100 rounded h-300px position-relative d-block z-1" src="<?php echo $thumb_img; ?>" alt="<?php echo esc_html(get_the_post_thumbnail_caption()); ?>">
                  </div>
                <?php else : ?>
                  <div class="square rounded no-shadow mb-2"></div>
                <?php endif; ?>
              </a>
              <div class="post-info">
                <span class="post-date mb-1 fs-14"><?php echo get_the_date('d/m/Y'); ?></span>
                <h2 class="post-title mb-1 fs-18"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php
                $taxonomies = ['post_tag', 'tags_blog', 'tags_projects'];
                $tags = get_the_terms($post_id, $taxonomies);
                ?>
                <?php if ($tags && !is_wp_error($tags)) : ?>
                  <div class="my-1 my-lg-2 d-flex flex-wrap align-items-center gap-1">
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
        </div>
      <?php else : ?>

        <h3>Không tìm thấy kết quả.</h3>
      <?php endif; ?>
    </div>
  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>