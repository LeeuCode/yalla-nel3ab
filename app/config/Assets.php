<?php

namespace LC;

if (!class_exists('Assets')) {
    class Assets
    {
        private static $_instance = null;

        public static function instance()
        {
            if (is_null(self::$_instance)) {
                self::$_instance = new self;
            }
            return self::$_instance;
        }

        public function __construct()
        {
            // register scripts and styles
            add_action('wp_enqueue_scripts', [$this, 'register_scripts']);

            add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        }

        public function register_scripts()
        {
            // CSS Register
            wp_register_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap', false);

            if (is_rtl()) {
                wp_register_style('bootstrap', THEME_DIR_URI . '/assets/css/bootstrap.rtl.min.css', '', '5.2.3');
            } else {
                wp_register_style('bootstrap', THEME_DIR_URI . '/assets/css/bootstrap.min.css', '', '5.2.3');
            }

            wp_register_style('slick', THEME_DIR_URI . '/assets/css/slick.css', '', '1.8.0');

            wp_register_style('bootstrap-icons', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css', '', '1.11.3');
            wp_register_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', '', '1.0.1');
            wp_register_style('sweetalert2', 'https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.32/sweetalert2.css');

            // JS Register
            wp_register_script('jquery', THEME_DIR_URI . '/assets/js/jquery-3.6.1.min.js', '', '3.6.1', true);
            // 
            wp_register_script('nicescroll', THEME_DIR_URI . '/assets/js/jquery.nicescroll.min.js', '', '3.7', true);
            wp_register_script('infinite-scroll', 'https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js', '', '4.0', true);
            wp_register_script('bootstrap', THEME_DIR_URI . '/assets/js/bootstrap.bundle.min.js', '', '5.2.3', true);
            wp_register_script('slick', THEME_DIR_URI . '/assets/js/slick.min.js', '', '1.8.0', true);
            wp_register_script('repeater', THEME_DIR_URI . '/assets/js/jquery.repeater.min.js');
            wp_register_script('sweetalert2', 'https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.32/sweetalert2.all.js');
            wp_register_script('htmx', 'https://unpkg.com/htmx.org@1.9.11', '', '1.8.0', true);

            wp_register_script('aster-script', THEME_DIR_URI . '/assets/js/app.js', '', THEME_VERSION, true);

            wp_localize_script(
                'aster-script',
                'lc',
                array(
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('lc-ajax')
                )
            );
        }

        public function enqueue_scripts()
        {
            // CSS Enqueue
            wp_enqueue_style('google-fonts');
            wp_enqueue_style('bootstrap');
            wp_enqueue_style('slick');
            wp_enqueue_style('font-awesome');
            wp_enqueue_style('bootstrap-icons');

            wp_enqueue_style('sweetalert2');
            wp_enqueue_style('aster-style', get_stylesheet_uri());

            // JS Enqueue
            wp_enqueue_script('jquery');
            wp_enqueue_script('nicescroll');
            wp_enqueue_script('infinite-scroll');
            wp_enqueue_script('bootstrap');
            wp_enqueue_script('slick');
            wp_enqueue_script('repeater');
            wp_enqueue_script('sweetalert2');
            wp_enqueue_script('htmx');
            wp_enqueue_script('aster-script');
        }
    }
}
