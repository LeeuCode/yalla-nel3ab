<script>
    Swal.fire({
        title: '<?php echo (isset($args['title'])) ? $args['title'] : __('تم بنجاح!', 'qeema'); ?>',
        text: '<?php echo $args['msg']; ?>',
        icon: '<?php echo $args['icon']; ?>',
        confirmButtonText: '<?php echo __('تم', 'qeema'); ?>'
    });
</script>


<!-- <div hx-swap-oob="afterbegin:#order-service">
    <div>Joe Smith</div>
    <div>joe@smith.com</div>
</div> -->


<?php echo (isset($args['content'])) ? $args['content'] : ''; ?>