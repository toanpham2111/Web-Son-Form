<?php

/**
 * Template Name: About Us Template
 * Template Post Type: page
 *
 */

get_header();
$color_heading = get_field('color_heading');
?>


	<div class="banner full-width h-lg-500px h-300px">
		<div class="h-lg-500px h-300px w-100 position-relative"
			style="background: <?php echo get_the_post_thumbnail_url() ? 'url(' . get_the_post_thumbnail_url() . ') no-repeat center/cover' : '#dd4a55'; ?>;">
			<?php if (get_the_post_thumbnail_url()): ?>
				<div class="overlay"></div>
			<?php endif; ?>
			<div class="content position-absolute top-50 start-50 translate-middle z-1 w-100 text-center">
				<h1 class="fs-lg-78 fs-55 my-2" style="color: <?php echo $color_heading ?: '#fff'; ?>"><?php echo get_the_title(); ?></h1>
			</div>
		</div>
	</div>
	<div class="container my-lg-5 my-2">
		<?php echo do_shortcode('[discovery_our_story page_id="173"]'); ?>
	</div>
	<div class="container my-lg-5 my-2">
		<?php echo do_shortcode('[meet_the_team page_id="173"]'); ?>
		<div class="text-end">
			<a class="button-read-more-team border border-1 border-red fs-14 fs-lg-18 button button-red text-red border-button " id="load-more">Xem Thêm</a>
		</div>
		<div id="member-list" class="position-relative py-lg-3">
			<div id="loading-spinner" style="display: none;">
				<div class="spinner"></div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>