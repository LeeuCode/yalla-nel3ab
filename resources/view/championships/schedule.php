<?php

$link = site_url('home/');

require_once component('heading');
?>

<div class="container py-3">
    <div class="row">
        <div class="col-12">
            <h6 class="fw-bold text-center mb-3">
                <?php echo __('جداول البطولات', 'qeema'); ?>
            </h6>
        </div>


        <?php
        $paged = ($params['num']) ?  $params['num'] : 1;
        $args = array(
            'post_type' => 'champion_calendar',
            'posts_per_page' => 15,
            'paged' => $paged,
        );
        $query = new WP_Query($args);

        $count = 0;

        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();

                $t = ($count == 3) ? 'hx-get="' . get_next_posts_page_link($query->max_num_pages) . '" hx-trigger="revealed"
                hx-swap="afterend"' : '';

                $champ_id = get_post_meta($post->ID, 'champ_id', TRUE);
                // $team_avatar = get_post_meta($post->ID, 'team_avatar', true);
        ?>
                <div class="col-12">
                    <div class="d-flex gap-2 p-3 bg-white rounded-2 shadow mb-3 position-relative">
                        <img src="<?php echo get_template_directory_uri() . '/assets/images/custom-logo.png' ?>" alt="" class="icon-xl rounded-2 shadow">
                        <div>
                            <h6 class="font-x-12 fw-bold">
                                <?php the_title();  ?>
                            </h6>
                            <div class="d-flex flex-wrap justify-content-between gap-2 mb-1">
                                <span class="text-secondary font-x-12">
                                    <i class="fa-solid fa-people-group"></i>
                                    <?php echo get_post_meta($champ_id, 'team_count', true); ?>
                                </span>

                                <span class="text-secondary font-x-12">
                                    <i class="fa-regular fa-calendar-days"></i>
                                    <?php echo get_field('start_date', $champ_id); ?>
                                </span>

                                <span class="text-secondary font-x-12">
                                    <i class="fa-solid fa-hourglass-start"></i>
                                    <?php echo get_field('start_time', $champ_id); ?>
                                </span>

                                <span class="text-secondary font-x-12">
                                    <i class="fa-solid fa-hourglass-end"></i>
                                    <?php echo get_field('end_time', $champ_id); ?>
                                </span>
                            </div>

                            <p class="font-x-12 mb-1">
                                <i class="fa-regular fa-futbol text-secondary"></i>
                                <?php
                                $playground =  get_field('playground', $champ_id);
                                echo get_the_title($playground);
                                ?>
                            </p>

                            <p class="font-x-12 mb-1">
                                <i class="fa-solid fa-location-dot text-secondary"></i>
                                <?php echo get_field('location', $champ_id); ?>
                            </p>
                        </div>
                        <a hx-get="<?php echo site_url('championships/schedule/table/' . $post->ID . '/') ?>" hx-target=".app" hx-on::before-request="showLoad()" class="stretched-link"></a>
                    </div>
                </div>
        <?php
            endwhile;
        endif;
        ?>
    </div>
</div>

<?php require_once component('footer-menu'); ?>