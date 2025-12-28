<?php get_header(); ?>

<main role="main" aria-label="Content">
	<!-- section -->
	<section>
		<?php
		if (is_search()) {
			echo '<div class="news_listItem">';
			if (have_posts()) {
				while (have_posts()) {
					the_post();
					$term_list = get_the_terms(get_the_ID(), 'category');
					echo '<div class="news_listItem_block">';
					echo '<h2><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';
					echo '<p class="date">';
					echo '<span class="sp01">' . get_the_date('F d, Y') . '</span>';
					if ($term_list) {
						foreach ($term_list as $i => $cd) {
							echo ' | <a href="' . get_term_link($cd->term_id) . '">' . $cd->name . '</a>';
						}
					}
					echo '</p>';
					echo '<figure class="affect-img"><a href="' . get_the_permalink() . '"><img src="' . get_the_post_thumbnail_url() . '" alt="' . esc_html(get_the_post_thumbnail_caption()) . '" /></a></figure>';
					echo '<div class="txt">' . strip_tags(mb_strimwidth(get_the_content(), 0, 400, '...')) . '</div>';
					echo '<p><a class="main_button" href="' . get_the_permalink() . '">Read more</a></p>';
					echo '</div>';
				}
				wp_reset_postdata();
				echo get_pagination_links();
			}
			echo '</div>';
		}
		?>
	</section>
	<!-- /section -->
</main>

<?php get_footer(); ?>