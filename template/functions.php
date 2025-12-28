<?php

require_once __DIR__ . '/vendor/autoload.php';

// Clean up wordpres <head>
remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'wp_generator'); // remove wordpress version
remove_action(
    'wp_head',
    'feed_links',
    2
); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

//custom theme need add function
// function mytheme_add_woocommerce_support()
// {
//     add_theme_support('woocommerce');
// }

//add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

$prefixScript = wp_get_theme() . '_';

if (!is_admin()) {
    add_filter('script_loader_tag', 'defer_scripts', 10, 3);

    function defer_scripts($tag, $handle, $src)
    {
        global $prefixScript;

        if (strpos($handle, $prefixScript) === false) {
            return $tag;
        }

        return str_replace(' src', ' defer src', $tag);
    }

    add_filter('style_loader_tag', 'async_style', 10, 3);

    function async_style($tag, $handle, $src)
    {
        global $prefixScript;

        if (strpos($handle, $prefixScript) === false) {
            return $tag;
        }

        return '<link href="' . $src . '" rel="preload" as="style" onload="this.rel=\'stylesheet\'">';
    }

    add_action('wp_head', 'criticalCss', 1);

    function criticalCss()
    {
        $criticalPath = get_template_directory() . '/css/critical.css';

        if (file_exists($criticalPath)) {
            echo '<style type="text/css">' . file_get_contents($criticalPath) . '</style>';
        }
    }
}

add_action('wp_enqueue_scripts', function () {
    $manifest = json_decode(file_get_contents('assets-manifest.json', true));

    addAssets($manifest, 'app');

    if (is_front_page()) {
        addAssets($manifest, 'template.homepage');
    }

    // Templates
    $template = get_page_template();
    $path     = pathinfo($template);

    $templateEntry = str_replace('-', '.', $path['filename']);
    addAssets($manifest, $templateEntry);

    // webpackWooCommerce($manifest);
}, 100);

// function webpackWooCommerce($manifest)
// {
//     $entrypoints = $manifest->entrypoints;

//     if (is_shop() && isset($entrypoints->{'woocommerce.shop'})) {
//         addAssets($manifest, 'woocommerce.shop');
//     }

//     if (is_product_category() && isset($entrypoints->{'woocommerce.category'})) {
//         addAssets($manifest, 'woocommerce.category');
//     }

//     if (is_product() && isset($entrypoints->{'woocommerce.product'})) {
//         addAssets($manifest, 'woocommerce.product');
//     }

//     if (is_cart() && isset($entrypoints->{'woocommerce.cart'})) {
//         addAssets($manifest, 'woocommerce.cart');
//     }

//     if (is_checkout() && isset($entrypoints->{'woocommerce.checkout'})) {
//         addAssets($manifest, 'woocommerce.checkout');
//     }
// }

function addAssets($manifest, $entrypoint)
{
    global $prefixScript;
    $entrypoints = $manifest->entrypoints;

    if ($entrypoints->{$entrypoint}->assets) {
        $assets = $entrypoints->{$entrypoint}->assets;

        if ($assets->css) {
            if ($entrypoint == 'app' && file_exists(get_template_directory() . '/css/app-uncritical.css')) {
                $css = get_template_directory_uri() . '/css/app-uncritical.css';
                wp_enqueue_style($prefixScript . 'app-uncritical', $css, array(), filemtime(get_template_directory() . '/css/app-uncritical.css'), null);
            } else {
                foreach ($assets->css as $css) {
                    wp_enqueue_style($prefixScript . md5($css), $css, false, null);
                }
            }
        }

        if ($assets->js) {
            foreach ($assets->js as $js) {
                wp_enqueue_script($prefixScript . md5($js), $js, false, null, true);
            }
        }
    }

    $detect = new Mobile_Detect;

    if (!$detect->isMobile()) {
        if ($manifest->{$entrypoint . '-tablet.css'}) {
            $css = $manifest->{$entrypoint . '-tablet.css'};
            wp_enqueue_style($prefixScript . md5($css), $css, false, null);
        }
        if ($manifest->{$entrypoint . '-desktop.css'}) {
            $css = $manifest->{$entrypoint . '-desktop.css'};
            wp_enqueue_style($prefixScript . md5($css), $css, false, null);
        }
    }
}

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     *
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');
    /**
     * Enable plugins to manage the document title
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');
    /**
     * Register navigation menus
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'mini'),
    ]);
    /**
     * Enable post thumbnails
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');
    /**
     * Enable HTML5 markup support
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);
    /**
     * Enable selective refresh for widgets in customizer
     *
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    // add_theme_support('customize-selective-refresh-widgets');
}, 20);


add_action('rest_api_init', function () {
    $namespace = 'presspack/v1';
    register_rest_route($namespace, '/path/(?P<url>.*?)', array(
        'methods'  => 'GET',
        'callback' => 'get_post_for_url',
    ));
});

/**
 * This fixes the wordpress rest-api so we can just lookup pages by their full
 * path (not just their name). This allows us to use React Router.
 *
 * @return WP_Error|WP_REST_Response
 */
