<?php

$term_id = $params['term_id'];

$args = array(
    'post_type' => 'activity',
    'posts_per_page' => 15,
    'meta_key' => 'activity_cat',
    'meta_value' => $term_id,
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) :
        $query->the_post();

        include component('activity-block');

    endwhile;
else :
?>
    <div class="w-75 mx-auto text-center">
        <img class="w-100 d-block mb-3" src="<?php echo get_template_directory_uri() . '/assets/images/not-found.svg'; ?>" alt="">
        <p class="mb-2"><?php echo __('لا يوجد اي نشطات حتي الان', 'qeema'); ?></p>
        <!-- <a hx-get="<?php echo site_url('home/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="btn btn-danger px-5">
            <?php echo __('العوده الي الرئيسيه', 'qeema'); ?>
        </a> -->
    </div>
<?php
endif;
?>