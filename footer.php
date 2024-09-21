</div>
<div id="message"></div>

<!-- Import FawryPay Staging JavaScript Library-->
<script type="text/javascript" src="https://atfawry.fawrystaging.com/atfawry/plugin/assets/payments/js/fawrypay-payments.js"></script>

<?php

// Slide user account - run with jQuery class in app.js.
get_template_part('template-parts/my-account-block');

get_template_part('template-parts/marriage-official');

wp_footer();

?>

<?php

// Sweet alert if msg is set.
if (isset($_SESSION['msg'])):

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