<?php get_header();

if (have_posts()) :
    while (have_posts()) :
        // $product = wc_get_product(get_the_ID());

        the_post();
?>
        <!-- Loop Here. -->

<?php endwhile;
    wp_reset_postdata();
endif;
get_footer();
?>