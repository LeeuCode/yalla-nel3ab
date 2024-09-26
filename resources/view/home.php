<?php
// Get current user.
$user = wp_get_current_user();

$logoID = get_user_meta($user->ID, 'profile_image', true);
// $type = get_user_meta($user->ID, 'type', true);
$profileImage = get_template_directory_uri() . '/assets/images/user-defualt.jpg';

if ($logoID) {
    $profileImage = wp_get_attachment_url($logoID);
}
?>

<div class="load-spinner hide d-flex align-items-center justify-content-center">
    <div class="text-center p-3 bg-white rounded-2">
        <div class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <span class="d-block font-x-12 mt-2"><?php echo __('جاري التحميل', 'qeema'); ?>.....</span>
    </div>
</div>

<div class="header">
    <div class="d-flex align-items-center justify-content-between py-4 px-3">
        <div class="d-flex gap-2 flex-row align-items-center">
            <div class="thumb border-0 icon-sm shadow">
                <img class="rounded-circle icon-sm" src="<?php echo $profileImage; ?>" alt="<?php echo $user->first_name; ?>">
            </div>
            <p class="font-x-12 text-dark fw-bold my-1">
                <?php echo $user->first_name; ?>
            </p>
        </div>

        <?php
        if (is_user_logged_in()) {
            $link = 'notification/';
        } else {
            $link = 'gest/login/';
        }
        ?>

        <a hx-get="<?php echo site_url($link); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" class="icon-sm fs-5 rounded-pill d-flex align-items-center justify-content-center">
            <i class="bi bi-bell text-dark"></i>
        </a>
    </div>
</div>

<div class="container position-relative px-4 h-100vh">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="position-relative mb-3">
                <img class="img-fluid" src="<?php echo get_template_directory_uri() . '/assets/images/home-image.png'; ?>" alt="">
                <img class="w-50 position-absolute top-50 start-50 translate-middle" src="<?php echo get_template_directory_uri() . '/assets/images/login-header.png'; ?>" alt="">
            </div>
        </div>

        <div class="col-12">
            <div class="d-flex aling-items-center gap-2 py-3 border-bottom mb-3 position-relative">
                <img class="icon-sm" src="<?php echo get_template_directory_uri() . '/assets/images/playgrounds.png'; ?>" alt="">
                <div>
                    <h6 class="fw-bold mb-1 small"><?php echo __('حجز ملاعب', 'qeema'); ?></h6>
                    <p class="text-secondary font-x-11 mb-0">
                        <?php echo __('كورة قدم - تنس - سله- طايرة - بولنج - بوكس', 'qeema'); ?>
                    </p>
                </div>
                <a hx-get="<?php echo site_url('reserve-playgrounds/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="stretched-link"></a>
            </div>
        </div>

        <div class="col-12">
            <div class="d-flex aling-items-center gap-2 py-3 border-bottom mb-3 position-relative">
                <img class="icon-sm" src="<?php echo get_template_directory_uri() . '/assets/images/academies.png'; ?>" alt="">
                <div>
                    <h6 class="fw-bold mb-1 small"><?php echo __('حجز اكاديميات', 'qeema'); ?></h6>
                    <p class="text-secondary font-x-11 mb-0">
                        <?php echo __('كورة قدم - تنس - سله- طايرة - بولنج - بوكس', 'qeema'); ?>
                    </p>
                </div>
                <a hx-get="<?php echo site_url('academies/sections/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" hx-on::before-request="showLoad()" class="stretched-link"></a>
            </div>
        </div>

        <div class="col-12">
            <div class="d-flex aling-items-center gap-2 py-3 border-bottom mb-3 position-relative">
                <img class="icon-sm" src="<?php echo get_template_directory_uri() . '/assets/images/trainer.png'; ?>" alt="">
                <div>
                    <h6 class="fw-bold mb-1 small"><?php echo __('حجز مدرب خاص', 'qeema'); ?></h6>
                    <p class="text-secondary font-x-11 mb-0">
                        <?php echo __('كورة قدم - تنس - سله- طايرة - بولنج - بوكس', 'qeema'); ?>
                    </p>
                </div>
                <a hx-get="<?php echo site_url('coachs/categories/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="stretched-link"></a>
            </div>
        </div>

        <div class="col-12">
            <div class="d-flex aling-items-center gap-2 py-3 border-bottom mb-3 position-relative">
                <img class="icon-sm" src="<?php echo get_template_directory_uri() . '/assets/images/american-football-cup.png'; ?>" alt="">
                <div>
                    <h6 class="fw-bold mb-1 small"><?php echo __('البطولات', 'qeema'); ?></h6>
                    <p class="text-secondary font-x-11 mb-0">
                        <?php echo __('كورة قدم - تنس - سله- طايرة - بولنج - بوكس', 'qeema'); ?>
                    </p>
                </div>
                <a hx-get="<?php echo site_url('championships/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="stretched-link"></a>
            </div>
        </div>

        <div class="col-12">
            <div class="d-flex aling-items-center gap-2 py-3 border-bottom mb-3 position-relative">
                <img class="icon-sm" src="<?php echo get_template_directory_uri() . '/assets/images/league.png'; ?>" alt="">
                <div>
                    <h6 class="fw-bold mb-1 small"><?php echo __('جداول البطولات', 'qeema'); ?></h6>
                    <p class="text-secondary font-x-11 mb-0">
                        <?php echo __('كورة قدم - تنس - سله- طايرة - بولنج - بوكس', 'qeema'); ?>
                    </p>
                </div>
                <a hx-get="<?php echo site_url('championships/schedule/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="stretched-link"></a>
            </div>
        </div>

        <div class="col-12">
            <div class="d-flex aling-items-center gap-2 py-3 border-bottom mb-3 position-relative">
                <img class="icon-sm" src="<?php echo get_template_directory_uri() . '/assets/images/weightlifting.png'; ?>" alt="">
                <div>
                    <h6 class="fw-bold mb-1 small"><?php echo __('اشتراك جيم', 'qeema'); ?></h6>
                    <p class="text-secondary font-x-11 mb-0">
                        <?php echo __('الكارديو - اللياقة البدنية - المشي - رفع أثقال - بناء أجسام', 'qeema'); ?>
                    </p>
                </div>
                <a hx-get="<?php echo site_url('gyms/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="stretched-link"></a>
            </div>
        </div>

        <div class="col-12">
            <div class="d-flex aling-items-center gap-2 py-3 border-bottom mb-3 position-relative">
                <img class="icon-sm" src="<?php echo get_template_directory_uri() . '/assets/images/store.png'; ?>" alt="">
                <div>
                    <h6 class="fw-bold mb-1 small"><?php echo __('متجر الكتروني', 'qeema'); ?></h6>
                    <p class="text-secondary font-x-11 mb-0">
                        <?php echo __('منتجات رياضيه', 'qeema'); ?>
                    </p>
                </div>
                <a hx-get="<?php echo site_url('store/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <img class="position-absolute bottom-0 end-0 w-50" src="<?php echo get_template_directory_uri() . '/assets/images/Frame.png'; ?>" alt="">
