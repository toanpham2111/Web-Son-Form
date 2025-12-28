<?php
function phuong_thuc_lam_viec_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'page_id' => 177,
        ),
        $atts
    );
    ob_start();
    if (have_rows('phuong_thuc_lam_viec', $atts['page_id'])) :
        while (have_rows('phuong_thuc_lam_viec', $atts['page_id'])) : the_row();
            $title = get_sub_field('title');
            $description = get_sub_field('description');
            $tab_menu = get_sub_field('tabs_menu');

?>
            <div id="phuong-thuc-lam-viec" class="container my-lg-5 my-2">
                <div class="mb-2 border-bottom">
                    <h1 class="fs-lg-55 fs-24 fw-bold mb-2 mb-lg-1"><?php echo $title; ?></h1>
                </div>
                <div class="quote">
                    <?php echo $description; ?>
                </div>
                <div class="tabs d-lg-flex d-block align-items-center my-1">
                    <?php
                    $tabIndex = 1;
                    foreach ($tab_menu as $index => $tab) : ?>
                        <div
                            id="<?php echo $tab['id_tab']; ?>" 
                            class="tab-button scroll-mt d-lg-block d-flex align-items-center mx-lg-2 <?php echo $index === 0 ? 'active' : ''; ?>"
                            data-tab="tab-<?php echo $tabIndex; ?>"
                            data-tab-id="<?php echo $tab['id_tab']; ?>"> 
                            <div class="d-flex align-items-center me-2">
                                <span class="fs-lg-55 fs-45 fw-bold text-red"><?php echo str_pad($tabIndex, 2, '0', STR_PAD_LEFT); ?></span>
                                <img class="mx-1 mt-2" width="40" height="40" src="<?php echo $tab['icon']['url']; ?>">
                            </div>
                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <span class="fs-lg-18 fs-16 text-start title-tab"><?php echo $tab['tab_title']; ?></span>
                                <div class="rounded-circle border ms-1 mt-lg-2 text-center w-24px h-24px d-flex align-items-center justify-content-center">
                                    <i class="fa-chevron-down fs-16 text-center"></i>
                                </div>
                            </div>
                        </div>
                    <?php
                        $tabIndex++;
                    endforeach; ?>
                </div>


                <div class="tab-content border-bottom border-top border-red my-2">
                    <?php
                    $tabIndex = 1;
                    foreach ($tab_menu as $index => $tab) : ?>
                        <div
                            class="tab-pane <?php echo $index === 0 ? 'active' : ''; ?>"
                            id="tab-<?php echo $tabIndex; ?>">
                            <p><?php echo $tab['tab_description']; ?></p>
                        </div>
                    <?php
                        $tabIndex++;
                    endforeach; ?>
                </div>


            </div>
<?php
        endwhile;
    endif;

    return ob_get_clean();
}
add_shortcode('phuong_thuc_lam_viec', 'phuong_thuc_lam_viec_shortcode');
