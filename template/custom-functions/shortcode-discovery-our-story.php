<?php

function discovery_our_story_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'page_id' => 173, //LAB84 page ID
        ),
        $atts
    );
    ob_start();
    $title_discovery_our_story = get_field('title_discovery_our_story', $atts['page_id']);
    $description_discovery_our_story = get_field('description_discovery_our_story', $atts['page_id']);
    $tab_content = get_field('tab_content', $atts['page_id']);
    $title_how_we_are = get_field('title_how_we_are', 15);
    $description_how_we_are = get_field('description_how_we_are', 15);
    $image_how_we_are = get_field('image_how_we_are', 15);


?>
    <div class="discovery-our-story container my-lg-5 my-2">
        <div class="quote-section ">
            <div class="row align-items-lg-end align-items-center mb-2 border-bottom">
                <div class="col-12 col-lg-7 mb-lg-2 px-1 mb-1">
                    <?php if (is_front_page()) : ?>
                        <h2 class="fs-lg-55 fs-24 mb-0"><?php echo $title_how_we_are; ?></h2>
                    <?php else : ?>
                        <h2 class="fs-lg-55 fs-24 mb-0"><?php echo $title_discovery_our_story; ?></h2>
                    <?php endif; ?>

                </div>
            </div>
            <div class="des-discovery-our-story mb-lg-3 mb-1 fs-16 fs-lg-18"><?php echo $description_discovery_our_story; ?></div>

        </div>
        <?php if (is_front_page()) : ?>
            <div class="row py-2">
                <div class="col-lg-8 col-12 fs-16 fs-lg-18 pe-lg-150px pe-0">
                    <?php echo $description_how_we_are; ?>
                </div>
                <div class="col-lg-4 col-12 h-300px position-relative">
                    <?php if ($image_how_we_are) : ?>
                        <div class="image-wrapper position-relative h-300px w-100 d-inline-block ">
                            <div class="image-overlay position-absolute w-100 h-300px z-0" style="background-image: url('<?php echo $image_how_we_are['url']; ?>');"></div>
                            <img class="image-tab w-100 h-300px position-relative d-block z-1" src="<?php echo $image_how_we_are['url']; ?>" alt="<?php echo $image_how_we_are['title']; ?>">
                        </div>
                    <?php else : ?>
                        <div class="square"></div>
                    <?php endif; ?>
                </div>
            </div>
        <?php else : ?>

            <div class="tab-section row mb-lg-3 mb-2 mt-lg-5 mt-2">
                <div class="tab-buttons col-lg-2 col-12 d-flex d-lg-block overflow-auto align-items-center ps-lg-15px  ">
                    <?php foreach ($tab_content as $key => $value) : ?>
                        <p class="tablink py-1 px-lg-1 px-0 pe-1 me-1 me-lg-0 mb-1 mb-lg-0 white-space-nowrap  fs-18 cursor-pointer <?php echo $key === 0 ? 'active' : ''; ?>">
                            <?php echo $value['title_tab']; ?>
                        </p>
                    <?php endforeach; ?>
                </div>

                <div class="tab-content col-lg-10 col-12 mt-2 mt-lg-0">
                    <?php foreach ($tab_content as $key => $value) : ?>
                        <div id="tab-<?php echo $key; ?>" class="tab-pane h-100 <?php echo $key === 0 ? 'active' : ''; ?>">
                            <div class="row h-100">
                                <div class="tab-text container col-12 col-lg-6 mb-5 ps-0 mb-lg-2 fs-16 fs-lg-18 pe-0 pe-lg-2 align-content-start mt-lg-1">
                                    <?php echo $value['description_tab']; ?>
                                </div>
                                <div class="tab-images col-12 col-lg-6 h-300px position-relative">
                                    <?php if ($value['image_tab']) : ?>
                                        <div class="image-wrapper position-relative h-300px w-100 d-inline-block ">
                                            <div class="image-overlay position-absolute w-100 h-300px z-0" style="background-image: url('<?php echo $value['image_tab']['url']; ?>');"></div>
                                            <img class="image-tab w-100 h-300px position-relative d-block z-1" src="<?php echo $value['image_tab']['url']; ?>" alt="<?php echo $value['image_tab']['title']; ?>">
                                        </div>
                                    <?php else : ?>
                                        <div class="square"></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        <?php endif; ?>
        <?php if (is_front_page()) : ?>
        <div class="text-end py2">
            <a class="border border-1 border-red fs-14 fs-lg-18 text-red button button-red border-button" href="/lab84/">Khám phá câu chuyện của chúng tôi ></a>
        </div>
        <?php endif; ?>

    </div>
<?php
    return ob_get_clean();
}
add_shortcode('discovery_our_story', 'discovery_our_story_shortcode');
?>