</div>

<?php
require_once component('footer-menu');

get_template_part('template-parts/marriage-search');
?>

<script>
    jQuery(document).ready(function($) {
        'use strict';

        // $(document).on('click', '.filter-toggle', function (e) {
        //     e.preventDefault();
        //     $('.filter-container').toggleClass('active');
        // });

        // $(document).on('click', '.account-btn', function (e) {
        //     e.preventDefault();
        //     $('.my-account').toggleClass('show');
        // });

        $('.main-slider').slick({
            dots: true,
            infinite: true,
            speed: 1000,
            slidesToShow: 1,
            slidesToScroll: 1,
            rtl: true,
            prevArrow: null, //"<button type='button' class='slick-prev slick-arrow'></button>",
            nextArrow: null, //"<button type='button' class='slick-next slick-arrow'></button>",
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        // dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $('.exercise-slider').slick({
            dots: false,
            infinite: true,
            speed: 1000,
            slidesToShow: 2,
            slidesToScroll: 1,
            rtl: true,
            // variableWidth: true,
            prevArrow: null, //"<button type='button' class='slick-prev slick-arrow'></button>",
            nextArrow: null, //"<button type='button' class='slick-next slick-arrow'></button>",
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        // dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }
            ]
        });

    });

    function close_marriage_official() {
        jQuery('#marriage-official-top').removeClass('show');
        jQuery(this).reset();
    }

    function close_search_modal(params) {
        jQuery('#marriage-search-top').removeClass('show');
        jQuery('#marriage-official-form').reset();
    }
</script>

<?php if (isset($_SESSION['success'])) : ?>
    <script>
        Swal.fire({
            title: '<?php echo __('تم بنجاح!', 'qeema'); ?>',
            text: '<?php echo $_SESSION['success']; ?>',
            icon: 'success',
            confirmButtonText: '<?php echo __('تم', 'qeema'); ?>'
        })
    </script>
<?php
    // Remove msg from Sesstion. 
    unset($_SESSION['success']);
endif;
?>