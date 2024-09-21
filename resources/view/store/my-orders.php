<?php

$link = site_url('home/');

require_once component('heading');
?>

<?php

get_template_part('template-parts/heading', null, [
    'title' => __('هدف الحصاله', 'qeema'),
    'back' => site_url('home/')
]);

$user = wp_get_current_user();

?>
<div class="">
    <div class="container py-5">
        <div class="row">
            <ul class="nav home-tab-nav mb-4 gap-3 px-3  rounded-pill d-flex justify-content-between">
                <li class="nav-item col">
                    <a href="#" class="nav-link text-center rounded-2 active" data-bs-toggle="tab" data-bs-target="#nav-pending" role="tab" aria-controls="nav-pending" aria-selected="true">
                        <?php echo __('جاري', 'qeema'); ?>
                    </a>
                </li>
                <li class="nav-item col">
                    <a href="#" class="nav-link text-center rounded-2" id="nav-publish-tab" data-bs-toggle="tab" data-bs-target="#nav-publish" role="tab" aria-controls="nav-publish" aria-selected="false">
                        <?php echo __('مكتمله', 'qeema'); ?>
                    </a>
                </li>

                <li class="nav-item col">
                    <a href="#" class="nav-link text-center rounded-2" id="nav-draft-tab" data-bs-toggle="tab" data-bs-target="#nav-draft" role="tab" aria-controls="nav-draft" aria-selected="false">
                        <?php echo __('مرفوضه', 'qeema'); ?>
                    </a>
                </li>
            </ul>

            <div class="tab-content mb-4" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
                    <div class="row">
                        <?php
                        $user = wp_get_current_user();

                        $notifications = new WP_Query(
                            array(
                                'post_type' => array('bookings'),
                                'post_status' => 'pending',
                                'author' => $user->ID,
                            )
                        );

                        if ($notifications->have_posts()) :
                            while ($notifications->have_posts()) :
                                $notifications->the_post();

                                include component('order-block');

                            endwhile;
                        else :
                        ?>
                            <div class="text-center py-5 my-5">
                                <img src="<?php echo get_template_directory_uri() . '/assets/images/not-found.svg'; ?>" alt="" class="w-75 mb-3">
                                <h6 class="mb-3"><?php echo __('لا توجد اي طلبات قيد التنفيذ حتي الان', 'qeema'); ?></h6>
                                <a hx-get="<?php echo site_url('home'); ?>" hx-target=".app" hx-swap="innerHTML scroll:top" class="btn btn-success-lite px-4 mb-4">
                                    <!-- <img id="laoding" src="https://htmx.org/img/bars.svg" alt=""> -->
                                    <?php echo __('العوده الي احدث المنشورات', 'qeema'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="tab-pane fade" id="nav-publish" role="tabpanel" aria-labelledby="nav-pending-tab">
                    <div class="row">
                        <?php


                        $notifications = new WP_Query(
                            array(
                                'post_type' => array('bookings'),
                                'post_status' => 'publish',
                                'author' => $user->ID,
                            )
                        );

                        if ($notifications->have_posts()) :
                            while ($notifications->have_posts()) :
                                $notifications->the_post();

                                include component('order-block');

                            endwhile;
                        else :
                        ?>
                            <div class="text-center py-5 my-5">
                                <img src="<?php echo get_template_directory_uri() . '/assets/images/not-found.svg'; ?>" alt="" class="w-75 mb-3">
                                <h6 class="mb-3"><?php echo __('لا توجد اي طلبات قيد التنفيذ حتي الان', 'qeema'); ?></h6>
                                <a hx-get="<?php echo site_url('home'); ?>" hx-target=".app" hx-swap="innerHTML scroll:top" class="btn btn-success-lite px-4 mb-4">
                                    <!-- <img id="laoding" src="https://htmx.org/img/bars.svg" alt=""> -->
                                    <?php echo __('العوده الي الرئيسية', 'qeema'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="tab-pane fade" id="nav-draft" role="tabpanel" aria-labelledby="nav-draft-tab">
                    <div class="row">
                        <?php


                        $notifications = new WP_Query(
                            array(
                                'post_type' => array('bookings'),
                                'post_status' => 'draft',
                                'author' => $user->ID,
                            )
                        );

                        if ($notifications->have_posts()) :
                            while ($notifications->have_posts()) :
                                $notifications->the_post();

                                include component('order-block');

                            endwhile;
                        else :
                        ?>
                            <div class="text-center py-5 my-5">
                                <img src="<?php echo get_template_directory_uri() . '/assets/images/not-found.svg'; ?>" alt="" class="w-75 mb-3">
                                <h6 class="mb-3"><?php echo __('لا توجد اي طلبات مرفوضه حتي الان', 'qeema'); ?></h6>
                                <a hx-get="<?php echo site_url('home'); ?>" hx-target=".app" hx-swap="innerHTML scroll:top" class="btn btn-success-lite px-4 mb-4">
                                    <!-- <img id="laoding" src="https://htmx.org/img/bars.svg" alt=""> -->
                                    <?php echo __('العوده الي الرئيسية', 'qeema'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>