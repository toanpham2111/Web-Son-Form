<?php

function load_more_members()
{
    if (!isset($_POST['action']) || $_POST['action'] !== 'load_more_members') {
        wp_send_json_error('Invalid request.');
        wp_die();
    }

    if (!isset($_POST['page_id']) || empty($_POST['page_id'])) {
        wp_send_json_error('Missing page ID.');
        wp_die();
    }

    $page_id = intval($_POST['page_id']);

    $members_html = '<div class="team-grid row my-lg-4 my-2">';

    if (have_rows('meet_the_team', $page_id)) {
        while (have_rows('meet_the_team', $page_id)) : the_row();
            $list = get_sub_field('list_team');

            foreach ($list as $member) {
                if (isset($member['feature_team']) && $member['feature_team'] === true) {
                    continue;
                }
                $name = $member['name'];
                $position = $member['position'];
                $avatar = $member['avatar'];

                $members_html .= '<div class="member-item col-12 col-lg-3 my-2">';
                if ($avatar) {
                    $members_html .= '<div class="avatar-wrapper mb-2"><img class="member-avatar w-100 h-300px position-relative object-contain d-block" src="' . esc_url($avatar['url']) . '" alt="' . esc_attr(get_the_post_thumbnail_caption()) . '"></div>';
                } else {
                    $members_html .= '<div class="square no-shadow mb-1"></div>';
                }
                $members_html .= '<div class="text-center">';
                $members_html .= '<p class="member-name mb-1 fw-bold fs-18">' . esc_html($name) . '</p>';
                $members_html .= '<p class="member-position mb-1 fs-16">' . esc_html($position) . '</p>';
                $members_html .= '</div>';
                $members_html .= '</div>';
            }
        endwhile;

        $members_html .= '</div>';

        wp_send_json_success(array('html' => $members_html));
    } else {
        wp_send_json_error('No members found.');
    }

    wp_die();
}

add_action('wp_ajax_load_more_members', 'load_more_members');
add_action('wp_ajax_nopriv_load_more_members', 'load_more_members');
