<?php
//shortcode We specialize in these fields
function specialize_fields_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'page_id' => 177, // Expertise page ID
        ),
        $atts
    );

    ob_start();
    if (have_rows('we_specialize_in_these_fields', $atts['page_id'])) :
        while (have_rows('we_specialize_in_these_fields', $atts['page_id'])) : the_row();
            $title_we_spacialize = get_sub_field('title_we_spacialize');
            $description_we_spacialize = get_sub_field('description_we_spacialize');
            $sub_title_we_spacialize = get_sub_field('sub_title_we_spacialize');
            $intro_description_we_spacialize = get_sub_field('intro_description_we_spacialize');
?>
            <div class="container">
                <div class="row my-1 py-lg-2 border-bottom">
                    <div class="col-12">
                        <h2 class="fs-lg-55 fs-24 fw-bold mb-2 mb-lg-1"><?php echo $title_we_spacialize; ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="des-we-spacialize fs-16 fs-lg-18"><?php echo ($intro_description_we_spacialize); ?></div>
                    </div>

                    <div class="col-lg-6 col-12 left">
                        <div class="des-we-spacialize pt-lg-1 fs-16 fs-lg-18"><?php echo ($description_we_spacialize); ?></div>
                    </div>
                    <div class="col-lg-6 col-12 right d-lg-flex justify-content-center">
                        <ul class="list-expertise">
                            <?php foreach ($sub_title_we_spacialize as $sub_title) : ?>
                                <li class="py-lg-1 pb-1 ">
                                    <!-- <span class="text-red pe-1 fs-16 fs-lg-18">+</span> -->
                                    <a class="text-body fs-16 fs-lg-18" href="<?php echo $sub_title['link']['url']; ?>">
                                        <?php echo $sub_title['title']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php if (is_front_page()) : ?>
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <?php if (have_rows('phuong_thuc_lam_viec', 177)) : ?>
                                <?php while (have_rows('phuong_thuc_lam_viec', 177)) : the_row(); ?>
                                    <?php $tab_menu = get_sub_field('tabs_menu'); ?>
                                    <div class="row">
                                        <?php
                                        $tabIndex = 1;
                                        foreach ($tab_menu as $index => $tab) : ?>
                                            <div class="col-6 col-lg-3 d-block  mb-1 my-lg-0" data-tab="tab-<?php echo $tabIndex; ?>">
                                                <a href="/chuyen-mon/#<?php echo $tab['id_tab']; ?>" class="d-block text-decoration-none">
                                                    <div class="text-center me-1">
                                                        <span class="fs-24 fw-bold border-bottom border-red"><?php echo str_pad($tabIndex, 2, '0', STR_PAD_LEFT); ?></span>
                                                    </div>
                                                    <div class="text-center px-lg-1">
                                                        <span class="fs-lg-18 fs-16"><?php echo $tab['tab_title']; ?></span>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php
                                            $tabIndex++;
                                        endforeach; ?>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>

                        </div>
                        <div class="col-lg-6 col-12 d-lg-flex align-items-end justify-content-end mt-1">
                            <div class="all-expertise text-end my-1 my-lg-2">
                                <a class="border border-1 border-red fs-14 fs-lg-18 text-red button button-red border-button" href="/chuyen-mon/">Chuyên Môn ></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
<?php
        endwhile;
    endif;
    return ob_get_clean();
}

add_shortcode('specialize_fields', 'specialize_fields_shortcode');

?>