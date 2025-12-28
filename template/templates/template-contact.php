<?php

/**
 * Template Name: Contact Template
 * Template Post Type: page
 *
 */

get_header();
$color_heading = get_field('color_heading');
?>

	<div class="h-lg-500px h-300px position-relative"
		style="background: <?php echo get_the_post_thumbnail_url() ? 'url(' . get_the_post_thumbnail_url() . ') no-repeat center/cover' : '#dd4a55'; ?>;">
		<?php if (get_the_post_thumbnail_url()): ?>
			<div class="overlay"></div>
		<?php endif; ?>
		<div class="content position-absolute top-50 start-50 translate-middle z-1 w-100 text-center">
			<h1 class="fs-lg-78 fs-55 my-2" style="color: <?php echo $color_heading ?: '#fff'; ?>"><?php echo get_the_title(); ?></h1>
		</div>
	</div>
	<div class="container my-lg-5 my-2">
		<?php the_content(); ?>
	</div>


<?php get_footer(); ?>