<?php
get_template_part('template-parts/page', 'heading', [
    'backTo' => site_url('/'),
    'title' => __('خدمة توثيق عقود الأجانب', 'qeema'),
    'imageLink' => get_template_directory_uri() . '/assets/images/bg-section-02.png',
    'imageTitle' => __('خدمة توثيق عقود الأجانب', 'qeema')
]);
?>

<div class="container px-4">
    <div class="row">
        <div class="col-12">
            <h6 class="border-bottom py-3 fw-bold border-nav mb-3">
                <?php echo __('اختار من الحدمات', 'qeema'); ?>
            </h6>
        </div>

        <div class="col-12">
            <div class="position-relative rounded-3 mb-3">
                <img class="w-100 rounded-5 shadow-sm m-0" src="<?php echo get_template_directory_uri() . '/assets/images/service-01.png'; ?>" alt="">
                <h6 class="text-white w-100 px-4 py-1 mb-0 position-absolute bottom-0 start-50 translate-middle">
                    <?php echo __('عقود زواج', 'qeema'); ?>
                </h6>
                <a hx-get="<?php echo site_url('marriage/booking/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-on::before-request="showLoad()" hx-target=".app" class="stretched-link"></a>
            </div>
        </div>

        <div class="col-12">
            <div class="position-relative rounded-3 mb-3">
                <img class="w-100 rounded-5 shadow-sm m-0" src="<?php echo get_template_directory_uri() . '/assets/images/service-02.png'; ?>" alt="">
                <h6 class="text-white w-100 px-4 py-1 mb-0 position-absolute bottom-0 start-50 translate-middle">
                    <?php echo __('عقود الطلاق', 'qeema'); ?>
                </h6>
                <a hx-get="<?php echo site_url('divorce/contracts/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="stretched-link"></a>
            </div>
        </div>
    </div>
</div>