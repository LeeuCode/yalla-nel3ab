<div class="mb-5- py-4"></div>

<div class="footer border-top">
    <ul class="nav justify-content-between py-2 px-3">
        <li class="nav-item">
            <a hx-get="<?php echo site_url('home/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" class="py-2 d-flex flex-column align-items-center">
                <i class="fa-solid fa-house h4 m-0"></i>
            </a>
        </li>

        <li class="nav-item">
            <a hx-get="<?php echo site_url('massenger/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" class="py-2 d-flex flex-column align-items-center">
                <i class="fa-regular fa-comment-dots h4 m-0"></i>
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="shadow add-offer d-flex flex-column align-items-center">
                <i class="fa-solid fa-plus h6 m-0"></i>
            </a>
        </li>

        <li class="nav-item">
            <a hx-get="<?php echo site_url('tasks/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" class="py-2 d-flex flex-column align-items-center">
                <i class="fa-regular fa-note-sticky h4 m-0"></i>
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="show-my-account py-2 d-flex flex-column align-items-center">
                <i class="fa-regular fa-user h4 m-0"></i>
            </a>
        </li>
    </ul>
</div>

</div>
<div id="message"></div>
<?php

// Slide user account - run with jQuery class in app.js.
get_template_part('template-parts/my-account-block');

wp_footer();

?>

<?php

// Sweet alert if msg is set.
if (isset($_SESSION['msg'])) :

?>
    <script>
        Swal.fire({
            title: '<?php echo __('تم بنجاح!', 'qeema'); ?>',
            text: '<?php echo $_SESSION['msg']; ?>',
            icon: 'success',
            confirmButtonText: '<?php echo __('تم', 'qeema'); ?>'
        })
    </script>
<?php
    // Remove msg from Sesstion. 
    unset($_SESSION['msg']);
endif;
?>
</body>

</html>