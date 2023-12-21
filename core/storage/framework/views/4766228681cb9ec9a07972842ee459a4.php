<div class="card mb-2">
    <div class="card-body">
        <?php if(Request::routeIs('user.leaderboard.history')): ?>
            <a href="<?php echo e(route('user.leaderboard', 'daily')); ?>" class="btn btn-dark float-end">
                <?php echo app('translator')->get('Go Back'); ?>
            </a>
        <?php else: ?>
            <div class="button-group float-start">
                <a href="<?php echo e(route('user.leaderboard', 'daily')); ?>"
                    class="btn btn-dark <?php if($type == 'daily'): ?> disabled <?php else: ?> text-primary <?php endif; ?>">
                    <?php echo e(showAmount(\Modules\Leaderboard\Entities\Leaderboard::where('type', 'daily')->sum('reward'),0)); ?><?php echo e(GENERAL_SETTING['cur_sym']); ?>

                    <?php echo app('translator')->get('Daily'); ?>
                </a>

                <a href="<?php echo e(route('user.leaderboard', 'monthly')); ?>"
                    class="btn btn-dark <?php if($type == 'monthly'): ?> disabled <?php else: ?> text-primary <?php endif; ?>">
                    <?php echo e(showAmount(\Modules\Leaderboard\Entities\Leaderboard::where('type', 'monthly')->sum('reward'),0)); ?><?php echo e(GENERAL_SETTING['cur_sym']); ?>

                    <?php echo app('translator')->get('Monthly'); ?>
                </a>
            </div>
        <?php endif; ?>
        <div class="float-end <?php if(Request::routeIs('user.leaderboard.history')): ?> d-none <?php endif; ?>">
            <a href="<?php echo e(route('user.leaderboard.history', 'daily')); ?>" class="btn btn-dark text-right">
                <?php echo app('translator')->get('History'); ?>
            </a>
        </div>


    </div>
</div>
<?php /**PATH D:\workspace\v1Xapps30-11\core\Modules/Leaderboard\Resources/views/user/links.blade.php ENDPATH**/ ?>