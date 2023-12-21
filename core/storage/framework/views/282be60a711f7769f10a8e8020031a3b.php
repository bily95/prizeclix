
<?php $__env->startSection('title'); ?>
    Offers browse by <?php echo e($category->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="browse_content">
        
        <?php echo e($category->name); ?>

        <div class="row" id="offers-container">
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
                            <img  data-src="<?php echo e($offer->image); ?>" src="<?php echo e($offer->image); ?>" class="lazyload"
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
        </div>
        <div id="loading-indicator" style="display: none;">
            Loading...
        </div>

        
        <div class="modal animated zoomIn" id="offerDetailsModal" tabindex="-1" aria-labelledby="offerDetailsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div id="offerDetailsModalContent"></div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('offersnetwork::user.asset', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(SETTING['site_theme'] . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xapphfem/v1.xapps.store/core/Modules/OffersNetwork/Resources/views/user/browse.blade.php ENDPATH**/ ?>