<div class="py-4 my-3"></div>
<div class="footer bg-white shadow">
    <ul class="nav justify-content-between py-2 px-3">
        <li class="nav-item">
            <a hx-get="<?php echo site_url('home/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click"
                hx-target=".app" class="py-2 d-flex flex-column align-items-center">
                <i class="bi bi-house fs-4"></i>
                <span class="fw-bold"><?php echo __('الرئيسية', 'qeema'); ?></span>
            </a>
        </li>

        <?php
        if (is_user_logged_in()) {
            $link = 'my-orders/';
        } else {
            $link = 'gest/login/';
        }
        ?>

        <li class="nav-item">
            <a hx-get="<?php echo site_url($link); ?>" hx-swap="innerHTML show:top" hx-trigger="click"
                hx-target=".app" class="py-2 d-flex flex-column align-items-center">
                <i class="bi bi-file-earmark-richtext fs-4"></i>
                <span class="fw-bold"><?php echo __('حجوزاتي', 'qeema'); ?></span>
            </a>
        </li>

        <?php
        if (is_user_logged_in()) {
            $link = 'activites/';
        } else {
            $link = 'gest/login/';
        }
        ?>

        <li class="nav-item">
            <a hx-get="<?php echo site_url('activites/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click"
                hx-target=".app" class="py-2 d-flex flex-column align-items-center">
                <i class="bi bi-people fs-4"></i>
                <span class="fw-bold"><?php echo __('أنشطه', 'qeema'); ?></span>
            </a>
        </li>

        <?php
        if (is_user_logged_in()) {
            $link = 'gest/login/';
        } else {
            $link = 'gest/login/';
        }
        ?>

        <li class="nav-item">
            <a hx-get="<?php echo site_url($link); ?>" hx-swap="innerHTML show:top" hx-trigger="click"
                hx-target=".app" class="py-2 d-flex flex-column align-items-center">
                <i class="bi bi-heart fs-4"></i>
                <span class="fw-bold"><?php echo __('المفضله', 'qeema'); ?></span>
            </a>
        </li>

        <li class="nav-item">
            <?php
            if (is_user_logged_in()) {
                $link = 'user/account/';
            } else {
                $link = 'login/';
            }
            ?>
            <a hx-get="<?php echo site_url($link); ?>" hx-swap="innerHTML show:top" hx-trigger="click"
                hx-target=".app" class="show-my-account py-2 d-flex flex-column align-items-center">
                <i class="bi bi-person fs-4"></i>
                <span class="fw-bold"><?php echo __('الحساب', 'qeema'); ?></span>
            </a>
        </li>
    </ul>
</div>