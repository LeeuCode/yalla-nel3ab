<?php
$paged = ($params['num']) ?  $params['num'] : 1;

$args = array(
    'post_type' => 'academy',
    'posts_per_page' => 4,
    'paged' => $paged,
    'tax_query' => array(
        array(
            'taxonomy' => 'section',
            'field' => 'term_id',
            'terms' => array($params['term_id'])
        )
    )
);

if (input_exist('s', 'get')) {
    $args['s'] = input_exist('s', 'get');
}

$query = new WP_Query($args);

$count = 0;

if ($query->have_posts()):
    while ($query->have_posts()):
        $query->the_post();

        $t = ($count == 3) ? 'hx-get="' . get_next_posts_page_link($query->max_num_pages) . '" hx-trigger="revealed"
                    hx-swap="afterend"' : '';
?>
        <div class="col-12" <?php echo (get_next_posts_page_link($query->max_num_pages)) ? $t : ''; ?>>
            <div class="shadow-sm mb-3 position-relative">
                <img class="img-fluid" src="<?php the_field('basic_image', $post->ID); ?>" alt="">
                <div class="position-absolute bottom-0 start-0 p-3">
                    <h6 class="text-white mb-1">
                        <?php echo the_title(); ?>
                    </h6>
                    <div class="d-flex gap-2 align-items-center">
                        <span class="text-white small"><?php echo __('تقييم الخدمة', 'qeema'); ?></span>
                        <div class="user-rate checked  small">
                            <input type="radio" name="rate" value="5">
                            <input type="radio" name="rate" value="4">
                            <input type="radio" name="rate" value="3">
                            <input type="radio" name="rate" value="2">
                            <input type="radio" name="rate" value="1" checked="">
                        </div>
                    </div>
                </div>
                <a hx-get="<?php echo site_url('booking/academy/' . $post->ID . '/'); ?>" hx-swap="innerHTML show:top"
                    hx-trigger="click" hx-target=".app" class="z-index-2 stretched-link"></a>
            </div>
        </div>
<?php
        $count++;
    endwhile;
endif;
?>