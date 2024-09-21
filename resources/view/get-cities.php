<?php

$term_id = $params['id'];
$taxonomy_name = 'city';
$options = '<option value="">' . __('أختار من المدن', 'qeema') . '</option>';

$terms = get_term_children($term_id, $taxonomy_name);

foreach ($terms as $child) :
    $city = get_term_by('id', $child, $taxonomy_name);
    $options .= '<option value="' . $city->term_id . '">' . $city->name . '</option>';
endforeach;

echo $options;
