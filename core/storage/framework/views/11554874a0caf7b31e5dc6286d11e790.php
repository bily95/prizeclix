<div class="">
    <div class="offerwallsposition custom-offerwall-style2">
        <div class="innerwall <?= $oneOffer->is_available == 0 ? 'unavailable' : '' ?>">
            <a href="<?php echo e(auth()->check() ? $offerURL : route('user.login')); ?>"
                <?php if(auth()->guard()->check()): ?>
                target="_blank"
                <?php endif; ?>
                class="offer-url" title="<?php echo e($oneOffer->name); ?>"
                >
                <div class="innerwall2" 
                style="background: rgb(37, 43, 49);
                background: linear-gradient(0deg,  rgb(42 46 63) 4%, <?php echo e($oneOffer->bgcolor); ?> 45%);">
                    <img src="<?php echo e(asset('asset/uploads/offerwalls/' . $oneOffer->image)); ?>" 
                    onerror="this.src='<?php echo e(asset('/asset/static/app/imgs/loading.gif')); ?>'"
                    />
                    <div>
                        <p class="offerwall-name"><?php echo e($oneOffer->name); ?></p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<?php /**PATH /home/xapphfem/v1.xapps.store/core/resources/views/theme/nova/offers/card.blade.php ENDPATH**/ ?>