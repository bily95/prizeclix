<div wire:ignore>
    <?php if(count($bannerOffers) > 0): ?>
        <div class="top_slider banner_slider banner-slider">
            <?php $__currentLoopData = $bannerOffers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bannerOffer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card banner-card p-0 round ">
                    <div class="banner-image">
                        <a href="#!" data-offer-id="<?php echo e($bannerOffer->id); ?>" class="offerClick">
                            <i class="fas fa-play-circle"></i>
                        </a>
                        <img data-src="<?php echo e($bannerOffer->image); ?>" src="<?php echo e($bannerOffer->image); ?>" class="lazyload"
                            onerror="this.src='<?php echo e(asset('/asset/static/app/imgs/loading.gif')); ?>'" height="150px"
                            width="100%" alt="" />
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <p><?php echo e(Str::limit($bannerOffer->name, 10, '.')); ?>

                            <br>
                            <small class="text-muted"><?php echo e(@$bannerOffer->provider->name); ?></small>
                        </p>
                        <p><?php echo e($bannerOffer->rewards); ?><?php echo e(GENERAL_SETTING['cur_sym']); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
    <?php if(auth()->guard()->guest()): ?>
        <div class="my-5 text-center" id="hero_section">
            <h1 class="info">Get Paid For</h1>
            <p class="mb-3">Testing Apps, Playing games, and going thinks you are already doing</p>
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-block d-md-flex flex-nowrap justify-content-around align-items-center">
                                <div class="column py-3 py-md-0">
                                    <p class="info"><i class="fas fa-coins"></i> <?php echo e(showAmount($getCompletedOffers, 0)); ?>

                                    </p>
                                    <p>Total offers completed</p>
                                </div>
                                <div class="column py-3 py-md-0">
                                    <p class="info">$
                                        <?php echo e(showAmount($averageDailyEarnings / GENERAL_SETTING['cur_rate'])); ?>

                                    </p>
                                    <h5>Average Earnings Yesterday</h5>
                                </div>
                                <div class="column py-3 py-md-0">
                                    <p class="info">$ <?php echo e(showAmount($getTotalPaid / GENERAL_SETTING['cur_rate'])); ?></p>
                                    <p>Total Earnings USD by users</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="my-3 text-lg">
                over <span class="info">+2250</span> Available Offers for you
                <br> Earn up to <span class="info">$25</span> per offer
            </p>
            <div class="cat my-2">
                <a href="<?php echo e(route('user.register')); ?>" class="btn btn-primary py-2 px-5">Create An Account</a>
            </div>
        </div>
    <?php endif; ?>

    <?php $__currentLoopData = $offersWithCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(count($category['offers']) > 0): ?>
            <h5 class="float-start text-capitalize"><?php echo e($category['name']); ?> Offers</h5>
            <?php if(count($category['offers']) > 8): ?>
                <a href="<?php echo e(route('user.offer-network.browse', [$category['id'], $category['name']])); ?>"
                    class="float-end nav-link">See All</a>
            <?php endif; ?>
            <div class="clearfix"></div>
            <div class="home_slider banner-slider">
                <?php $__currentLoopData = $category['offers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                onerror="this.src='<?php echo e(asset('/asset/static/app/imgs/loading.gif')); ?>'" height="150px"
                                width="100%" alt="" />
                        </div>
                        <div class="card-footer p-1">
                            <p><?php echo e(Str::limit($offer->name, 15, '.')); ?>

                                <br>
                                <small class="text-muted"><?php echo e(@$offer->provider->name); ?></small>
                            </p>
                            <div class="d-flex align-items-center justify-content-between flex-nowrap">
                                <p class=""><?php echo e(GENERAL_SETTING['cur_sym']); ?><?php echo e($offer->rewards); ?></p>
                                <p class="bg-dark py-0 px-1 text-small rounded overflow-hidden">
                                    <?php echo e(Str::limit($category['name'], 3, '.')); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <div class="modal animated zoomIn" id="offerDetailsModal" tabindex="-1" aria-labelledby="offerDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="offerDetailsModalContent"></div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('offersnetwork::user.asset', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php /**PATH /home/xapphfem/v1.xapps.store/core/Modules/OffersNetwork/Resources/views/index.blade.php ENDPATH**/ ?>