<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">

<head>
    <?php echo $__env->make(SETTING['site_theme'] . 'partial.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldPushContent('style'); ?>
</head>

<body class="ltr main-body app sidebar-mini dark-theme">

    <div id="global-loader">
        <div class="loader-content">
            <img src="<?php echo e(asset('/asset/theme/nova/img/loader.svg')); ?>"  alt="Loader">
            <img src="<?php echo e(asset('asset/uploads/setting/' . set('siteLoadingImage'))); ?>" class="animate__animated animate__heartBeat" alt="Loader" />
        </div>
    </div>
    <?php echo $__env->make(SETTING['site_theme'] . 'partial.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(isset($slot)): ?>
        <?php echo e($slot); ?>

    <?php else: ?>
        <?php echo $__env->yieldContent('content'); ?>
    <?php endif; ?>


    <?php echo $__env->make(SETTING['site_theme'] . 'addons.cookies', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make(SETTING['site_theme'] . 'partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 
   
</body>

</html>
<?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/theme/nova/layouts/app.blade.php ENDPATH**/ ?>