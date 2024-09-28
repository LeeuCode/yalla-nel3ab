<?php

$link = site_url('home/');

require_once component('heading');

$user_id = get_current_user_id();

$favorite_post = get_user_meta($user_id, 'favorite_post', false);

?>

<div class="container bg-white- py-4 w-100">
    <div class="row">
        <?php

        $query = new WP_Query(
            array(
                'post_type' => 'any',
                // 'post_status' => array('pending', 'publish', 'draft'),
                'posts_per_page' => 10,
                'post__in' => $favorite_post
            )
        );
        ?>
        <?php
        if ($query->have_posts()):
            while ($query->have_posts()):
                $query->the_post();
                $type = $post->post_type;
                include component($type . '-block');
            endwhile;
        ?>

        <?php else: ?>

            <div class="w-75 mx-auto text-center mt-5">
                <img class="w-100 d-block mb-3" src="<?php echo get_template_directory_uri() . '/assets/images/not-found.svg'; ?>" alt="">
                <p class="mb-2"><?php echo __('لا يوجد اي مفضله حتي الان', 'qeema'); ?></p>
                <a hx-get="<?php echo site_url('home/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="btn btn-danger px-5">
                    <?php echo __('العوده الي الرئيسيه', 'qeema'); ?>
                </a>
            </div>

        <?php endif;  ?>
    </div>
</div>

<?php require_once component('footer-menu'); ?>