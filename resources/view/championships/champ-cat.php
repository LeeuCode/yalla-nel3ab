<?php

$term_id = $params['term_id'];

$args = array(
    'post_type' => 'champ',
    'posts_per_page' => 15,
    'meta_key' => 'term_id',
    'meta_value' => $term_id,
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) :
        $query->the_post();

        include component('champion-block');

    endwhile;
else :
?>
    <div class="w-75 mx-auto text-center">
        <img class="w-100 d-block mb-3" src="<?php echo get_template_directory_uri() . '/assets/images/not-found.svg'; ?>" alt="">
        <p class="mb-2"><?php echo __('لا يوجد اي نشطات حتي الان', 'qeema'); ?></p>
    </div>
<?php
endif;
?>