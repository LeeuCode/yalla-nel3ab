<form hx-get="<?php echo $args['url']; ?>" hx-swap="innerHTML show:top" hx-trigger="submit" hx-target="#posts-data" class="mb-3 row post-ajax">
    <input type="hidden" name="post-type" value="<?php echo $args['post-type']; ?>">
    <div class="col-5">
        <select name="city" class="form-select form-select-sm city-select">
            <option value=""><?php echo __('أختار من المحافظات', 'qeema'); ?></option>
            <?php
            $cities = get_terms(array(
                'taxonomy' => 'city',
                'hide_empty' => false,
                'parent' => 0,

            ));

            foreach ($cities as $city) :
            ?>
                <option value="<?php echo $city->term_id; ?>"><?php echo $city->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-5">
        <select name="city-child" class="form-select form-select-sm cities-child">
            <option value=""><?php echo __('أختار من المدن', 'qeema'); ?></option>
        </select>
    </div>

    <div class="col-2">
        <button type="submit" class="btn btn-danger btn-sm">
            <i class="fa-solid fa-filter"></i>
        </button>
    </div>
</form>