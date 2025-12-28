<?php
/**
 * Template part for displaying posts
 *
 * @package WordPress
 */
global $product;

?>
<h1 class="entry-title"><?php echo $product->name; ?></h1>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<div class="product-detail container">
		<div class="product-detail-wrapper row">
			<div class="product-detail-left col-12 col-md-8">
				<div class="product-detail-left-description">
					<?php
							the_content( '', TRUE );
					?>
				</div>
			</div>
			<div class="product-detail-right col-12 col-md-4">
				<div class="product-detail-right-price">
					<div class="product-detail-right-price-includeTax"><?php echo $product->get_price_including_tax(); ?><span>,-</span></div>
					<div class="product-detail-right-price-excludeTax">(Pris ex. moms <?php echo $product->get_price(); ?><span>DKK)</span></div>
				</div>
				<div class="product-detail-right-add-to-cart">
					<?php
							echo apply_filters( 'woocommerce_loop_add_to_cart_link',
							sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
									esc_url( $product->add_to_cart_url() ),
									esc_attr( $product->get_id() ),
									esc_attr( $product->get_sku() ),
									$product->is_purchasable() ? 'add_to_cart_button' : '',
									esc_attr( $product->get_type() ),
									esc_html( 'TILFØJ KURV' )
							),
					$product );
					?>
				</div>
				<div class="product-detail-right-contact-form contact-form">
						<?php echo do_shortcode('[contact-form-7 id="134"]'); ?>
				</div>
				<div class="product-detail-right-related-posts related-posts">
					<?php
						$related_posts = get_field('related_posts');
						if( $related_posts ): ?>
								<?php foreach( $related_posts as $post ): 
										// Setup this post for WP functions (variable must be named $post).
										setup_postdata($post); ?>
										<a href="<?php the_permalink(); ?>">
											<div class="related-posts-post">
													<div class="related-posts-post-image">
														<img src="<?php echo get_the_post_thumbnail_url(); ?>">
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
													</div>
											</div>
										</a>
								<?php endforeach; ?>
								<?php 
								// Reset the global post object so that the rest of the page works correctly.
								wp_reset_postdata(); ?>
						<?php endif; ?>
				</div>
			</div>
			<div class="product-detail-gallery">
				<div class="swiper-container-wrapper">
					<div id="swiper-slider-gallery" class="swiper-container"
							data-slide-effect="default"
							data-slide-speed="300"
							data-slide-direction="horizontal"
							data-slide-numberDesktop="5"
							data-slide-numberMobile="1">
						<div class="swiper-wrapper">
							<?php
								$gallery = $product->get_gallery_image_ids();
								foreach( $gallery as $image ): ?>
								<div class="product-detail-gallery-image swiper-slide">
									<img src="<?php echo wp_get_attachment_url( $image );?>">
								</div>
							<?php endforeach;?>
						</div>
					</div>

					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>
				</div>
			</div>
			<div class="product-detail-related">
				<?php
					woocommerce_related_products( array(
						'posts_per_page' => 20,
						'columns'        => 4,
						'orderby'        => 'rand'
					) );
				?>
			</div>
		</div>
	</div>
</div>