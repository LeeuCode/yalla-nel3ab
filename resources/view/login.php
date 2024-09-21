<!-- Login System. -->
<div class="item">
    <div class="header">
        <div class="header-box"
            style="background-image: url(<?php echo get_template_directory_uri() . '/assets/images/bg-image.png'; ?>)">
            <img class="w-50" src="<?php echo get_template_directory_uri() . '/assets/images/login-header.png'; ?>"
                alt="">
        </div>
    </div>
    <div class="d-flex flex-column align-items-center justify-content-center">
        <div class="step-content text-center p-3 w-100">
            <h6 class="text-dark fw-bold mt-3 mb-2">
                <?php echo __('مرحباً بك معانا..! 👋', 'qeema'); ?>
            </h6>
            <p class="text-secondary small mb-3">
                <?php echo __('برجاء التسجيل حتي تتمكن من الاستمتاع بخدماتنا', 'qeema'); ?>
            </p>

            <form hx-post="<?php echo site_url() . '/login/request/'; ?>" method="post" hx-swap="innerHTML show:top"
                hx-target=".app">
                <?php wp_nonce_field('submit_picture'); ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="icofont icofont-info-circle"></i>
                        <?php echo $_SESSION['error']; ?>
                    </div>
                <?php
                    unset($_SESSION['error']);
                endif;
                ?>

                <input type="text" name="username" class="form-control mb-4 input-bg-gray"
                    placeholder="<?php echo __('البريد الالكتروني', 'qeema'); ?>">

                <input type="text" name="password" class="form-control mb-4 input-bg-gray"
                    placeholder="<?php echo __('كلمة السر', 'qeema'); ?>">

                <div class="d-grid mt-4 mb-3">
                    <button type="submit" class="btn btn-success-lite px-4 py-2 rounded-2">
                        <?php echo __('تسجيل الدخول', 'qeema'); ?>
                    </button>
                </div>
            </form>

            <div class="d-flex flex-column justify-content-between">
                <div class="col-lg-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-check d-flex align-content-center gap-2 w-25-">
                            <input name="rememberme" class="form-check-input rounded-0 border-danger" type="checkbox"
                                value="" id="flexCheckDefault">
                            <label class="form-check-label small" for="flexCheckDefault">
                                <?php echo __('تذكرني', 'qeema'); ?>
                            </label>
                        </div>

                        <a class="small text-danger" href="">
                            <?php echo __('نسيت كلمة السر؟', 'qeema'); ?>
                        </a>
                    </div>
                </div>
                <p class="small mt-3 mb-2">
                    <?php echo __('ليس لديك حساب؟', 'qeema'); ?>
                    <a hx-get="<?php echo site_url() . '/register/'; ?>" hx-swap="innerHTML show:top" hx-target=".app"
                        class="forget-password text-danger">
                        <?php echo __('إنشاء حساب', 'qeema'); ?>
                    </a>
                </p>
                <a hx-get="<?php echo site_url('home/'); ?>" hx-swap="innerHTML show:top" hx-target=".app"
                    class="text-center text-secondary small">
                    <?php echo __('تصفح كزائر', 'qeema'); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<?php

// get_footer(); 

?>