function get_post_for_url($data)
{
    $postId     = url_to_postid($data['url']);
    $postType   = get_post_type($postId);
    $controller = new WP_REST_Posts_Controller($postType);
    $request    = new WP_REST_Request('GET', "/wp/v2/{$postType}s/{$postId}");
    $request->set_url_params(array('id' => $postId));

    return $controller->get_item($request);
}

add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)

// remove update notice for forked plugins
function remove_update_notifications($value)
{

    if (isset($value) && is_object($value)) {
        unset($value->response['advanced-custom-fields-pro/acf.php']);
        unset($value->response['filebird-pro/filebird.php']);
        unset($value->response['fixed-toc/fixed-toc.php']);
    }

    return $value;
}
add_filter('site_transient_update_plugins', 'remove_update_notifications');

// Allow SVG
// Wp v4.7.1 and higher
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
    $filetype = wp_check_filetype($filename, $mimes);
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}, 10, 4);

function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
}
add_action('admin_head', 'fix_svg');

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}


add_action('widgets_init', 'register_multiple_widget_areas');

function register_multiple_widget_areas()
{
    // Arguments used in all register_sidebar() calls.
    $shared_args = array(
        'before_title'  => '<h3 class="widget-title subheading heading-size-3">',
        'after_title'   => '</h3>',
        'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
    );
    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name'        => 'Header',
                'id'          => 'header-widget',
                'description' => 'Goes at the top of the page.',
            )
        )
    );
    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name'        => 'Footer Top',
                'id'          => 'footer-top',
                'description' => 'Goes at the bottom of the page.',
            )
        )
    );
    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name'        => 'Copyright',
                'id'          => 'copyright',
                'description' => 'Goes at the bottom of the page.',
            )
        )
    );
    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name'        => 'Footer Logo',
                'id'          => 'footer-logo',
                'description' => 'Goes at the bottom of the page.',
            )
        )
    );
    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name'        => 'Thông tin và địa chỉ',
                'id'          => 'our-address',
                'description' => 'Goes at the top of the page.',
            )
        )
    );
    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name'        => 'Social Media',
                'id'          => 'social-media',
                'description' => 'Goes at the bottom of the page.',
            )
        )
    );
    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name'        => 'Logo Bộ Công Thương',
                'id'          => 'logo-bocongthuong',
                'description' => 'Goes at the bottom of the page.',
            )
        )
    );
    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name'        => 'Quick Links',
                'id'          => 'quick-links',
                'description' => 'Goes at the top of the page.',
            )
        )
    );
}


add_theme_support('custom-logo');

function themename_custom_logo_setup()
{
    $defaults = array(
        'height'               => 155,
        'width'                => 132,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array('site-title', 'site-description'),
        'unlink-homepage-logo' => true,
    );
    add_theme_support('custom-logo', $defaults);
}

add_action('after_setup_theme', 'themename_custom_logo_setup');


/**
 * Function   : custom_pagination()
 * Description  : Custome & style for pagination
 *
 * @return    : pagination
 */
