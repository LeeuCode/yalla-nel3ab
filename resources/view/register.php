<!-- Login System. -->
<div class="item">
    <div class="header">
        <div class="header-box"
            style="background-image: url(<?php echo get_template_directory_uri() . '/assets/images/bg-image.png'; ?>)">
            <img class="w-50" src="<?php echo get_template_directory_uri() . '/assets/images/login-header.png'; ?>"
                alt="">
        </div>
    </div>
    <div class="step- d-flex flex-column align-items-center justify-content-center">
        <div class="step-content p-3 w-100">
            <h6 class="text-dark text-center fw-bold mt-4 mb-2">
                <?php echo __('مرحباً بك معانا..! 👋', 'qeema'); ?>
            </h6>
            <p class="text-secondary text-center small mb-3">
                <?php echo __('برجاء تسجيل مستخدم جديد حتي تتمكن من الاستمتاع بخدماتنا', 'qeema'); ?>
            </p>

            <?php
            if (isset($_SESSION['errors'])):
                $errors = $_SESSION['errors'];
                ?>
                <div class="alert alert-danger my-3" role="alert">
                    <ol>
                        <?php foreach ($errors as $key => $error): ?>
                            <li>
                                <?php echo $error; ?>
                            </li>
                        <?php endforeach; ?>
                    </ol>

                </div>
                <?php
                unset($_SESSION['errors']);
            endif;
            ?>

            <form class="row" action="<?php echo site_url() . '/register/request/'; ?>" method="post">

                <?php wp_nonce_field('submit_picture'); ?>

                <div class="col-12">
                    <label class="d-block mb-2" for=""><?php echo __('اسم الاول', 'qeema'); ?></label>
                    <input type="text" name="first_name" class="form-control mb-4 "
                        placeholder="<?php echo __('اسم الاول', 'qeema'); ?>" required>
                </div>

                <div class="col-12">
                    <label class="d-block mb-2" for=""><?php echo __('اسم الاخير', 'qeema'); ?></label>
                    <input type="text" name="last_name" class="form-control mb-4 "
                        placeholder="<?php echo __('اسم الاخير', 'qeema'); ?>" required>
                </div>

                <div class="col-12">
                    <label class="d-block mb-2" for=""><?php echo __('رقم الهاتف', 'qeema'); ?></label>
                    <input type="text" name="phonenumber" class="form-control mb-4 "
                        placeholder="<?php echo __('رقم الهاتف', 'qeema'); ?>">
                </div>

                <div class="col-12">
                    <label class="d-block mb-2" for=""><?php echo __('البريد الالكتروني', 'qeema'); ?></label>
                    <input type="email" name="email" class="form-control mb-4  text-start"
                        placeholder="<?php echo __('البريد الالكتروني', 'qeema'); ?>" required>
                </div>

                <div class="col-12">
                    <label class="d-block mb-2"
                        for=""><?php echo __('اسم المستخدم (حروف انجليزيه فقط)', 'qeema'); ?></label>
                    <input type="text" name="user_login" class="form-control mb-4 "
                        placeholder="<?php echo __('هو اسم المستخدم لتسجيل الدخول', 'qeema'); ?>" required>
                </div>

                <div class="col-12">
                    <label class="d-block mb-2" for=""><?php echo __('كلمة السر', 'qeema'); ?></label>
                    <input type="text" name="password" class="form-control mb-4 "
                        placeholder="<?php echo __('كلمة السر', 'qeema'); ?>" required>
                </div>

                <div class="col-12">
                    <label class="d-block mb-2" for=""><?php echo __('كلمة السر', 'qeema'); ?></label>
                    <input type="text" name="password_confirmation" class="form-control mb-4 "
                        placeholder="<?php echo __('تاكيد كلمة السر', 'qeema'); ?>" required>
                </div>

                <div class="d-grid mt-4 mb-3">
                    <button class="btn btn-success-lite px-4">
                        <?php echo __('تسجيل مستخدم', 'qeema'); ?>
                    </button>
                </div>
            </form>

            <div class="d-flex justify-content-center">
                <div class="small">
                    <span>
                        <?php echo __('لدي بالفعل حساب', 'qeema'); ?>
                    </span>
                    <a hx-get="<?php echo site_url() . '/login/'; ?>" hx-swap="innerHTML show:top" hx-target=".app"
                        class="forget-password text-danger">
                        <?php echo __('تسجيل دخول', 'qeema'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>