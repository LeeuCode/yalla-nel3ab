<?php

$post_id = esc_sql($params['id']);

$link = site_url('championships/schedule/');

require_once component('heading');
?>

<div class="container py-3">
    <div class="row">
        <div class="accordion mt-3" id="accordionExample">

            <?php
            // Check rows exists.
            if (have_rows('champ_table', $post_id)):
                // Loop through rows.
                $i = 0;
                while (have_rows('champ_table', $post_id)) : the_row();

                    $team_id = get_sub_field('team_id', $post_id);
                    $team_avatar =  get_post_meta($team_id, 'team_avatar', true);

                    if ($team_avatar) {
                        $imageUrl = wp_get_attachment_image_url($team_avatar, 'full');
                    } else {
                        $imageUrl = get_template_directory_uri() . '/assets/images/custom-logo.png';
                    }
            ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button-light accordion-button <?php echo ($i == 0) ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $i; ?>" aria-expanded="<?php echo ($i == 0) ? 'true' : 'false'; ?>" aria-controls="collapseOne<?php echo $i; ?>">
                                <img src="<?php echo $imageUrl; ?>" alt="" class="icon-md rounded-2 shadow">
                                <?php echo get_the_title($team_id); ?>
                            </button>
                        </h2>
                        <div id="collapseOne<?php echo $i; ?>" class="accordion-collapse collapse <?php echo ($i == 0) ? 'show' : ''; ?>" data-bs-parent="#accordionExample">
                            <div class="accordion-body p-0">
                                <table class="table table-striped mt-3">
                                    <tbody>
                                        <tr class="font-x-12-">
                                            <th class="font-x-12"><?php echo __('لعب', 'qeema'); ?></th>
                                            <td>
                                                <span class="badge bg-dark"><?php the_sub_field('play', $post_id); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="font-x-12"><?php echo __('فوز', 'qeema'); ?></th>
                                            <td>
                                                <span class="badge bg-success"><?php the_sub_field('win', $post_id); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="font-x-12"><?php echo __('تعادل', 'qeema'); ?></th>
                                            <td>
                                                <span class="badge bg-primary"><?php the_sub_field('equalize', $post_id); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="font-x-12"><?php echo __('هزيمة', 'qeema'); ?></th>
                                            <td>
                                                <span class="badge bg-danger"><?php the_sub_field('defeat', $post_id); ?></span>
                                            </td>
                                        </tr>

                                        <tr class="">
                                            <th class="font-x-12"><?php echo __('النقاط', 'qeema'); ?></th>
                                            <td>
                                                <span class="badge bg-info"><?php the_sub_field('points', $post_id); ?></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            <?php
                    $i++;
                // End loop.
                endwhile;

            // No value.
            else :
            // Do something...
            endif;
            ?>
        </div>
    </div>
</div>

<?php require_once component('footer-menu'); ?>