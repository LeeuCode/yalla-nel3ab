<?php

$term_id = $params['term_id'];
$profileImage = get_template_directory_uri() . '/assets/images/user-defualt.jpg';

?>

<div class="col-12 mb-3">
    <label class="font-x-12 mb-2 fw-bold" for="start_time"><?php echo __('تحديد الملعب', 'qeema'); ?></label>
    <select name="playground" id="" class="form-select form-select-sm">
        <option value="">
            <?php echo __('اختار الملعب', 'qeema'); ?>
        </option>
        <?php
        $args = array(
            'post_type' => 'playground',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'section',
                    'field' => 'term_id',
                    'terms' => array($term_id)
                )
            )
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();
        ?>
                <option value="<?php the_ID(); ?>">
                    <?php the_title(); ?>
                </option>
        <?php
            endwhile;
        endif;
        ?>
    </select>
</div>

<?php

$team_count = get_field('team_count', 'section_' . $term_id);
$plaiers_count = get_field('plaiers_count', 'section_' . $term_id);

for ($i = 0; $i < $team_count; $i++) :
?>

    <div class="col-12 mb-4">
        <label class="font-x-12 mb-2 fw-bold" for="end_date"><?php echo __('الفريق', 'qeema') . ' ' . ($i + 1); ?></label>
        <div class="d-flex gap-2 overflow-x-scroll">
            <?php for ($c = 0; $c < $plaiers_count; $c++) : ?>
                <div class="team-image position-relative">
                    <img class="rounded-circle shadow-sm" src="<?php echo $profileImage; ?>"
                        alt="">
                    <input class="d-none upload-preview-image" name="team_<?php echo $i . '_' . $c; ?>[]" id="upload-profile<?php echo  $i . '_' . $c; ?>" type="file">
                    <label for="upload-profile<?php echo $i . '_' . $c; ?>" class="stretched-link rounded-circle">
                    </label>
                </div>
            <?php endfor; ?>
        </div>
    </div>
<?php endfor; ?>

<script>
    jQuery(document).ready(function($) {
        'use strict';

        $('.upload-preview-image').on('change', function() {
            if (this.files[0]) {
                var reader = new FileReader();
                var image = $(this).prev('img');

                reader.readAsDataURL(this.files[0]);

                reader.onloadend = function() {
                    image.attr('src', reader.result);
                };
            }
        });
    });
</script>