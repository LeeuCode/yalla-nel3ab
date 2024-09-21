<div class="col-12">
    <h6 class="fw-bold small my-3"><?php echo __('الوقت', 'qeema'); ?></h6>

    <div class="form-check mb-3">
        <input class="form-check-input period" type="radio" name="period" id="period_morning" value="period_morning" data-type="<?php echo get_post_type($post_id); ?>" data-price="<?php the_field('morning_periods_price', $post_id); ?>">
        <label class="form-check-label fw-bold small" for="period_morning">
            <?php echo __('فتره صباحية', 'qeema'); ?>
        </label>
    </div>

    <div class="d-flex align-items-center gap-3 overflow-x-scroll">
        <?php
        if (have_rows('morning_periods', $post_id)):

            $i = 0;
            // Loop through rows.
            while (have_rows('morning_periods', $post_id)):
                the_row();
        ?>
                <div class="form-check p-0 small mb-3">
                    <input type="radio" class="form-check-input lc-check-box d-none" id="period-morning-<?php echo $i; ?>"
                        name="period_morning" value="<?php the_sub_field('period'); ?>" disabled>
                    <label class="form-check-label lc-check-box-label text-center rounded-3 font-x-12 py-1"
                        for="period-morning-<?php echo $i; ?>">
                        <?php the_sub_field('period'); ?>
                    </label>
                </div>
        <?php
                $i++;
            endwhile;
        endif;
        ?>
    </div>

    <div class="form-check mb-3">
        <input class="form-check-input period" type="radio" name="period" id="night_periods" value="night_periods" data-type="<?php echo get_post_type($post_id); ?>" data-price="<?php the_field('night_periods_price', $post_id); ?>">
        <label class="form-check-label fw-bold small" for="night_periods">
            <?php echo __('فتره مسائيه', 'qeema'); ?>
        </label>
    </div>

    <div class="d-flex align-items-center gap-3 overflow-x-scroll">
        <?php
        if (have_rows('night_periods', $post_id)):

            $i = 0;
            // Loop through rows.
            while (have_rows('night_periods', $post_id)):
                the_row();
        ?>
                <div class="form-check p-0 small mb-3">
                    <input type="radio" class="form-check-input lc-check-box d-none" id="period-night-<?php echo $i; ?>"
                        name="night_periods" value="<?php the_sub_field('period'); ?>" disabled>
                    <label class="form-check-label lc-check-box-label text-center rounded-3 font-x-12 py-1"
                        for="period-night-<?php echo $i; ?>">
                        <?php the_sub_field('period'); ?>
                    </label>
                </div>
        <?php
                $i++;
            endwhile;
        endif;
        ?>
    </div>
</div>