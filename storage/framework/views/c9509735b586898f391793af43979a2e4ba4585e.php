<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var Toast = actions.Toast;

        <?php if(session()->has('notice')): ?>
            var toastNotice = Toast.create(app, {
                message: "<?php echo e(session('notice')); ?>",
                duration: 3000,
            });
            toastNotice.dispatch(Toast.Action.SHOW);
        <?php endif; ?>

        <?php if(session()->has('error')): ?>
            var toastNotice = Toast.create(app, {
                message: "<?php echo e(session('error')); ?>",
                duration: 3000,
                isError: true,
            });
            toastNotice.dispatch(Toast.Action.SHOW);
        <?php endif; ?>
    });
</script><?php /**PATH /home/516655.cloudwaysapps.com/fwkpfhbxsv/public_html/vendor/osiset/laravel-shopify/src/ShopifyApp/resources/views/partials/flash_messages.blade.php ENDPATH**/ ?>