function custom_pagination($numpages = '', $pagerange = '', $paged = '', $show_first_last = true)
{
    /*set default page mid size*/
    if (empty($pagerange)) {
        $pagerange = 2;
    }
    /*set default page current*/
    global $paged;
    if (empty($paged)) {
        $paged = 1;
    }
    /*set default numpages total*/
    if ($numpages == '') {
        global $wp_query;
        $numpages = $wp_query->max_num_pages;
        if (! $numpages) {
            $numpages = 1;
        }
    }

    /*fix url param of salon*/
    if (isset($_GET['term_id']) && (is_page('columnlist') || is_page('cau-chuyen-thanh-cong'))) {
        $paramURL = '?term_id=' . $_GET['term_id'];
    } else {
        $paramURL = '';
    }

    $strBase = get_pagenum_link(1) . '%_%';

    /*config*/
    $pagination_args = array(
        'base'               => str_replace($paramURL, '', $strBase),
        'format'             => '/page/%#%',
        'total'              => $numpages,
        'current'            => $paged,
        'show_all'           => false,
        'end_size'           => 1,
        'mid_size'           => $pagerange,
        'prev_next'          => true,
        'prev_text'          => __('<img src="/wp-content/uploads/2024/04/prev.png" alt="" />'),
        'next_text'          => __('<img src="//wp-content/uploads/2024/04/next.png" alt="" />'),
        'type'               => 'plain',
        'add_args'           => false,
        'add_fragment'       => '',
        'before_page_number' => '',
        'after_page_number'  => '',
    );
    /*create page link*/
    $paginate_links = paginate_links($pagination_args);

    /*layout*/
    if ($paginate_links) {
        echo "<div class='container'><div class='st-pagelink mb-3' data='" . $paged . "'>";
        echo $paginate_links;
        echo "</div></div>";
    }
}

/**
 * Function   : getlist_posts()
 * Description  : Get list
 *
 * @return    : array post
 */
function getlist_posts($atts)
{
    /* default params */
    $atts = shortcode_atts(
        array(
            'max_posts'      => -1,
            'pagination'     => 'true',
            'limit_text'     => 0,
            'taxonomy'       => '',
            'term_id'        => '',
            'template'       => '',
            'filter'         => 'true',
            'paged'          => 1,
            'posts_per_page' => -1,
            'category'       => '',
            'category_name'  => '',
            'orderby'        => 'date',
            'order'          => 'DESC',
            'include'        => '',
            'exclude'        => '',
            'post_type'      => 'post',
            'post_parent'    => '',
            'author'         => '',
            'author_name'    => '',
            'post_status'    => 'publish',
            'hidden_content' => 'false',
        ),
        $atts
    );

    /* filter post by URL */
    // by category
    $cateID   = isset($_GET['cate_id']) ? $_GET['cate_id'] : $atts['category'];
    $taxonomy = isset($_GET['taxonomy']) ? $_GET['taxonomy'] : $atts['taxonomy'];


    //by term_id
    if (isset($_GET['term_id']) && $_GET['term_id'] != 0 && $atts['filter'] != 'false') {
        $termID           = $_GET['term_id'];
        $param_detail_url = '?term_id=' . $termID;
        $tax_query_custom = array(
            array(
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    => $termID,
            ),
        );
    } elseif ($atts['term_id'] != '') {
        $tax_query_custom = array(
            array(
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    => $atts['term_id'],
            ),
        );
    } else {
        $param_detail_url = '';
        $tax_query_custom = '';
    }

    /* count total posts */
    $count_post = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type'      => $atts['post_type'],
        'cat'            => $cateID,
        'tax_query'      => $tax_query_custom,
    ));
    $total_post = $count_post->post_count;

    /* query posts */
    $paged          = (get_query_var('paged')) ? get_query_var('paged') : $atts['paged'];
    $posts_per_page = $atts['max_posts'] != -1 ? $atts['max_posts'] : $atts['posts_per_page'];

    $getlist_posts = new WP_Query(array(
        'paged'          => $paged,
        'posts_per_page' => $posts_per_page,
        'cat'            => $cateID,
        'category_name'  => $atts['category_name'],
        'orderby'        => $atts['orderby'],
        'order'          => $atts['order'],
        'include'        => $atts['include'],
        'exclude'        => $atts['exclude'],
        'post_type'      => $atts['post_type'],
        'post_parent'    => $atts['post_parent'],
        'author'         => $atts['author'],
        'author_name'    => $atts['author_name'],
        'post_status'    => $atts['post_status'],
        'tax_query'      => $tax_query_custom,
        'pagination'     => $atts['pagination'],
    ));

    ob_start();
    if ($getlist_posts->have_posts()) {
        /* get template post list */
        if ($atts['template'] != '') {
            $template_file = $atts['template'];
        } else {
            $template_file = 'template-list/' . $atts['post_type'] . '.php';
        }
        include(locate_template($template_file));
        wp_reset_postdata();

        /* pagination */
        if ($atts['pagination'] == 'true' && function_exists('custom_pagination')) {
            echo '<div class="nav-links pager-list panigation-' . get_the_ID() . '">';
            custom_pagination($getlist_posts->max_num_pages, "2", $paged, true);
            echo '</div>';
        }
    } else {
        /* no post */
        //echo '<p>No post.</p>';
    }

    return ob_get_clean();
}

