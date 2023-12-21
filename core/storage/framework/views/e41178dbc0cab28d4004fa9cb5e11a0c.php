<?php
    $valid = auth()->check() && ($oneOffer->user_level > $user->profile->level);
?>

<div class="">
    <div class="offerwallsposition custom-offerwall-style2">
        <div class="innerwall <?php echo e($oneOffer->is_available == 0 ? 'unavailable' : ''); ?>">
            <a href="<?php echo e($valid ? $offerURL : '#!'); ?>"
                class="<?php echo e($valid ? 'offer-url' : ''); ?>"
                title="<?php echo e($oneOffer->name); ?>">
                <div class="innerwall2"
                    style="background: rgb(37, 43, 49);
                    background: linear-gradient(0deg,  rgb(42 46 63) 4%, <?php echo e($oneOffer->bgcolor); ?> 45%);">
                    <img src="<?php echo e(asset('asset/uploads/offerwalls/' . $oneOffer->image)); ?>"
                        onerror="this.src='<?php echo e(asset('/asset/static/app/imgs/loading.gif')); ?>'" />
                    <?php if($valid): ?>
                        <div class="lock">
                            <span title="Require level <?php echo e($oneOffer->user_level); ?>">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                    <?php endif; ?>
                    <div>
                        <p class="offerwall-name"><?php echo e($oneOffer->name); ?></p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<?php /**PATH D:\workspace\v1Xapps30-11\core\resources\views/theme/nova/offers/card.blade.php ENDPATH**/ ?>