<?php

$link = site_url('home/');

require_once component('heading');
?>

<div class="container bg-white- py-4 w-100">
    <div class="row">
        <?php

        // Get current user.
        $user = wp_get_current_user();

        $notification = new WP_Query(
            array(
                'post_type' => 'notification',
                'post_status' => array('pending', 'publish', 'draft'),
                'posts_per_page' => 10,
                'meta_query' => [
                    'relation' => 'AND',
                    [
                        'key' => 'to',
                        'value' => $user->ID
                    ]
                ]
            )
        );
        ?>
        <?php
        if ($notification->have_posts()):
            while ($notification->have_posts()):
                $notification->the_post();
                get_template_part('template-parts/notification-block');
            endwhile;
        ?>

        <?php else: ?>

            <div class="w-75 mx-auto text-center mt-5">
                <img class="w-100 d-block mb-3" src="<?php echo get_template_directory_uri() . '/assets/images/not-found.svg'; ?>" alt="">
                <p class="mb-2"><?php echo __('لا يوجد اي اشعارات حتي الان', 'qeema'); ?></p>
                <a hx-get="<?php echo site_url('home/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="btn btn-danger px-5">
                    <?php echo __('العوده الي الرئيسيه', 'qeema'); ?>
                </a>
            </div>

        <?php endif;  ?>
    </div>
</div>