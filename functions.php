<?php
session_start();
/**
 * LC Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package LC
 */

use LC\ThemeSetup;
use LC\Assets;

define('PATH_COMPONENT', '/resources/components/');

define('MERCHANT_CODE', '770000019684');

// a7e5c0b6-6c25-4b44-98ac-ce8f5cf4bdd9
define('MERCHANT_SEC_KEY', 'a7e5c0b6-6c25-4b44-98ac-ce8f5cf4bdd9');

require_once 'app/config/autoload.php';
require 'vendor/autoload.php';

require_once 'app/helpers.php';

require_once 'app/config/meta-boxs.php';

require_once 'app/helper/acf-fields.php';

require_once 'app/config/custom-post-types.php';

// Config Admin menus 
require_once 'app/config/admin-menus.php';

require_once 'routes/web.php';

ThemeSetup::instance();
Assets::instance();

// Removes WordPress admin bar from frontend 
add_filter('show_admin_bar', '__return_false');

// Remove l1on script associated with admin bar
add_action('init', 'remove_l1on');
function remove_l1on()
{
    if (!is_admin()) {
        wp_deregister_script('l10n');
    }
}

function dayName($code)
{
    $days = array(
        'set' => 'السبت',
        'sun' => 'الأحد',
        'mon' => 'الأثنين',
        'tue' => 'الثلاثاء',
        'wed' => 'الاربعاء',
        'thur' => 'الخميس',
        'fri' => 'الجمعه'
    );

    return $days[$code];
}

function dayClass($code)
{
    switch ($code) {
        case 'set':
            return 'badge rounded-1 py-1 px-2 text-bg-primary';
            break;

        case 'sun':
            return 'badge rounded-1 py-1 px-2 text-bg-info';
            break;

        case 'mon':
            return 'badge  rounded-1 py-1 px-2 text-bg-success';
            break;

        case 'tue':
            return 'badge rounded-1 py-1 px-2 text-bg-warning';
            break;

        case 'wed':
            return 'badge rounded-1 py-1 px-2 text-bg-danger';
            break;

        case 'thur':
            return 'badge rounded-1 py-1 px-2 text-bg-secondary';
            break;

        case 'fri':
            return 'badge rounded-1 py-1 px-2 text-bg-dark';
            break;


        default:
            return 'badge bg-dark';
            break;
    }
}

add_action('admin_head', 'my_custom_fonts');
function my_custom_fonts()
{
    echo '
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    ';
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">';
    // echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap-utilities.min.css">';
    echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/assets/css/custom-admin.css" type="text/css" media="all" />';
}

add_action('admin_menu', 'admin_menu_optimizer');

//========= Woocommerce Customizer ========//
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);


function get_pending_posts_bubble($post_type)
{
    global $menu;

    $post = new WP_Query(
        array(
            'post_type' => $post_type,
            'post_status' => 'pending',
            'posts_per_page' => -1,
        )
    );

    if ($post->post_count) {

        foreach ($menu as $key => $value) {

            if ($menu[$key][2] == 'edit.php?post_type=' . $post_type) {

                $menu[$key][0] .= '<span class="update-plugins count-2-"><span>' . $post->post_count . '</span></span>';

                return;
            }
        }
    }
}

add_action('admin_menu', 'add_user_menu_bubble');

function add_user_menu_bubble()
{
    get_pending_posts_bubble('marriage_contracts');

    get_pending_posts_bubble('extracting_leaves');

    get_pending_posts_bubble('couple_capsules');

    get_pending_posts_bubble('marriage_official');
}

