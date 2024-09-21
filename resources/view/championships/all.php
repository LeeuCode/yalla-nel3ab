<?php

$link = site_url('home/');

require_once component('heading');
?>

<div class="container pt-4 position-relative">
    <div class="row">
        <div class="d-flex gap-3 overflow-x-scroll justify-content-center">
            <?php
            $sections = get_terms(
                array(
                    'taxonomy' => 'section',
                    'hide_empty' => false,
                )
            );

            foreach ($sections as $section):
            ?>
                <div class="form-check p-0 small mb-3">
                    <input type="radio" class="form-check-input lc-check-box d-none"
                        id="section-activity-<?php echo $section->term_id; ?>" name="activity_cat" value="<?php echo $section->term_id; ?>">
                    <label class="form-check-label lc-check-box-label text-center rounded-3 font-x-12 py-1"
                        for="section-activity-<?php echo $section->term_id; ?>" hx-get="<?php echo site_url('champion/category/' . $section->term_id . '/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".ativities-by-category">
                        <img class="icon-md" src="<?php the_field('icon', 'section_' . $section->term_id); ?>" alt="">
                        <img class="icon-md hidden" src="<?php the_field('icon_active', 'section_' . $section->term_id); ?>"
                            alt="">
                        <span class="d-block mt-2 fw-bold font-x-11"><?php echo $section->name ?></span>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="col-12">
            <h6 class="fw-bold small my-3"><?php echo __('التاريخ', 'qeema'); ?></h6>

            <div class="d-flex flex-row gap-2 overflow-x-scroll">

                <?php
                $days = 7;
                for ($i = 0; $i <= $days; $i++) {
                ?>

                    <div class="form-check p-0 small mb-2">
                        <input type="radio" class="form-check-input lc-check-box d-none" id="day-<?php echo $i; ?>"
                            name="day" value="1" <?php echo ($id == 0) ? 'checked' : ''; ?>>
                        <label class="form-check-label lc-check-box-label text-center rounded-3 small"
                            for="day-<?php echo $i; ?>">
                            <span class="h6 fw-bold d-block">
                                <?php echo date('d', strtotime(date("d-m-Y") . ' +' . $i . ' day')); ?>
                            </span>
                            <?php echo date('D', strtotime(date("d-m-Y") . ' +' . $i . ' day')); ?>
                        </label>
                    </div>

                <?php } ?>
            </div>
        </div>

        <div class="col-12">
            <h6 class="fw-bold small mt-4 mb-3">
                <?php echo __('الطلبات النشطة', 'qeema'); ?>
            </h6>
        </div>

        <div class="ativities-by-category">
            <?php
            $args = array(
                'post_type' => 'champ',
                'posts_per_page' => 15,
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
        </div>
    </div>
</div>

<?php require_once component('footer-menu'); ?>