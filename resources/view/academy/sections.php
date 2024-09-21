<?php

$link = site_url('home/');

require_once component('heading');
?>


<div class="container">
    <div class="row">
        <div class="col-12">
            <form action="<?php echo home_url(); ?>" method="GET" class="search-bar my-4">
                <input name="s" type="text" class="py-2 form-control form-control-sm search-input shadow-sm" placeholder="<?php echo __('البحث', 'qeema'); ?>">

                <input type="hidden" name="post_type" value="product">

                <button class="btn btn-search-bar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>

        <?php
        $sections = get_terms(
            array(
                'taxonomy' => 'section',
                'hide_empty' => false,
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
                    <a hx-get="<?php echo site_url('academies/section/' . $section->term_id . '/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="z-index-2 stretched-link"></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once component('footer-menu'); ?>