add_shortcode('GET_LIST', 'getlist_posts');

// change comment form fields order
add_filter('comment_form_fields', 'unset_comment_fields');
function unset_comment_fields($fields)
{
    unset($fields['url']);
    unset($fields['cookies']);

    return $fields;
}

function aims_validate_phone_number($result, $tag)
{
    if ('phone' !== strtolower($tag->name)) {
        return $result;
    }
    $phone_number = $_POST[$tag->name];
    $phone_regex = '/^\d{10,16}$/';
    if ($tag->is_required() && empty($phone_number)) {
        $result->invalidate($tag, wpcf7_get_message('invalid_required'));
    } else {
        if (! preg_match($phone_regex, $phone_number)) {
            $result->invalidate($tag, __('Xin nhập số điện thoại hợp lệ.', 'creative-design-lab'));
        }
    }
    return $result;
}
add_filter('wpcf7_validate_tel*', 'creative-design-lab_validate_phone_number', 20, 2);


function convert_to_webp($upload)
{
    $image_path = $upload['file'];
    // % compression (0-100)
    $compression_quality = 80;
    $supported_mime_types = array(
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
    );
    $image_info = getimagesize($image_path);
    if ($image_info !== false && array_key_exists($image_info['mime'], $supported_mime_types)) {
        $image = imagecreatefromstring(file_get_contents($image_path));
        if ($image) {
            if (imageistruecolor($image)) {
                $webp_path = preg_replace('/\.(jpg|jpeg|png)$/', '.webp', $image_path);
                imagewebp($image, $webp_path, $compression_quality);
                $upload['file'] = $webp_path;
                $upload['type'] = 'image/webp';

                unlink($image_path);
            } else {

                $upload['file'] = $image_path;
                $upload['type'] = $image_info['mime'];
            }
        }
    }
    return $upload;
}
function convert_to_webp_upload($upload)
{
    $upload = convert_to_webp($upload);
    return $upload;
}
add_filter('wp_handle_upload', 'convert_to_webp_upload');

function convert_to_embed_url($video_url)
{
    // Check if the URL contains "youtube.com/watch"
    if (strpos($video_url, 'youtube.com/watch') !== false) {
        // Parse the URL to extract the video ID
        parse_str(parse_url($video_url, PHP_URL_QUERY), $query);
        if (isset($query['v'])) {
            $video_id = $query['v'];
            // Return the embed URL
            return 'https://www.youtube.com/embed/' . $video_id;
        }
    }
    return $video_url;
}

function bcn_display() {
    if (!is_front_page()) {
        echo '<a class="text-capitalize" href="' . home_url() . '">Trang chủ</a>';
        echo '<span>';

        $current_url = $_SERVER['REQUEST_URI']; 
        $current_url = trim($current_url, '/');
        $url_parts = explode('/', $current_url);
        
        foreach ($url_parts as $key => $slug) {
            $page = get_page_by_path($slug, OBJECT, 'page'); 
            $title = $page ? get_the_title($page->ID) : ucfirst(str_replace('-', ' ', $slug)); 

            if ($key == count($url_parts) - 1) {
                echo ' > ' . '<span class="text-capitalize text-red">' . $title . '</span>';
            } else {
                $url = home_url() . '/' . implode('/', array_slice($url_parts, 0, $key + 1));
                echo ' > <a class="text-capitalize" href="' . esc_url($url) . '"><span class="text-capitalize">' . $title . '</span></a>';
            }
        }

        echo '</span>';
    }
}



// Hide admin bar
add_filter('show_admin_bar', '__return_false');

// Template Shortcode
$shortcode_directory = get_template_directory() . '/custom-functions';
$shortcode_files = glob($shortcode_directory . '/*.php');

if (! empty($shortcode_files)) {
    foreach ($shortcode_files as $file) {
        require_once $file;
    }
}
// Post views
function set_post_views($post_id)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);

    if ($count == '') {
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '1');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}

// Gọi hàm mỗi khi bài viết được xem
function track_post_views($post_id)
{
    if (!is_single()) return;
    if (empty($post_id)) $post_id = get_the_ID();
    set_post_views($post_id);
}
add_action('wp_head', 'track_post_views');
