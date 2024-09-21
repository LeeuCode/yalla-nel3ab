jQuery(document).ready(function($) {
    'use strict';

    $(document).on('click', '.next-splash', function(e) {
        e.preventDefault();
        var parentDiv = $(this).parent().parent().parent().parent();

        parentDiv.removeClass('active').next('.item').addClass('active');
    });

    $(document).on('click', '.create-activity', function(e) {

        e.preventDefault();

        $('.add-champ').addClass('active');
    });

    $(document).on('click', '.close-exercise-offcanvas', function(e) {
        e.preventDefault();

        $('.exercise-offcanvas').removeClass('active');
    });

    $(document).on('click', '.add-offer', function(e) {
        e.preventDefault();

        $('#marriage-official-top').addClass('show');
    });

    $(document).on('click', '.close-hidden-top', function(e) {
        e.preventDefault();

        $('.hidden-top').removeClass('show');
    });

    $(document).on('click', '.open-my-account', function(e) {
        e.preventDefault();

        $('.my-account').addClass('show');
    });

    $(document).on('click', '.close-myacount', function(e) {
        e.preventDefault();

        $('.my-account').removeClass('show');
    });

    // Show Password to text.
    $(document).on('click', '.show-password', function() {
        var icon = $(this);

        icon.prev().attr('type', 'text');
        icon.addClass('hidden-password fa-eye').removeClass('show-password fa-eye-slash')
    });

    // Hidden Password to text.
    $(document).on('click', '.hidden-password', function() {
        var icon = $(this);

        icon.prev().attr('type', 'password');
        icon.addClass('show-password fa-eye-slash').removeClass('hidden-password fa-eye')
    });

    $(document).on('change', '.password-checkbox', function() {
        $('.change-password').toggleClass('hide');
    });

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

    $(document).on('click', '.marriage-search-btn', function(e) {
        e.preventDefault();
        $('#marriage-search-top').addClass('show');
    });

    $(document).on('click', '.account-btn', function() {
        $('.my-account').removeClass('show');
    });

    // $('.products-container').infiniteScroll({
    //     // options
    //     path: '.next',
    //     append: '.col-6',
    //     history: false,
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

    $(document).on('change', '#subscription_type', function() {
        var priceVal = $(this).find(':selected').data('price-val');

        $('.price').text(priceVal);
        $('.price').val(priceVal);

    });

    $(document).on('change', '.period', function() {
        var type = $(this).val(),
            period_morning_price = $('input[value="period_morning"]').attr('data-price'),
            night_periods_price = $('input[value="night_periods"]').attr('data-price'),
            post_type = $(this).data('type');


        console.log(post_type);


        if (type == 'period_morning') {

            if (post_type == 'playground') {
                $('.price').text(period_morning_price);
                $('.set-price').val(period_morning_price);
            }

            $('input[name="night_periods"]').attr('disabled', true);
            $('input[name="period_morning"]').attr('disabled', false);
            $('input[name="night_periods"]').prop('checked', false);
        } else {

            if (post_type == 'playground') {
                $('.price').text(night_periods_price);
                $('.set-price').val(night_periods_price);
            }

            $('input[name="period_morning"]').attr('disabled', true);
            $('input[name="period_morning"]').prop('checked', false);
            $('input[name="night_periods"]').attr('disabled', false);
        }
    });
});

function showLoad(data = '') {
    jQuery('.load-spinner').removeClass('hide');

    if (data != '') {
        data.reset();
    }

}

function hideLoad(data = '') {
    jQuery('.load-spinner').addClass('hide');

    if (data != '') {
        data.reset();
    }
}