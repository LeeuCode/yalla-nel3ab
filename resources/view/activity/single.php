<?php

$link = site_url('activites/');

require_once component('heading');

$post_id = $params['id'];
?>

<div class="container pt-4 position-relative">
    <div class="row">

        <?php
        $activity_cat = get_post_meta($post_id, 'activity_cat', true);
        $start_date = get_post_meta($post_id, 'start_date', true);
        $start_time = get_post_meta($post_id, 'start_time', true);
        $end_time = get_post_meta($post_id, 'end_time', true);
        $playground_id = get_post_meta($post_id, 'playground', true);

        $city = get_the_terms($playground_id, 'city');
        $city_string = join(', ', wp_list_pluck($city, 'name'));
        ?>

        <div class="col-12">
            <div class="col-12">
                <div class="d-flex gap-2 p-3 mb-4 rounded-2 bg-white border shadow-sm">
                    <img class="icon-md" src="<?php the_field('icon', 'section_' . $activity_cat); ?>" alt="">
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <?php if ($activity_cat) : ?>
                                    <h6 class="small fw-bold mb-1"><?php echo get_term($activity_cat)->name; ?></h6>
                                <?php endif; ?>
                                <span class="badge bg-danger px-3 font-x-11">
                                    <?php echo __('مغلق', 'qeema'); ?>
                                </span>
                            </div>

                            <div class="d-flex team-container">
                                <?php

                                $profileImage = get_template_directory_uri() . '/assets/images/user-defualt.jpg';
                                $team_count = get_field('team_count', 'section_' . $activity_cat);
                                $plaiers_count = get_field('plaiers_count', 'section_' . $activity_cat);
                                $count = 0;

                                for ($i = 0; $i < $team_count; $i++) :
                                    for ($c = 0; $c < 2; $c++) :
                                        $imageuRL = get_post_meta($post_id, 'team_' . $i . '_' . $c . '_img_link', true);
                                ?>
                                        <img width="30" height="30" class="rounded-circle border" src="<?php echo ($imageuRL) ? get_attachment_link($imageuRL, 'full') : $profileImage; ?>" alt="">
                                <?php
                                    endfor;
                                endfor;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <h6 class="fw-bold small mb-2"><?php echo __('بيانات الملعب', 'qeema'); ?></h6>
            <div class="d-flex align-items-center justify-content-between gap-2 rounded-2 bg-white border shadow-sm p-3 mb-4">
                <div>
                    <h6 class="small mb-1"><?php echo __('أسم الملعب', 'qeema'); ?></h6>
                    <span class="d-inline-block fw-bold font-x-11"><?php echo get_the_title($playground_id); ?></span>
                </div>

                <div>
                    <h6 class="small mb-1"><?php echo __('مكان الملعب', 'qeema'); ?></h6>
                    <span class="d-inline-block fw-bold font-x-11"><?php echo $city_string; ?></span>
                </div>
            </div>
        </div>

        <div class="col-12">
            <h6 class="fw-bold small mb-2"><?php echo __('معاد النشاط', 'qeema'); ?></h6>
            <div class="d-flex flex-wrap align-items-center justify-content-between  rounded-2 bg-white border shadow-sm p-3 mb-4">
                <div class="w-100 mb-2">
                    <span class="small mb-1"><?php echo __('تاريخ  البدأ', 'qeema'); ?>:</span>
                    <span class="badge bg-primary font-x-11"><?php echo $start_date; ?></span>
                </div>

                <div class="w-50">
                    <span class="small mb-1"><?php echo __('وقت البدأ', 'qeema'); ?>:</span>
                    <span class="badge bg-success font-x-11"><?php echo $start_time; ?></span>
                </div>

                <div class="w-50">
                    <span class="small mb-1"><?php echo __('وقت الانتهاء', 'qeema'); ?>:</span>
                    <span class="badge bg-danger font-x-11"><?php echo $end_time; ?></span>
                </div>
            </div>
        </div>

        <div class="col-12">
            <h6 class="fw-bold small mb-2"><?php echo __('بيانات النشاط', 'qeema'); ?></h6>
            <div class="rounded-2 bg-white border shadow-sm p-3 mb-4">
                <?php

                $profileImage = get_template_directory_uri() . '/assets/images/user-defualt.jpg';
                $team_count = get_field('team_count', 'section_' . $activity_cat);
                $plaiers_count = get_field('plaiers_count', 'section_' . $activity_cat);

                $team = get_post_meta($post_id, 'team', true);

                for ($i = 0; $i < $team_count; $i++) :
                ?>

                    <div class="w-100 mb-4">
                        <span class="d-block small mb-2"><?php echo __('الفريق', 'qeema') . ' ' . ($i + 1); ?></span>
                        <div class="d-flex gap-2">
                            <?php

                            for ($c = 0; $c < $plaiers_count; $c++) :
                                $imageuRL = get_post_meta($post_id, 'team_' . $i . '_' . $c . '_img_link', true);
                            ?>
                                <div class="team-image position-relative">
                                    <img width="55" height="55" class="rounded-circle shadow-sm" src="<?php echo ($imageuRL) ? get_attachment_link($imageuRL, 'full') : $profileImage; ?>" alt="">
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                <?php endfor; ?>

                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <?php

                    $count = 1;

                    foreach ($team as $key => $value) :
                    ?>
                        <div class="w-50 mb-3">
                            <span class="small mb-1"><?php echo __('متبقي بالفريق', 'qeema') . ' ' . $count; ?>:</span>
                            <span class="badge bg-danger font-x-11"><?php echo ($plaiers_count - $value) . ' ' . __('لاعب', 'qeema'); ?></span>
                        </div>
                    <?php
                        $count++;
                    endforeach;
                    ?>
                </div>
            </div>
        </div>

        <div class="col-12">
            <h6 class="fw-bold small mb-2"><?php echo __('انضم إلي النشاط', 'qeema'); ?></h6>

            <div class="rounded-2 bg-white border shadow-sm p-3 mb-4">
                <select name="" id="" class="form-select mb-3">
                    <option value=""><?php echo __('أختار الفريق', 'qeema'); ?></option>
                    <?php

                    $count = 0;

                    foreach ($team as $key => $value) :
                    ?>
                        <option value="<?php echo 'team_' . $count . '_' . ($value + 1) ?>"><?php echo __('فريق', 'qeema') . ' ' . ($count + 1); ?></option>
                    <?php
                        $count++;
                    endforeach;
                    ?>
                </select>

                <div class=" d-grid">
                    <button class="btn btn-sm btn-danger">
                        <?php echo __('انضم الان', 'qeema'); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>