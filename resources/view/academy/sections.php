<?php

$link = site_url('home/');

require_once component('heading');
?>


<div class="container">
    <div class="row">
        <?php

        $category = 'academies/section/';

        include component('search-categories');
        ?>

        <div class="categories-container">
            <?php

            $sections = get_terms(
                array(
                    'taxonomy' => 'section',
                    'hide_empty' => false,
                    'meta_query' => array(
                        array(
                            'key'       => 'show_status',
                            'value'     => 'academy',
                            // 'compare'   => '='
                        )
                    )
                )
            );

            foreach ($sections as $section) :
            ?>
                <div class="col-12">
                    <div class="shadow-sm mb-3 position-relative">
                        <img class="img-fluid" src="<?php the_field('image', 'section_' . $section->term_id); ?>" alt="">
                        <div class="position-absolute bottom-0 start-0 p-3">
                            <h6 class="text-white mb-1">
                                <?php echo $section->name; ?>
                            </h6>
                            <!-- <div class="d-flex gap-2 align-items-center">
                            <span class="text-white small"><?php echo __('تقييم الخدمة', 'qeema'); ?></span>
                            <div class="user-rate checked  small">
                                <input type="radio" name="rate" value="5">
                                <input type="radio" name="rate" value="4">
                                <input type="radio" name="rate" value="3">
                                <input type="radio" name="rate" value="2">
                                <input type="radio" name="rate" value="1">
                            </div>
                        </div> -->
                        </div>
                        <a hx-get="<?php echo site_url('academies/section/' . $section->term_id . '/'); ?>" hx-swap="innerHTML transition:true show:top" hx-target="closest .app" hx-trigger="click" hx-on::before-request="showLoad()" class="z-index-2 stretched-link"></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require_once component('footer-menu'); ?>