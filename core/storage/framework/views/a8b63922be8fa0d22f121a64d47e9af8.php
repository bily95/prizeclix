<?php if($withdrawal): ?>
<img src="<?php echo e(getImage(imagePath()['withdraw']['method']['path'] . '/' . @$withdrawal->method->image)); ?>" alt="image" />
<div>
    <p>Withdrawal</p>
    <p><?php echo e($withdrawal->method->name); ?></p>
</div>
<div class="offer-wrapper-inner">
    <p class="column">
        <span class="title">username: </span>
        <span class="value"><?php echo e(@Str::limit($withdrawal->user->username, 10, '.')); ?></span>
    </p>
    <p class="column">
        <span class="title">Currency:</span>
        <span class="value"><?php echo e($withdrawal->method->name); ?></span>
    </p>
    <p class="column">
        <span class="title">Amount:</span>
        <span class="value"><?php echo e(showAmount($withdrawal->final_amount)); ?> <?php echo e($withdrawal->method->name); ?></span>
    </p>
</div>
<p class="offer-amount text-white"><?php echo e(showAmount($entry->amount, 0)); ?></p>
<?php endif; ?><?php /**PATH /home/xapphfem/v1.xapps.store/core/resources/views/theme/nova/addons/live-activity/partials/withdraw.blade.php ENDPATH**/ ?>