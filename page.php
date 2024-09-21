<?php

get_header('global');

$link = site_url('home/');

require_once component('heading');

echo '<div class="container py-5">
        <div class="row">';
if (have_posts()) {
    while (have_posts()) {
        the_post();

        the_content();
    }
}

echo '
        </div>
    </div>';

require_once component('footer-menu');

get_footer();
