<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
	<%= htmlWebpackPlugin.tags.headTags %>
	{{{fontPreload}}}
	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KXCPV8DN');</script>
<!-- End Google Tag Manager -->
</head>

<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KXCPV8DN"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<header id="header" class="w-100 position-fixed top-0 start-0 z-4">
		<div class="container position-relative border-bottom border-white">
			<div class="header d-flex justify-content-between position-relative align-items-center">
				<div class="header_logo w-auto col-lg-2 text-lg-start">
					<div class="main_logo">
						<?php
						if (function_exists('the_custom_logo')) {
							the_custom_logo();
						}
						?>
					</div>
				</div>
				<div class="d-lg-none">
					<div class="navbar-header">
						<div class="d-flex align-items-center">
							<!-- <div id="search" class="icon-search text-center px-3 d-block d-lg-none">
								<a data-bs-toggle="modal" data-bs-target="#searchModal" href="#!" role="button">
								<img class="mb-5px" width="20" height="20" src="/wp-content/uploads/2024/10/search.svg">
								</a>
							</div> -->
							<button id="menu-btn" type="button btn" class="navbar-toggle bar-wrapper">
								<span></span>
								<span></span>
								<span></span>
							</button>
						</div>
					</div>
				</div>
				<div class="main_menu col-lg-10 mt-lg-sm font-sans-serif-medium d-lg-flex align-items-center justify-content-end">
					<div class="menu d-lg-flex align-items-center justify-content-end">
						<?php wp_nav_menu(array('menu' => '3', 'container_id' => '', 'menu_class' => 'd-flex flex-wrap m-0 justify-content-center align-items-center fw-normal justify-content-lg-end flex-lg-row flex-column')); ?> </div>
					<!-- <div id="search" class="icon-search text-center px-3 pb-5px d-lg-block d-none">
						<a data-bs-toggle="modal" data-bs-target="#searchModal" href="#!" role="button">
							<img class="" width="20" height="20" src="/wp-content/uploads/2024/10/search.svg">
						</a>
					</div> -->
				</div>
			</div>
		</div>
	</header>
	<!-- Modal -->
	<div class="modal fade z-5 bg-rgba-6" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-780">
        <div class="modal-content">
            <div class="modal-header border-0 pt-2">
                <button type="button" class="btn-close fs-16 py-1 px-2" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5  px-lg-5 px-2">
                <h5 class="modal-title fs-18 fw-bold mb-2" id="searchModalLabel">Tìm kiếm</h5>
                <form role="search" class="et-search-form position-relative d-flex" action="<?php echo esc_url(home_url('/')); ?>">
                    <label class="screen-reader-text" for="s"><?php _e('Search', 'woocommerce'); ?></label>
                    <input id="searchInput" type="search" class="fs-sm search-field border border-black text-gray-800 w-100 px-1 h-50px" placeholder="" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label', 'woocommerce'); ?>" />
                    <input class="btn ms-1 w-auto border rounded-0 btn-red text-white h-50px" type="submit" value="<?php echo esc_attr_x('Search', 'submit button', 'woocommerce'); ?>" />
                    <input type="hidden" name="post_type" value="search" />
                </form>
            </div>
        </div>
    </div>
</div>



	<main id="site-content" role="main" class="mt-0 pt-lg-85px ">