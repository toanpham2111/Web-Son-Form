<?php

/**
 * The template for displaying a single post
 */
get_header(); ?>

<div class="container mb-5">
    <div class="full-width bg-red banner  pt-4 pb-4 h-400px d-flex align-items-center flex-wrap pt-lg-150px pb-lg-55px">
        <div class="container text-center text-white">

        </div>
    </div>
    <div class="row">
        <div class="post-content col-12 col-lg-8">
            <div class="breadcrumbs fs-16 mt-3 mb-1" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if (function_exists('bcn_display')) {
                    bcn_display();
                } ?>
            </div>
            <div>
                <h1 class="fs-1 mb-1"><?php the_title(); ?></h1>
                <div class="date fs-16 text-gray-600">
                    <span class="fw-bold text-capitalize text-red"><?php echo get_the_author(); ?></span>
                    <span> Cập nhập:<?php echo get_the_date('d/m/Y'); ?> </span>
                </div>
                <?php $tham_dinh_chuyen_mon = get_field('tham_dinh_chuyen_mon'); ?>
                <div class="tham-dinh mb-1 fs-16 text-gray-600">
                    <span>Thẩm định chuyên môn </span>
                    <span class="fw-bold text-uppercase text-red"><?php echo $tham_dinh_chuyen_mon ? $tham_dinh_chuyen_mon : 'LAB84'; ?></span>
                </div>
            </div>
            <div>
                <?php $gallery_projects = get_field('gallery_projects'); ?>
                <?php if (!empty($gallery_projects) && is_array($gallery_projects)) : ?>
                    <div class="gallery d-block mt-3 mb-2 overflow-hidden position-relative">
                        <!-- Ảnh lớn đầu tiên -->
                        <div class="large-image">
                            <a href="<?php echo esc_url($gallery_projects[0]['url']); ?>"
                                data-fancybox="gallery"
                                data-caption="<?php echo esc_attr($gallery_projects[0]['alt']); ?>">
                                <img class="w-100 h-lg-500px h-350px d-block object-cover"
                                    src="<?php echo esc_url($gallery_projects[0]['url']); ?>"
                                    alt="<?php echo esc_attr($gallery_projects[0]['alt']); ?>">
                            </a>
                        </div>
                        <!-- Thumbnail (bỏ ảnh đầu tiên) -->
                        <div class="d-flex w-100 flex-wrap align-items-center <?php echo count($gallery_projects) <= 5 ? 'justify-content-start' : 'justify-content-between'; ?>">
                            <?php
                            // Hiển thị tối đa 4 ảnh sau ảnh đầu tiên
                            $thumbnails_to_show = array_slice($gallery_projects, 1, 4);
                            foreach ($thumbnails_to_show as $key => $image) : ?>
                                <div class="thumbnail position-relative w-xl-150px w-70px w-md-120px me-1 mt-1">
                                    <a href="<?php echo esc_url($image['url']); ?>"
                                        data-fancybox="gallery"
                                        data-caption="<?php echo esc_attr($image['alt']); ?>">
                                        <img class="thumbnail-image object-cover"
                                            src="<?php echo esc_url($image['sizes']['thumbnail']); ?>"
                                            alt="<?php echo esc_attr($image['alt']); ?>">
                                    </a>
                                </div>
                            <?php endforeach; ?>

                            <!-- Hiển thị "thêm +..." nếu số ảnh lớn hơn 5 -->
                            <?php if (count($gallery_projects) > 5) : ?>
                                <div class="thumbnail position-relative w-xl-150px w-70px w-md-120px mt-1">
                                    <a href="<?php echo esc_url($gallery_projects[5]['url']); ?>"
                                        data-fancybox="gallery"
                                        data-caption="<?php echo esc_attr($gallery_projects[5]['alt']); ?>">
                                        <img class="thumbnail-image object-cover"
                                            src="<?php echo esc_url($gallery_projects[5]['sizes']['thumbnail']); ?>"
                                            alt="<?php echo esc_attr($gallery_projects[5]['alt']); ?>">
                                        <div class="overlay bg-rgba-6 d-flex align-items-center justify-content-center text-decoration-none">
                                            <span class="position-absolute start-50 top-50 translate-middle fs-16 fs-lg-18 text-white fw-bold">
                                                +<?php echo count($gallery_projects) - 5; ?>
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- Hidden thumbnails để FancyBox biết về tất cả ảnh -->
                        <?php foreach (array_slice($gallery_projects, 6) as $hidden_image) : ?>
                            <a href="<?php echo esc_url($hidden_image['url']); ?>"
                                data-fancybox="gallery"
                                data-caption="<?php echo esc_attr($hidden_image['alt']); ?>"
                                class="d-none">
                                <img src="<?php echo esc_url($hidden_image['sizes']['thumbnail']); ?>"
                                    alt="<?php echo esc_attr($hidden_image['alt']); ?>">
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>


            </div>
            <div class="project-info">
                <?php
                $post_id = get_the_ID();
                $projects_infomation = get_field('projects_infomation', $post_id);
                ?>
                <?php if (!empty($projects_infomation) && is_array($projects_infomation)) : ?>
                    <?php foreach ($projects_infomation as $key => $value) :  ?>
                        <div class="info d-flex fs-16 ">
                            <div class="info-label me-1 fs-16">
                                <span class="fw-bold text-red"><?php echo $value['title_infomation']; ?></span>
                            </div>
                            <div class="info-value fs-16"><?php echo $value['content_infomation']; ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="post-body py-lg-3 py-2 px-0 px-lg-0 fs-lg-18 fs-16">
                <?php the_content(); ?>
            </div>
        </div>
        <div class="col-12 col-lg-4 px-lg-5 px-0">
            <div class="sidebar popular-news container">
                <?php
                $terms = get_the_terms($post->ID, 'categories_projects');

                if ($terms) {
                    $term_ids = array();

                    foreach ($terms as $term) {
                        $term_ids[] = $term->term_id;
                    }
                    $args = array(
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'categories_projects',
                                'field'    => 'term_id',
                                'terms'    => $term_ids,
                                'operator' => 'IN',
                            ),
                        ),
                        'post__not_in' => array($post->ID),
                        'posts_per_page' => 2,
                        'meta_key' => 'post_views_count',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                        'ignore_sticky_posts' => 1,
                    );

                    $popular_posts = new WP_Query($args);

                    if ($popular_posts->have_posts()) : ?>
                        <div class="popular-news-section mt-lg-5 mt-3 mb-1">
                            <h3 class="fw-bold fs-24">Dự án <br> Xem Nhiều Nhất</h3>
                            <div class="popular-news-items">
                                <?php while ($popular_posts->have_posts()) : $popular_posts->the_post(); ?>
                                    <div class="popular-news-item mb-3">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="popular-news-thumbnail position-relative effect_img rounded">
                                                <a href="<?php the_permalink(); ?>">
                                                    <img class="image-tab w-100 rounded h-130px position-relative object-cover d-block"
                                                        src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>"
                                                        alt="<?php echo esc_attr(get_the_post_thumbnail_caption()); ?>">
                                                </a>
                                            </div>
                                        <?php else : ?>
                                            <div class="square no-shadow popular-post rounded mb-2"></div>
                                        <?php endif; ?>

                                        <div class="popular-news-info">
                                            <span class="popular-news-date fs-16"><?php echo get_the_date("d/m/Y"); ?></span>
                                            <h4 class="popular-news-title fs-18 mb-1">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h4>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                <?php endif;
                    wp_reset_postdata();
                }
                ?>
            </div>
            <div class="sidebar project-related container">
                <?php
                $terms = get_the_terms($post->ID, 'categories_projects');

                if ($terms) {
                    $term_ids = array();

                    foreach ($terms as $term) {
                        $term_ids[] = $term->term_id;
                    }

                    $args = array(
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'categories_projects',
                                'field'    => 'term_id',
                                'terms'    => $term_ids,
                                'operator' => 'IN',
                            ),
                        ),
                        'post__not_in' => array($post->ID),
                        'posts_per_page' => 2,
                        'order' => 'ASC',
                        'ignore_sticky_posts' => 1,
                    );

                    $related_posts = new WP_Query($args);

                    if ($related_posts->have_posts()) : ?>
                        <div class="related-news-section mt-lg-5  mt-3 mb-1">
                            <h3 class="fw-bold fs-24">Dự Án Liên Quan</h3>
                            <div class="related-news-items">
                                <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                                    <?php $thumb_img = get_the_post_thumbnail_url(); ?>
                                    <div class="related-news-item mb-3">

                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="related-news-thumbnail position-relative effect_img rounded">
                                                <a href="<?php the_permalink(); ?>">
                                                    <img class="image-tab w-100 rounded h-130px position-relative object-cover d-block" src="<?php echo $thumb_img; ?>" alt="<?php echo esc_html(get_the_post_thumbnail_caption()); ?>">
                                                </a>
                                            </div>
                                        <?php else : ?>
                                            <div class="square no-shadow related-post rounded mb-2"></div>
                                        <?php endif; ?>

                                        <div class="related-news-info">
                                            <span class="related-news-date fs-16"><?php echo get_the_date("d/m/Y"); ?></span>
                                            <h4 class="related-news-title fs-18"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        </div>

                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                <?php endif;
                    wp_reset_postdata();
                }
                ?>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    #menu-item-442>a {
        color: #fff;
    }

    #menu-item-442>a:before {
        width: 100%;
    }

    header.fixed #menu-item-442>a {
        color: #dd4a55;
    }

    body.menu-open .main_menu #menu-item-442>a {
        color: #dd4a55;
    }
</style>
<?php get_footer(); ?>