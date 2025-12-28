<?php
/**
 * Template part for displaying posts
 *
 * @package WordPress
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-detail">
		<div class="post-detail-wrapper row">
			<div class="post-detail-left col-12 col-md-8">
				<div class="post-detail-left-title">
					<h1><?php echo get_the_title(); ?></h1>
				</div>
				<div class="post-detail-left-desc">
					<?php
						the_content( '', TRUE );
					?>
				</div>
			</div>
			<div class="post-detail-right col-12 col-md-4">
				<div class="related-posts">
						<?php
							$related_posts = get_field('related_posts');
							if( $related_posts ): ?>
								<div class="related-posts-title"><?php _e( 'LÆS OGSÅ', 'eazyviral'); ?></div>
									<?php foreach( $related_posts as $post ): 
											// Setup this post for WP functions (variable must be named $post).
											setup_postdata($post); ?>
											<div class="related-posts-post">
													<div class="related-posts-post-image">
													<?php if (has_post_thumbnail()): ?>
															<?php the_post_thumbnail( 'full' );  ?>
													<?php endif; ?>
													</div>
													<div class="related-posts-post-content">
														<div class="related-posts-post-content-title">
															<h2><?php the_title(); ?></h2>
														</div>
														<div class="related-posts-post-content-desc">
															<?php 
																the_content(
																	sprintf(
																		wp_kses(
																			__( '' ),
																			array(
																				'span' => array(
																					'class' => array(),
																				),
																			)
																		)
																	)
																);
															?>
														</div>
														<div class="related-posts-post-content-readmore">
															<a href="<?php the_permalink(); ?>"><?php _e( 'Læs mere', 'eazyviral'); ?></a>
														</div>
													</div>
											</div>
									<?php endforeach; ?>
									<?php 
									// Reset the global post object so that the rest of the page works correctly.
									wp_reset_postdata(); ?>
							<?php endif; ?>
				</div>
				<div class="contact-form">
					<?php echo do_shortcode('[contact-form-7 id="134"]'); ?>
				</div>
			</div>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
