<?php

$link = site_url('user/gyms/');

$post_id = $params['id'];

require_once component('heading');
?>

<div class="container py-4">
    <form hx-post="<?php echo site_url('user/academy/update/' . $post_id . '/'); ?>" hx-swap="innerHTML" hx-on::before-request="showLoad()" hx-on::after-request="hideLoad()" hx-target="#message" class="row">

        <input name="form_nonce" type="hidden" value="<?= wp_create_nonce('test-nonce') ?>" />

        <div class="col-lg-12 mb-4">
            <label for="post_title" class="form-label small mb-2 fw-bold">
                <?php echo __('اسم الملعب', 'qeema'); ?>
            </label>
            <input class="form-control form-control-sm" name="post_title" id="post_title" value="<?php echo get_the_title($post_id); ?>">
        </div>

        <div class="col-lg-12 mb-4">
            <label for="content" class="form-label small mb-2 fw-bold">
                <?php echo __('الوصف', 'qeema'); ?>
            </label>
            <textarea class="form-control form-control-sm" name="content" rows="4" id="content"><?php echo get_post_meta($post_id, 'content', true); ?></textarea>
        </div>

        <div class="col-lg-12 mb-4">
            <label for="address" class="form-label small mb-2 fw-bold">
                <?php echo __('عنوان الملعب', 'qeema'); ?>
            </label>
            <input class="form-control form-control-sm" name="address" id="address" value="<?php echo get_post_meta($post_id, 'address', true); ?>">
        </div>

        <div class="col-lg-12 mb-2">
            <label for="" class="form-label small mb-2 fw-bold">
                <?php echo __('الفترة الصباحية', 'qeema'); ?>
            </label>
        </div>

        <div class="repeater mb-4">
            <!-- innner repeater -->
            <div class="inner-repeater">
                <div data-repeater-list="morning_periods">
                    <?php
                    $morning_periods = (int)get_post_meta($post_id, 'morning_periods', true);

                    // Loop through rows.
                    for ($i = 0; $i < $morning_periods; $i++) :
                    ?>
                        <div data-repeater-item>
                            <label for="morning_periods"><?php echo __('الفترة', 'qeema'); ?></label>
                            <div class="input-group input-group-sm mb-3">
                                <input type="text" name="period" class="form-control" placeholder="<?php echo __('الفترة', 'qeema'); ?>" value="<?php echo get_post_meta($post_id, 'morning_periods_' . $i . '_period', true); ?>">
                                <button id="morning_periods" data-repeater-delete class="btn btn-danger" type="button">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                    <?php
                    endfor;
                    // endif;
                    ?>
                </div>
                <input data-repeater-create type="button" class="btn btn-sm btn-primary" value="<?php echo __('أضف فترة صباحية', 'qeema'); ?>" />
            </div>
        </div>

        <div class="col-lg-12 mb-4">
            <label for="" class="form-label small mb-2 fw-bold">
                <?php echo __('الفترة المسائية', 'qeema'); ?>
            </label>
        </div>

        <div class="repeater mb-4">
            <!-- innner repeater -->
            <div class="inner-repeater">
                <div data-repeater-list="night_periods">
                    <?php
                    $night_periods = (int)get_post_meta($post_id, 'night_periods', true);

                    // Loop through rows.
                    for ($i = 0; $i < $night_periods; $i++) :
                    ?>
                        <div data-repeater-item>
                            <label for="night_periods"><?php echo __('الفترة', 'qeema'); ?></label>
                            <div class="input-group input-group-sm mb-3">
                                <input type="text" name="period" class="form-control" placeholder="<?php echo __('الفترة', 'qeema'); ?>" value="<?php echo get_post_meta($post_id, 'night_periods_' . $i . '_period', true); ?>">
                                <button data-repeater-delete class="btn btn-danger" type="button">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                    <?php
                    endfor;
                    ?>
                </div>
                <input data-repeater-create type="button" class="btn btn-sm btn-primary" value="<?php echo __('أضف فترة مسائية', 'qeema'); ?>" />
            </div>
        </div>

        <div class="col-lg-12 mb-2">
            <label for="" class="form-label small mb-2 fw-bold">
                <?php echo __('نوع الاشتراك', 'qeema'); ?>
            </label>
        </div>

        <div class="repeater mb-4">
            <!-- innner repeater -->
            <div class="inner-repeater">
                <div class="px-0" data-repeater-list="type">
                    <?php
                    $type = (int)get_post_meta($post_id, 'type', true);

                    // Loop through rows.
                    for ($i = 0; $i < $type; $i++) :
                    ?>
                        <div class="row" data-repeater-item>
                            <div class="col-6">
                                <label for="name"><?php echo __('اسم الاشتراك', 'qeema'); ?></label>
                                <div class="input-group input-group-sm mb-3">
                                    <input type="text" name="name" class="form-control" placeholder="<?php echo __('الفترة', 'qeema'); ?>" value="<?php echo get_post_meta($post_id, 'type_' . $i . '_name', true); ?>">
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="price"><?php echo __('السعر', 'qeema'); ?></label>
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" name="price" class="form-control" placeholder="<?php echo __('الفترة', 'qeema'); ?>" value="<?php echo get_post_meta($post_id, 'type_' . $i . '_price', true); ?>">
                                    <button data-repeater-delete class="btn btn-danger" type="button">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
                <input data-repeater-create type="button" class="btn btn-sm btn-primary" value="<?php echo __('أضف اشتراك جديد', 'qeema'); ?>" />
            </div>

            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-danger">
                    <?php echo __('تعديل', 'qeema'); ?>
                </button>
            </div>
    </form>
</div>

<script>
    jQuery(document).ready(function($) {
        'use strict';

        $('.repeater').repeater();
    });
</script>