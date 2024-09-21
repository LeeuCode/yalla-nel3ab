<?php

//---- ACF Functions ----//
require_once get_template_directory() . '/includes/acf-fields.php';

//---- Ajax Functions ----//
require_once get_template_directory() . '/includes/ajax.php';

//---- Create a custom post types ----//
require_once get_template_directory() . '/includes/custom-post-types.php';

//---- Create a Meta Boxs ----//
require_once get_template_directory() . '/includes/meta-boxs.php';

//---- Helper files get all functions and hooks ----//
require_once get_template_directory() . '/includes/helpers.php';

//---- Get Elementor View Path ----//
function getElementorView($fileName)
{
    $path = get_template_directory() . '/includes/elementor/views/';
    $filePath = $path . $fileName . '.php';

    return $filePath;
}

function change_login_page_style()
{
?>
    <style type="text/css">
        #login h1 a,
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/qeema.webp);
            height: auto;
            width: 100%;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }

        .login {
            background-image: url(https://www.qeematech.net/wp-content/uploads/2019/10/home-2-bg.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

        #nav a,
        #backtoblog a,
        #language-switcher span {
            color: #fff !important;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'change_login_page_style');

/**
 * Admin page for the 'country' taxonomy
 */
function cb_add_country_taxonomy_admin_page()
{
    $tax = get_taxonomy('country');

    add_users_page(
        esc_attr($tax->labels->menu_name),
        esc_attr($tax->labels->menu_name),
        $tax->cap->manage_terms,
        'edit-tags.php?taxonomy=' . $tax->name
    );
}
add_action('admin_menu', 'cb_add_country_taxonomy_admin_page');

function uploadFile($file)
{
    if (!function_exists('wp_crop_image')) {
        include(ABSPATH . 'wp-admin/includes/image.php');
    }

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

function post_count_meta($meta_key, $meta_value)
{
    global $wpdb;

    $query = $wpdb->get_results("SELECT COUNT(*) as order_count, post_id FROM {$wpdb->prefix}postmeta 
                            WHERE meta_key = '$meta_key'
                            AND meta_value = '$meta_value' ");

    return $query;
}

function cutText($text, $chars = 25) {
    if (strlen($text) <= $chars) {
        return $text;
    }
    $text = $text." ";
    $text = substr($text,0,$chars);
    $text = substr($text,0,strrpos($text,' '));
    $text = $text."...";
    return $text;
}
add_filter('show_admin_bar', '__return_false');
