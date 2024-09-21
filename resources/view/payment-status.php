<?php get_header(); ?>

<div class="header">
    <div class="header-box" style="height: 70px;">
        <div class="d-flex align-items-center justify-content-between p-3 text-white">
            <h6 class="text-center m-0 flex-grow-1">
                <?php echo __('الدفع الالكتروني!', 'qeema'); ?>
            </h6>
            <a hx-get="<?php echo site_url('home/'); ?>" hx-swap="innerHTML" hx-trigger="click" hx-target=".app" class="d-block go-back text-white">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>
    </div>
</div>

<div class="container d-flex align-items-center justify-content-center" style="height: 90vh;">
    <div class="text-center">
        <div class="text-center mb-3">
            <?php if ($params['code'] == 200) : ?>
                <img src="<?php echo get_template_directory_uri() . '/assets/images/check.png'; ?>" alt="">
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri() . '/assets/images/close.png'; ?>" alt="">
            <?php endif; ?>
        </div>
        <h5 class="mb-3">
            <?php
            echo str_replace('%20', ' ', $params['msg']);
            echo ($params['code'] != 200) ? ' (Error code ' . $params['code'] . ')' : '';
            ?>
        </h5>
        <a hx-get="<?php echo site_url('home/'); ?>" hx-swap="innerHTML" hx-trigger="click" hx-target=".app" class="px-4 btn btn-danger">
            <?php echo __('العوده الي الرئيسية', 'qeema'); ?>
        </a>
    </div>
</div>

<?php get_footer(); ?>