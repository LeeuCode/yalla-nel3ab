<div class="add-champ position-fixed bg-white w-100 h-100">
    <div class="header">
        <div class="header-box justify-content-between px-3 py-4 h-auto" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/images/bg-image.png'; ?>)">

            <a href="#" class="close-activity btn btn-sm btn-outline-light border-color-selver border-color-selver">
                <i class="fa-solid fa-chevron-right"></i>
            </a>

            <img class="w-25" src="<?php echo get_template_directory_uri() . '/assets/images/login-header.png'; ?>" alt="">

            <a hx-get="<?php echo site_url('notifications/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-target=".app" hx-on::before-request="showLoad()" class="icon-sm fs-5 rounded-pill d-flex align-items-center justify-content-center position-relative">
                <i class="fa-solid fa-bell text-white"></i>

                <?php
                $notify = get_user_meta($user->ID, 'notify', true);

                if ($notify) :
                ?>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border- border-warning- rounded-circle">
                        <span class="visually-hidden">New alerts</span>
                    </span>
                <?php endif; ?>
            </a>
        </div>
    </div>

    <!-- create-activity -->
    <div class="container position-relative">
        <div class="row py-3">
            <?php
            $sections = get_terms(
                array(
                    'taxonomy' => 'section',
                    'hide_empty' => false,
                )
            );

            foreach ($sections as $section):
            ?>
                <div class="col-3">
                    <div class="form-check py-2 px-0 small mb-3">
                        <input type="radio" class="form-check-input lc-check-box d-none"
                            id="period-test-<?php echo $section->term_id; ?>" name="activity_cat" value="<?php echo $section->term_id; ?>">
                        <label class="form-check-label lc-check-box-label text-center rounded-2 font-x-12 py-1 text-wrap"
                            for="period-test-<?php echo $section->term_id; ?>" hx-get="<?php echo site_url('activity/form/' . $section->term_id . '/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target="#team-data">
                            <img class="icon-sm" src="<?php the_field('icon', 'section_' . $section->term_id); ?>" alt="">
                            <img class="icon-sm hidden" src="<?php the_field('icon_active', 'section_' . $section->term_id); ?>"
                                alt="">
                            <span class="d-block mt-2 fw-bold font-x-10"><?php echo $section->name; ?></span>
                        </label>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <div class="col-12 mb-2">
                <label class="font-x-12 mb-1 fw-bold" for="start_date"><?php echo __('تحديد تاريخ', 'qeema'); ?></label>
                <input type="date" name="start_date" class="form-control form-contole-sm">
            </div>
            <div class="col-12">
                <h6 class="small my-3"><?php echo __('تحديد الوقت', 'qeema'); ?></h6>
            </div>
            <div class="col-6 mb-3">
                <label class="font-x-12 mb-3 fw-bold" for="start_time"><?php echo __('وقت البدايه', 'qeema'); ?></label>
                <input type="time" name="start_time" class="form-control form-contole-sm">
            </div>
            <div class="col-6 mb-2">
                <label class="font-x-12 mb-3 fw-bold" for="end_time"><?php echo __('وقت النهايه', 'qeema'); ?></label>
                <input type="time" name="end_time" class="form-control form-contole-sm">
            </div>

            <div class="col-12 mb-3">
                <label class="font-x-12 mb-3 fw-bold" for="end_time"><?php echo __('ملاحظات', 'qeema'); ?></label>
                <textarea name="notes" id="" rows="4" class="form-control form-contole-sm"></textarea>
            </div>

            <?php $profileImage = get_template_directory_uri() . '/assets/images/user-defualt.jpg'; ?>
        </div>

        <div id="team-data" class="row">
        </div>

        <div class="py-4 my-4"></div>

        <div class="create-match bg-white position-fixed bottom-0 start-0 w-100 p-3 d-grid border-top shadow-sm">
            <button class="btn btn-danger"><?php echo __('انشاء المباره', 'qeema'); ?></button>
        </div>
    </div>
</div>