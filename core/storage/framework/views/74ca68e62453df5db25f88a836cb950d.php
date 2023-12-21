<?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-lg-2 col-md-3 col-4">
        <div class="card banner-card p-0 round ">
            <div class="banner-image">
                <div class="offers-devices">
                    <?php
                    $devices = $offer->device;
                    //dump($devices);
                    ?>
                    <?php if(Str::contains($devices, 'windows') || Str::contains($devices, 'desktop')): ?>
                    <i class="fab fa-windows" title="windows"></i>
                    <?php endif; ?>
                    <?php if(Str::contains($devices, 'android')): ?>
                    <i class="fab fa-android" title="android"></i>
                    <?php endif; ?>
                    <?php if(Str::contains($devices, 'ipad')): ?>
                    <i class="fas fa-tablet-screen-button" title="ipad"></i>
                    <?php endif; ?>
                    <?php if(Str::contains($devices, 'iphone')): ?>
                    <i class="fab fa-apple" title="iphone"></i>
                    <?php endif; ?>
                    <?php if(Str::contains($devices, 'mac')): ?>
                    <i class="fas fa-desktop" title="mac"></i>
                    <?php endif; ?>
                </div>
                <a href="#!" data-offer-id="<?php echo e($offer->id); ?>" class="offerClick">
                    <i class="fas fa-play-circle"></i>
                </a>
                <img data-src="<?php echo e($offer->image); ?>" src="<?php echo e($offer->image); ?>" class="lazyload"
                    onerror="this.src='<?php echo e(asset('/asset/static/app/imgs/loading.gif')); ?>'" height="150px" width="100%"
                    alt="" />
            </div>
            <div class="card-footer p-1">
                <p><?php echo e(Str::limit($offer->name, 15, '.')); ?>

                    <br>
                    <small class="text-muted"><?php echo e(@$offer->provider->name); ?></small>
                </p>
                <div class="d-flex align-items-center justify-content-between flex-nowrap">
                    <p class=""><?php echo e(GENERAL_SETTING['cur_sym']); ?><?php echo e($offer->rewards); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH D:\workspace\v1Xapps30-11\core\Modules/OffersNetwork\Resources/views/user/load-more-offers.blade.php ENDPATH**/ ?>