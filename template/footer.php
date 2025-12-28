</main>
<footer class="footers">
	<div class="footer_top">
		<?php
		if (is_active_sidebar('footer-top')) {
			dynamic_sidebar('footer-top');
		}
		?>
	</div>
	<div class="footer_content pt-lg-3 pb-lg-1 py-0 bg-dark text-gray-600 ">
		<div class="container">
			<div class="row pt-2 pt-lg-3 row mx-1 mx-lg-0 ">
				<div class="col-lg-6 col-12">
					<div class="row">
					<div class="px-0 p-lg-15px col-lg-4 d-lg-block pt-1 pb-lg-0 pt-lg-0 footer_logo">
						<div class="foot_logo mb-lg-2 mb-1">
							<?php
							if (function_exists('the_custom_logo')) {
								the_custom_logo();
							}
							?>
						</div>
					</div>
					<div class=" col-lg-8 d-lg-block footer_address">
						<!-- <h3 class="fw-bold text-white fs-16">Công ty TNHH Thiết kệ sáng tạo LAB84</h3> -->
						<?php
						if (is_active_sidebar('our-address')) {
							dynamic_sidebar('our-address');
						}
						?>
						<?php
						if (is_active_sidebar('social-media')) {
							dynamic_sidebar('social-media');
						}
						?>
					</div>
					</div>
				</div>
				<div class="col-lg-6 col-12 pt-3 pt-lg-0">
					<div class="row ">
					<div class=" col-lg-3 d-lg-block footer_quick_links">
						<a href="/lab84/"><h3 class="fw-bold text-white fs-16 ">Về Lab84</h3></a>
						<?php wp_nav_menu(array('menu' => '32', 'container_id' => '', 'menu_class' => '')); ?>
					</div>
					<div class=" col-lg-3 d-lg-block footer_quick_links">
						<a href="/chuyen-mon/"><h3 class="fw-bold text-white fs-16">Chuyên môn</h3></a>
						<?php wp_nav_menu(array('menu' => '37', 'container_id' => '', 'menu_class' => '')); ?>
					</div>
					<div class=" col-lg-3 d-lg-block footer_quick_links">
						<a href="/du-an/"><h3 class="fw-bold text-white fs-16">Dự án</h3></a>
						<!-- <?php wp_nav_menu(array('menu' => '38', 'container_id' => '', 'menu_class' => '')); ?> -->
					</div>
					<div class=" col-lg-3 d-lg-block footer_quick_links">
						<a href="/blog/"><h3 class="fw-bold text-white fs-16">Blog</h3></a>
						<!-- <?php wp_nav_menu(array('menu' => '39', 'container_id' => '', 'menu_class' => '')); ?> -->
					</div>
					</div>
				</div>
			</div>
			<div class="footer_bottom pt-1 mt-5 border-top border-gray">
			<div class="d-lg-block footer_boccongthong pb-2">
				<?php
				if (is_active_sidebar('logo-bocongthuong')) {
					dynamic_sidebar('logo-bocongthuong');
				}
				?>
			</div>	
			<div class="d-lg-block footer_copyright text-center text-white fw-bold pb-2">
				<?php
				if (is_active_sidebar('copyright')) {
					dynamic_sidebar('copyright');
				}
				?>
			</div>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
</footer>
</body>

</html>

