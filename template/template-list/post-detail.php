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
		<div class="post-content col-12 col-lg-8 ">
			<div class="breadcrumbs fs-16 mt-3 mb-1" typeof="BreadcrumbList" vocab="https://schema.org/">
				<?php if (function_exists('bcn_display')) {
					bcn_display();
				} ?>
			</div>
			<h1 class="fs-1 mb-1"><?php the_title(); ?></h1>
			<div class="date fs-16 text-gray-600"><span class="fw-bold text-capitalize text-red"><?php echo get_the_author(); ?></span> Cập nhập:<?php echo get_the_date('d/m/Y'); ?> </div>
			<?php $tham_dinh_chuyen_mon = get_field('tham_dinh_chuyen_mon'); ?>
			<div class="tham-dinh mb-1 fs-16 text-gray-600"> Thẩm định chuyên môn <span class="fw-bold text-uppercase text-red"><?php echo $tham_dinh_chuyen_mon ? $tham_dinh_chuyen_mon : 'LAB84'; ?></span></div>
			<!-- <div class="project-info">
				<?php
				$post_id = get_the_ID();
				$news_infomation = get_field('new_infomation', $post_id);
				?>
				<?php if ($news_infomation): ?>
					<?php foreach ($news_infomation as $key => $value) :  ?>
						<div class="info d-flex align-items-center fs-16">
							<div class="info-label me-1 fs-16"><span class="fw-bold text-red"><?php echo $value['title_infomation']; ?></span> </div>
							<div class="info-value fs-16"><?php echo ($value['content_infomation']); ?></div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div> -->
			<div class="post-body py-lg-3 py-2 px-0 px-lg-0 fs-lg-18 fs-16">
				<?php the_content(); ?>
			</div>
		</div>
		<div class="col-12 col-lg-4 px-lg-5 px-0">
			<div class="sidebar popular-news container">
				<?php
				$terms = get_the_terms($post->ID, 'category');

				if ($terms) {
					$term_ids = array();

					foreach ($terms as $term) {
						$term_ids[] = $term->term_id;
					}

					$args = array(
						'tax_query' => array(
							array(
								'taxonomy' => 'category',
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
							<h3 class="fw-bold fs-24">Bài Viết <br> Xem Nhiều Nhất</h3>
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
				$terms = get_the_terms($post->ID, 'category');

				if ($terms) {
					$term_ids = array();

					foreach ($terms as $term) {
						$term_ids[] = $term->term_id;
					}

					$args = array(
						'tax_query' => array(
							array(
								'taxonomy' => 'category',
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
						<div class="related-news-section mt-lg-5 mt-3 mb-1">
							<h3 class="fw-bold fs-24">Bài Viết Liên Quan</h3>
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
	#menu-item-440>a {
		color: #fff;
	}

	#menu-item-440>a:before {
		width: 100%;
	}

	header.fixed #menu-item-440>a {
		color: #dd4a55;
	}

	body.menu-open .main_menu #menu-item-440>a {
		color: #dd4a55;
	}
</style>
<?php get_footer(); ?>