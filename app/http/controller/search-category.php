<?php


$search_text = input_exist('s', 'get');

$type = input_exist('type', 'get');

$args = array(
    'taxonomy'      => array('section'), // taxonomy name
    'orderby'       => 'id',
    'order'         => 'ASC',
    'hide_empty'    => true,
    'fields'        => 'all',
    'name__like'    => $search_text
);

$terms = get_terms($args);

$count = count($terms);

if ($count > 0) {
    foreach ($terms as $section) {
?>

        <div class="shadow-sm mb-3 position-relative">
            <img class="img-fluid" src="<?php the_field('image', 'section_' . $section->term_id); ?>" alt="">
            <div class="position-absolute bottom-0 start-0 p-3">
                <h6 class="text-white mb-1">
                    <?php echo $section->name; ?>
                </h6>
                <!-- <div class="d-flex gap-2 align-items-center">
                            <span class="text-white small"><?php echo __('تقييم الخدمة', 'qeema'); ?></span>
                            <div class="user-rate checked  small">
                                <input type="radio" name="rate" value="5">
                                <input type="radio" name="rate" value="4">
                                <input type="radio" name="rate" value="3">
                                <input type="radio" name="rate" value="2">
                                <input type="radio" name="rate" value="1" checked="">
                            </div>
                        </div> -->
            </div>
            <a hx-get="<?php echo site_url($type . $section->term_id . '/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="z-index-2 stretched-link"></a>
        </div>

<?php
    }
}
