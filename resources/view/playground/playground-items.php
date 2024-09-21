<?php
$paged = ($params['num']) ?  $params['num'] : 1;

$args = array(
    'post_type' => 'playground',
    'posts_per_page' => 4,
    'paged' => $paged,
    'tax_query' => array(
        array(
            'taxonomy' => 'section',
            'field' => 'term_id',
            'terms' => array($params['id'])
        )
    )
);
$query = new WP_Query($args);

$count = 0;

if ($query->have_posts()) :
    while ($query->have_posts()) :
        $query->the_post();

        $t = ($count == 3) ? 'hx-get="' . get_next_posts_page_link($query->max_num_pages) . '" hx-trigger="revealed"
                    hx-swap="afterend"' : '';
?>
        <div class="col-12" <?php echo (get_next_posts_page_link($query->max_num_pages)) ? $t : ''; ?>>
            <div class="mb-3 position-relative">
                <img class="img-fluid mb-2" src="<?php the_field('basic_image'); ?>" alt="">
                <div class="d-flex w-100 justify-content-between">
                    <div class="d-flex align-items-center- gap-2">
                        <img src="<?php the_field('image_url'); ?>" alt="" class="icon-sm rounded-circle">
                        <div>
                            <h6 class="text-dark fw-bold font-x-12 mb-0">
                                <?php the_title(); ?>
                            </h6>
                            <span class="text-secondary font-x-11 mb-0">
                                <?php echo get_first_term_by_id($post->ID, 'section', 'name'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <span class="text-white small"><?php echo __('تقييم الخدمة', 'qeema'); ?></span>
                        <div class="user-rate checked small">
                            <input type="radio" name="rate" value="5">
                            <input type="radio" name="rate" value="4">
                            <input type="radio" name="rate" value="3">
                            <input type="radio" name="rate" value="2">
                            <input type="radio" name="rate" value="1" checked="">
                        </div>
                    </div>
                </div>
                <a hx-get="<?php echo site_url('playground/single/' . $post->ID . '/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="z-index-2 stretched-link"></a>
            </div>
        </div>
<?php
        $count++;
    endwhile;
endif;
?>