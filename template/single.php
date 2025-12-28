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
	<main id="main" class="site-main">
		<?php
		// Start the Loop.
		while (have_posts()) :
			the_post();
			$template_file = 'template-list/' . get_post_type() . '-detail.php';
			include(locate_template($template_file));
		endwhile; // End the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