function uploadFile($file)
{
    if (!function_exists('wp_crop_image')) {
        include(ABSPATH . 'wp-admin/includes/image.php');
    }

    // var_dump($file);
    // exit;
    $file_name = sanitize_file_name($file['name']);

    // first checking if tmp_name is not empty
    if (!empty($file['tmp_name'])) {
        // if not, then try creating a file on disk
        $upload = wp_upload_bits($file_name, null, file_get_contents($file['tmp_name']));

        // if wp does not return a file creation error
        if ($upload['error'] === false) {
            // then you can create an attachment
            $attachment = array(
                'post_mime_type' => $upload['type'],
                'post_title' => $file_name,
                'post_content' => '',
                'post_status' => 'inherit'
            );

            // creating an attachment in db and saving its ID to a variable
            $attach_id = wp_insert_attachment($attachment, $upload['file']);

            // generation of attachment metadata
            $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);

            // attaching metadata and creating a thumbnail
            wp_update_attachment_metadata($attach_id, $attach_data);

            return $attach_id;
        }
    }
}

function user_count_meta($user_id, $meta_key, $post_id)
{
    global $wpdb;

    $query = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}usermeta 
                            WHERE user_id = $user_id
                            AND meta_key = '$meta_key'
                            AND meta_value = '$post_id' ");

    return $query;
}

function input_exist($name, $type = 'post')
{
    $requset = $_POST;

    if ($type == 'get') {
        $requset = $_GET;
    }

    return (isset($requset[$name])) ? esc_sql($requset[$name]) : '';
}

function change_login_page_style()
{
?>
    <style type="text/css">
        #login h1 a,
        .login h1 a {
            background-image: url(https://www.qeematech.net/wp-content/uploads/2024/04/Asset-1@4xz-e1710850860352-300x163.png);
            height: auto;
            width: 100%;
            background-size: contain;
            background-repeat: no-repeat;
            padding-bottom: 20%;
        }

        .login {
            /* background-image: url(https://www.qeematech.net/wp-content/uploads/2019/10/home-2-bg.jpg); */
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

        #nav a,
        #backtoblog a,
        #language-switcher span {
            color: #022c8c !important;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'change_login_page_style');


function dateRange($first, $last, $step = '+1 day', $format = 'Y-m-d')
{
    $dates = [];
    $current = strtotime($first);
    $last = strtotime($last);

    while ($current <= $last) {

        $dates[] = date($format, $current);
        $current = strtotime($step, $current);
    }

    return $dates;
}

// Get first term by post id
function get_first_term_by_id($post_id, $taxonomy, $output = 'term_id')
{
    if (isset($post_id) && isset($taxonomy)) {
        $terms = get_the_terms($post_id, $taxonomy);

        if (!empty($terms) && !isset($terms->errors)) {
            $term = array_shift($terms);
        }
        return $term->$output;
    }
}

function lc_pagination($query, $paged = '', $max_pages = '')
{
    # Check if paged is not empty.
    $page = (!empty($paged)) ? $paged : get_query_var('paged');
    $max_num_pages = (!empty($max_pages)) ? $max_pages : $query->max_num_pages;

    $pages = paginate_links(
        array(
            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
            'total' => $max_num_pages,
            'current' => max(1, $page),
            'format' => '?page=%#%',
            'show_all' => false,
            'type' => 'array',
            'prev_next' => true,
            'prev_text' => sprintf('<i></i> %1$s', '<i class="icofont-simple-left"></i>'),
            'next_text' => sprintf('%1$s <i></i>', '<i class="icofont-simple-right"></i>'),
        )
    );

    if (is_array($pages)) {
        echo '<ul class="pagination aster-pagination justify-content-center m-0 pt-4 pb-0">';
        foreach ($pages as $page) {
            $page = str_replace('page-numbers', 'page-link', $page);
            if (strpos($page, 'current') !== false) {
                $page = str_replace("span", "a", $page);

                echo "<li class='active page-item'>$page</li>";
            } else {
                echo "<li class='page-item'>$page</li>";
            }
        }
        echo '</ul>';
    }
}

function split_files($files)
{
    if (isset($files['name']) && is_array($files['name'])) {
        for ($i = 0; $i < count($files['name']); $i++) {
            $file[] = array(
                'name' => $files['name'][$i],
                'type' => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['error'][$i],
                'size' => $files['size'][$i]
            );
        }

        return $file;
    }

    return false;
}
