<div class="row justify-content-center align-items-center">
    <?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div
            class="col-md-3
        <?php if($index == 0): ?> order-sm-0 order-md-1
        <?php elseif($index == 1): ?>
         order-sm-1 order-md-0 mt-5
        <?php else: ?>
        order-<?php echo e($index); ?> mt-5 <?php endif; ?>
        ">
            <div class="card">
                <div class="card-body text-center">
                    <div class="user-panel panel">
                        <div class="panel-body text-center" style="border: none">
                            <img src="<?php echo e(asset('/asset/static/app/imgs/ranks/crown.png')); ?>" height="50px" width="50px" class="d-block" />
                            <?php if(isset($topUsers[$index])): ?>
                                <img src="<?php echo e(getUserImage($topUsers[$index]->users)); ?>" 
                                height="50px"
                                width="50px"
                                class="round-circle" />
                                <h5 class="">
                                    <?php echo e($topUsers[$index]->users->username); ?>

                                    <span class="d-block text-info">
                                        <?php echo e($topUsers[$index]->total_earning); ?>

                                        <?php echo e(GENERAL_SETTING['cur_sym']); ?>

                                    </span>
                                </h5>
                            <?php else: ?>
                            <img src="<?php echo e(asset('/asset/static/app/imgs/loading.gif')); ?>" 
                                height="50px"
                                width="50px"
                                class="round-circle bg-dark" />
                            <h5 class="">
                                Be The Rank
                                <span class="d-block text-info">
                                    <?php echo e($level->reward); ?>

                                    <?php echo e(GENERAL_SETTING['cur_sym']); ?>

                                </span>
                            </h5>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="panel">
                        <div class="panel-body text-center">
                            <img src=<?php if($index == 1): ?> "<?php echo e(asset('/asset/static/app/imgs/ranks/two.png')); ?>"
                            <?php elseif($index == 0): ?>
                            "<?php echo e(asset('/asset/static/app/imgs/ranks/one.png')); ?>"
                            <?php else: ?> 
                            "<?php echo e(asset('/asset/static/app/imgs/ranks/three.png')); ?>" <?php endif; ?>
                                height="50px" width="50px" />
                            <h5 class="card-text">Reward: <?php echo e($level->reward); ?>

                                <?php echo e(GENERAL_SETTING['cur_sym']); ?>

                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH D:\workspace\v1Xapps30-11\core\Modules/Leaderboard\Resources/views/user/card.blade.php ENDPATH**/ ?>