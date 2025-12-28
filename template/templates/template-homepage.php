<?php

/**
 * Template Name: Homepage Template
 * Template Post Type: page
 */
get_header();
$banner_slider = get_field('banner_slider');
$color_heading = get_field('color_heading');
$partners = get_field('partner');
$banner_social_link = get_field('social_link');
?>

<div class="slick-banner full-width  ">
	<?php foreach ($banner_slider as $banner) : ?>
		<div class="banner-slide" style="background: <?php echo !empty($banner['background_image']['url']) ? 'url(' . $banner['background_image']['url'] . ') no-repeat center/cover' : '#dd4a55'; ?>;">
			<?php if ($banner['background_image']['url']): ?>
				<div class="overlay bg-rgba-1"></div>
				<div class="blur-effect"></div>
			<?php endif; ?>
			<div class="content animate pe-2 pe-lg-0">
				<h3 style="color: <?php echo $color_heading ?: '#fff'; ?>"><?php echo $banner['sub_title']; ?></h3>
				<h1 class="fs-lg-78 fs-55" style="color: <?php echo $color_heading ?: '#fff'; ?>"><?php echo $banner['title']; ?></h1>
				<p style="color: <?php echo $color_heading ?: '#fff'; ?>">
					<?php echo $banner['description']; ?>
				</p>
			</div>
			<div class="banner-social position-absolute bottom-lg-50px start-60px  bottom-30px z-3  ">
				<?php if ($banner_social_link): ?>
					<div class="d-flex justify-content-start align-items-center flex-wrap">
						<?php foreach ($banner_social_link as $social): ?>
							<a class="text-white px-lg-2  px-1 pb-1 text-uppercase fw-bold fs-lg-18 fs-16" target="_blank"
								href="<?php echo !empty($social['link_social']) ? $social['link_social'] : '#'; ?>">
								<span><?php echo $social["title_social"]; ?></span>
							</a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
<div class="container">


	<?php echo do_shortcode('[discovery_our_story page_id="173"]'); ?>

	<?php if (have_rows('we_believe_in_design')) : ?>
		<?php while (have_rows('we_believe_in_design')) : the_row();
			$title = get_sub_field('title');
			$background_images = get_sub_field('background_images');
			$background_image_url = !empty($background_images['url']) ? $background_images['url'] : '';
			$background_style = $background_image_url ? "background: url('$background_image_url') no-repeat center/cover ;" : " #dd4a55;";
		?>
			<div class="section-banner-we-believe-in-design full-width h-400px d-flex justify-content-center align-items-center mt-1 mb-3 position-relative"
				style="<?php echo esc_attr($background_style); ?>">
				<div class="overlay bg-rgba-3"></div>
				<h2 class="text-uppercase text-white text-center mb-0 z-2"><?php echo $title; ?></h2>
			</div>

		<?php endwhile; ?>
	<?php endif; ?>

	<!-- We specialize in these fields -->
	<?php echo do_shortcode('[specialize_fields page_id="177"]'); ?>

	<?php if (have_rows('building_a_legacy')) : ?>
		<?php while (have_rows('building_a_legacy')) : the_row();
			$title_building_a_legacy = get_sub_field('title_building_a_legacy');
			$description_building_a_legacy = get_sub_field('description_building_a_legacy');
			$projects_featured = get_sub_field('projects_featured');
		?>
			<div class="building-a-legacy-one-project-at-a-time mt-lg-5 mb-lg-5">
				<div class="header pt-3 container">
					<div class="row container px-0 align-items-lg-end align-items-center mb-2 border-bottom">
						<div class="col-lg-7 col-12 mb-lg-2 px-1 mb-1">
							<h2 class="fs-lg-55 fs-24 mb-0"><?php echo $title_building_a_legacy; ?></h2>
						</div>
						<div class="col-lg-5 col-12 d-none d-lg-block mb-1 px-0">
							<div class="text-end py-1">
								<a href="/du-an/" class="border border-1 border-red fs-14 fs-lg-18 button button-red text-red border-button">Dự án ></a>
							</div>
						</div>
					</div>
					<div class="mb-lg-5 pb-lg-3 fs-16 fs-lg-18">
						<?php echo $description_building_a_legacy; ?>
					</div>
					<div class="d-block d-lg-none mb-2 px-0">
						<div class="text-end py-1">
							<a href="/du-an/" class="border border-1 border-red fs-14 fs-lg-18 button button-red text-red border-button">Dự án ></a>
						</div>
					</div>
				</div>
				<div class="slider-container position-relative h-400px my-lg-3 mt-0 mb-3">
					<div class="project-slider full-width position-relative">
						<?php echo do_shortcode('[GET_LIST posts_per_page="-1" template="/template-list/projects-slider.php" post_type="projects"  pagination="false"]'); ?>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
	<div class="blog container my-2 my-lg-3">
		<div class="row align-items-lg-end align-items-center mb-2 border-bottom">
			<div class="col-lg-7 col-9 mb-1 px-1 mb-1">
				<h2 class="fs-lg-55 fs-24 mb-0">Blog</h2>
			</div>
			<div class="col-lg-5 col-3 mb-1 px-0">
				<div class="text-end py-1">
					<a href="/blog/" class="border border-1 border-red fs-14 fs-lg-18 button button-red text-red border-button">Blog ></a>
				</div>
			</div>
		</div>
		<div class="blog-slider">
			<?php echo do_shortcode('[GET_LIST posts_per_page="-1" order="ASC"  template="/template-list/latest-new.php" post_type="post" pagination="false" ]'); ?>
		</div>
	</div>
	<div class="partners container my-2 my-lg-5">
		<div class="row align-items-lg-end align-items-center mb-2 border-bottom">
			<div class="col-12 mb-1 px-1 mb-1">
				<h2 class="fs-lg-55 fs-24 mb-0">Đối tác</h2>
			</div>
		</div>

		<?php if ($partners) : ?>
			<div class="list-partners ">
				<?php foreach ($partners as $partner) : ?>
					<div class="partner-logo my-3 px-2">
						<?php if (!empty($partner['partner_link'])) : ?>
							<a href="<?php echo $partner['partner_link']; ?>">
								<img width="210" height="150" src="<?php echo $partner['logo_partner']['url']; ?>" alt="<?php echo $partner['title']; ?>">
							</a>
						<?php else: ?>
							<img width="210" height="150" src="<?php echo $partner['logo_partner']['url']; ?>" alt="<?php echo $partner['title']; ?>">
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>

</div>



<div class="container h-100 d-none">
	<?php the_content(); ?>
</div>

<?php get_footer(); ?>