<div class="modal-header" style="background-image:url('<?php echo e($offer->image); ?>')">
    <div class="modal-header-content">
        <div class="offer-header d-flex align-items-center">
            <img data-src="<?php echo e($offer->image); ?>" src="<?php echo e($offer->image); ?>" class="lazyload rounded-3 me-2"
                onerror="this.src='<?php echo e(asset('/asset/uploads/offerwalls/custom/cpx.png')); ?>'" height="100px" width="100px"
                alt="" />
            <div class="offer-header-info">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e($offer->name); ?></h5>
                <div class="d-flex">
                    <?php echo e(GENERAL_SETTING['cur_sym']); ?> <?php echo intval($offer->rewards) == 0 ? '<i class="fas fa-infinity"></i>' : $offer->rewards; ?>

                </div>
                <div class="d-flex device-icons my-2">
                    <?php $__currentLoopData = explode('-',$offer->device); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo \Modules\OffersNetwork\Http\Controllers\OffersNetworkController::displayOfferDevice($device); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
</div>
<div class="modal-body">
    <h3>About</h3>
    <p><?php echo str_replace('.', '.<br/>', strip_tags($offer->description)); ?></p>
    <hr />

    <h6>Categories</h6>
    <div class="d-flex">
        <?php $__currentLoopData = explode('-',$offer->category); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="me-1 bg-info py-0 px-2 rounded-3"><?php echo e($cate); ?></span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <hr />


    <div class="my-2 d-flex">
        <h6>Provider</h6>: <p><?php echo e(@$offer->provider->name); ?></p>
    </div>

</div>
<div class="modal-footer d-flex justify-content-between">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <a href="<?php echo e(auth()->check() ? route('user.offer-network.click', $offer->id) : route('user.login')); ?>"
        <?php if(auth()->check()): ?> target="_blank" <?php endif; ?> class="btn btn-primary">Start</a>
</div>
<?php /**PATH D:\workspace\v1Xapps30-11\core\Modules/OffersNetwork\Resources/views/user/offer-details.blade.php ENDPATH**/ ?>