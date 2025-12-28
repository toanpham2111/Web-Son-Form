<?php
//shortcode Meet the team

function meet_the_team_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'page_id' => 173,
        ),
        $atts
    );
    ob_start();
    if (have_rows('meet_the_team', $atts['page_id'])) :
        while (have_rows('meet_the_team', $atts['page_id'])) : the_row();
            $title_meet_the_team = get_sub_field('title_meet_the_team');
            $description_meet_the_team = get_sub_field('description_meet_the_team');
            $list_team = get_sub_field('list_team');
?>
            <div id="doi-ngu-thiet-ke" class="meet-the-team my-lg-5 my-2 pt-lg-3 pt-2">
                <div class="container">
                    <div class="row mb-2 border-bottom">
                        <div class="col-lg-7 col-12 mb-lg-2 px-1 mb-1">
                            <h2 class="fs-lg-55 fs-24 mb-0"><?php echo $title_meet_the_team; ?></h2>
                        </div>
                    </div>
                    <div class="team-intro row">
                        <div class="col-12 col-lg-4 border-end ">
                            <div class="team-description fs-16 fs-lg-18">
                                <?php echo $description_meet_the_team; ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="team-list">
                                <?php foreach ($list_team as $team) : ?>
                                    <?php if ($team['feature_team'] == true) : ?>
                                        <div class="team-member row d-flex align-items-start  py-1">
                                            <div class="avatar col-lg-4 col-12 fs-14 fs-lg-18 my-lg-0 my-2 text-center"><img src="<?php echo $team['avatar']['url']; ?>"></div>
                                            <div class="position col-lg-8 col-12 fs-14 fs-lg-18">
                                                <div class="name"><strong><?php echo $team['name']; ?></strong></div>
                                                <div class="position"><?php echo $team['position']; ?></div>
                                                <div class="description pt-1"><?php echo $team['description']; ?></div>
                                                <div class="social">
                                                    <?php if ($team['social_media']): ?>
                                                        <?php foreach ($team['social_media'] as $social) : ?>
                                                            <a href="<?php echo $social['link_social']; ?>"><img width="50" height="50" src="<?php echo $social['icon_social']['url']; ?>"></a>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
<?php
        endwhile;
    endif;

    return ob_get_clean();
}
add_shortcode('meet_the_team', 'meet_the_team_shortcode');

?>