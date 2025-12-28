<?php

/**
 * Template Name: Expertise Template
 * Template Post Type: page
 *
 */

get_header();
$color_heading = get_field('color_heading');
?>


<div class="banner full-width h-lg-500px h-300px">
	<div class="h-lg-500px h-300px position-relative"
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
	<?php echo do_shortcode('[specialize_fields page_id="177"]'); ?>
	<?php $content_expertise = get_field('content_expertise'); ?>


	<?php foreach ($content_expertise as $index => $content): ?>

		<div id="<?php echo isset($content['id_section']) ? $content['id_section'] : $index; ?>" class="row my-lg-5 my-2 scroll-mt">

			<?php if ($index % 2 === 0): ?>
				<!-- Even index: Title on the left, Accordion on the right -->
				<div class="col-12 col-lg-6 bg-red text-white order-1">
					<h2 class="py-2 mb-0 px-2 text-white text-uppercase">
						<?php echo $content['title_expertise_en']; ?>
					</h2>
					<div class="line mx-2"></div>
					<h2 class="py-2 px-2 text-white text-uppercase">
						<?php echo $content['title_expertise_vn']; ?>
					</h2>
				</div>
				<div class="col-12 col-lg-6 my-1 my-lg-0 order-2">
					<div class="accordion" id="accordionExample<?php echo $index; ?>">
						<?php if ($content['accordion_content']) : ?>
							<?php foreach ($content['accordion_content'] as $key => $item): ?>
								<div class="accordion-item border-0">
									<h2 class="accordion-header " id="heading<?php echo $index . '-' . $key; ?>">
										<button class="accordion-button py-1 <?php echo $key === 0 ? '' : 'collapsed'; ?> border-0 rounded-0 bg-transparent " type="button" data-bs-toggle="collapse"
											data-bs-target="#collapse<?php echo $index . '-' . $key; ?>" aria-expanded="true"
											aria-controls="collapse<?php echo $index . '-' . $key; ?>">
											<h3 class="mb-0 fs-18 fw-medium"><?php echo $item['title_accordion']; ?></h3>
										</button>
									</h2>
									<div id="collapse<?php echo $index . '-' . $key; ?>" class="accordion-collapse collapse border-0 <?php echo $key === 0 ? 'show' : ''; ?>"
										aria-labelledby="heading<?php echo $index . '-' . $key; ?>" data-bs-parent="#accordionExample<?php echo $index; ?>">
										<div class="accordion-body py-0 py-lg-1 fs-16 fs-lg-18">
											<?php echo $item['description_accordion']; ?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
			<?php else: ?>
				<!-- Odd index: Accordion on the left, Title on the right -->
				<div class="col-12 col-lg-6 my-1 my-lg-0 order-lg-1 order-2">
					<div class="accordion" id="accordionExample<?php echo $index; ?>">
						<?php if ($content['accordion_content']) : ?>
							<?php foreach ($content['accordion_content'] as $key => $item): ?>
								<div class="accordion-item border-0">
									<h2 class="accordion-header  " id="heading<?php echo $index . '-' . $key; ?>">
										<button class="accordion-button py-1 <?php echo $key === 0 ? '' : 'collapsed'; ?> border-0 rounded-0 bg-transparent " type="button" data-bs-toggle="collapse"
											data-bs-target="#collapse<?php echo $index . '-' . $key; ?>" aria-expanded="true"
											aria-controls="collapse<?php echo $index . '-' . $key; ?>">
											<h3 class="mb-0 fs-18 fw-medium"><?php echo $item['title_accordion']; ?></h3>
										</button>
									</h2>
									<div id="collapse<?php echo $index . '-' . $key; ?>" class="accordion-collapse collapse border-0 <?php echo $key === 0 ? 'show' : ''; ?>"
										aria-labelledby="heading<?php echo $index . '-' . $key; ?>" data-bs-parent="#accordionExample<?php echo $index; ?>">
										<div class="accordion-body py-0 py-lg-1 fs-16 fs-lg-18">
											<?php echo $item['description_accordion']; ?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-12 col-lg-6 bg-red text-white order-lg-2 order-1">
					<h2 class="py-2 mb-0 px-2 text-white text-uppercase">
						<?php echo $content['title_expertise_en']; ?>
					</h2>
					<div class="line mx-2"></div>
					<h2 class="py-2 px-2 text-white text-uppercase">
						<?php echo $content['title_expertise_vn']; ?>
					</h2>
				</div>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
	<?php echo do_shortcode('[phuong_thuc_lam_viec page_id="177"]'); ?>
</div>

<?php get_footer(); ?>