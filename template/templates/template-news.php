<?php

/**
 * Template Name: News Template
 * Template Post Type: page
 *
 */

get_header();
$color_heading = get_field('color_heading');
?>
<div class="blog-page">

	<div class="banner full-width h-lg-500px h-300px">
		<div class="h-lg-500px h-300px position-relative py-lg-5 py-2"
			style="background: <?php echo get_the_post_thumbnail_url() ? 'url(' . get_the_post_thumbnail_url() . ') no-repeat center/cover' : '#dd4a55'; ?>;">
			<?php if (get_the_post_thumbnail_url()): ?>
				<div class="overlay"></div>
			<?php endif; ?>
			<div class="content position-absolute top-50 start-50 translate-middle z-1 w-100 text-center">
				<h1 class="fs-lg-78 fs-55 my-2" style="color: <?php echo $color_heading ?: '#fff'; ?>"><?php echo get_the_title(); ?></h1>
				<div class="w-lg-50 w-80 mx-auto">
				<form role="search" class="et-search-form position-relative d-flex" action="<?php echo esc_url(home_url('/')); ?>">
					<label class="screen-reader-text" for="s"><?php _e('Search', 'woocommerce'); ?></label>
					<input id="searchInput2"
						type="search"
						class="fs-sm search-field border border-white text-gray-800 w-100 px-1 h-50px"
						placeholder=""
						value="<?php echo get_search_query(); ?>"
						name="s"
						title="<?php echo esc_attr_x('Search for:', 'label', 'woocommerce'); ?>" />
					<button class="btn ms-1 w-auto position-absolute end-0 border-start-0  border-white rounded-0 btn-red text-white h-50px d-flex align-items-center justify-content-center" type="submit">
						<img class="filter-white" width="20" height="20" src="/wp-content/uploads/2024/10/search.svg" alt="<?php echo esc_attr_x('Search', 'submit button', 'woocommerce'); ?>">
					</button>
					<input type="hidden" name="post_type" value="product" />
				</form>

			</div>
			</div>
		</div>
	</div>
	<div class="news-page container my-lg-5 my-2">
		<div class="news-header text-center d-none">
			<h1 class="fs-lg-55 fs-24"><?php echo get_the_title(); ?></h1>
			<div class="w-lg-50 w-80 mx-auto">
				<form role="search" class="et-search-form position-relative d-flex" action="<?php echo esc_url(home_url('/')); ?>">
					<label class="screen-reader-text" for="s"><?php _e('Search', 'woocommerce'); ?></label>
					<input id="searchInput2"
						type="search"
						class="fs-sm search-field border border-black text-gray-800 w-100 px-1 h-50px"
						placeholder=""
						value="<?php echo get_search_query(); ?>"
						name="s"
						title="<?php echo esc_attr_x('Search for:', 'label', 'woocommerce'); ?>" />
					<button class="btn ms-1 w-auto position-absolute end-0 border-start-0  border-black rounded-0 btn-red text-white h-50px d-flex align-items-center justify-content-center" type="submit">
						<img class="filter-white" width="20" height="20" src="/wp-content/uploads/2024/10/search.svg" alt="<?php echo esc_attr_x('Search', 'submit button', 'woocommerce'); ?>">
					</button>
					<input type="hidden" name="post_type" value="product" />
				</form>

			</div>
		</div>
		<div class="slider-container position-relative h-400px my-lg-5 my-3">
			<div class="news-featured-slider full-width position-relative">
				<?php echo do_shortcode('[GET_LIST posts_per_page="6" order="ASC" template="/template-list/news-slider.php" post_type="post"  pagination="false"]'); ?>
			</div>
		</div>
		<div class=" group-title-recent mb-lg-3 mb-1">
			<!-- <div class="position-relative container">
				<h3 class="fs-lg-45 fs-25 fw-bold white-space-nowrap mb-0 line-red">Recent News</h3>
			</div> -->
		</div>

		<?php echo do_shortcode('[GET_LIST posts_per_page="-1" template="/template-list/post.php" post_type="post" pagination="false"]'); ?>
	</div>

	<?php get_footer(); ?>