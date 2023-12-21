<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li><a class="slide-item" href="<?php echo e(route('user.offer-network.browse', [$cate['id'], $cate['name']])); ?>">
            (<?php echo e(@$cate['name']); ?>

            <?php echo e(@$cate['count']); ?>)
        </a>
    </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/xapphfem/v1.xapps.store/core/resources/views/theme/nova/partial/sidebar-category.blade.php ENDPATH**/ ?>