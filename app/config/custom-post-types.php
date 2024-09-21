<?php

use LC\CPT;

/*=============================
    [01. Create Post Types]
===============================*/

require_once get_template_directory() . "/app/config/types/playground.php";

require_once get_template_directory() . "/app/config/types/gym.php";

require_once get_template_directory() . "/app/config/types/bookings.php";

require_once get_template_directory() . "/app/config/types/coach.php";

require_once get_template_directory() . "/app/config/types/booking-coach.php";

require_once get_template_directory() . "/app/config/types/activities.php";

require_once get_template_directory() . "/app/config/types/store.php";

require_once get_template_directory() . "/app/config/types/order.php";

require_once get_template_directory() . "/app/config/types/academies.php";

require_once get_template_directory() . "/app/config/types/champs.php";

require_once get_template_directory() . "/app/config/types/booking-champion.php";

require_once get_template_directory() . "/app/config/types/champion-calendar.php";

function change_post_menu_label_icon()
{
    global $menu;

    $menu[2][6] = get_template_directory_uri() . '/assets/images/icons/speedometer.png';
    $menu[25][6] = get_template_directory_uri() . '/assets/images/icons/comments.png';
    $menu[60][6] = get_template_directory_uri() . '/assets/images/icons/app-design.png';
    $menu[65][6] = get_template_directory_uri() . '/assets/images/icons/plug.png';
    $menu[70][6] = get_template_directory_uri() . '/assets/images/icons/man.png';
    $menu[75][6] = get_template_directory_uri() . '/assets/images/icons/widget.png';
    $menu[80][6] = get_template_directory_uri() . '/assets/images/icons/settings.png';
}
add_action('admin_menu', 'change_post_menu_label_icon');
