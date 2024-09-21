<?php get_header(); ?>

<div class="container d-flex h-100vh align-items-center justify-content-center">
    <div class="text-center">
        <img class="w-50 mb-4" src="<?php echo get_template_directory_uri() . '/assets/images/server_down.svg'; ?>" alt="">

        <h1 class="text-danger mb-2">Forbidden Error 403</h1>
        <p class="text-secondary">You don't have Permission to access this resourse</p>
    </div>
</div>


<?php get_footer(); ?>