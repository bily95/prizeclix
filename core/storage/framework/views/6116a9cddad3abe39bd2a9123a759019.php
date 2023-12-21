<?php $__env->startSection('title', 'Earn '); ?>
<div class="row">
    <div class="col-12">
        <?php echo $__env->make('offersnetwork::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make(SETTING['site_theme'] . 'offers.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div><?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/theme/nova/home.blade.php ENDPATH**/ ?>